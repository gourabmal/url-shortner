<?php

namespace App\Http\Controllers\Admin\Invitation;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Services\Invitation\InvitationService;
use Exception;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    protected InvitationService $invitationService;

    public function __construct(InvitationService $invitationService)
    {
        $this->invitationService = $invitationService;
    }

    /**
     * Display a listing of invitations.
     */
    // public function index()
    // {
    //     $invitations = Invitation::with('company')
    //         ->where('company_id', auth()->user()->company_id)
    //         ->where('invited_by', auth()->id()) // Remove this if all company admins should see all invitations.
    //         ->latest()
    //         ->paginate(10);

    //     return view('admin.pages.invitation.index', compact('invitations'));
    // }

    public function index()
    {
        $invitations = Invitation::with(['company', 'inviter'])
            ->where('company_id', auth()->user()->company_id)
            ->where('email', '!=', auth()->user()->email) // Hide my own invitation
            ->whereHas('inviter', function ($query) {
                $query->whereDoesntHave('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'SuperAdmin');
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.pages.invitation.index', compact('invitations'));
    }

    /**
     * Show the invitation form.
     */
    public function create()
    {
        return view('admin.pages.invitation.invite');
    }

    /**
     * Store a newly created invitation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:invitations,email',
            'role'  => 'required|in:Admin,Member',
        ]);

        try {

            $this->invitationService->createInvitation(
                companyId: auth()->user()->company_id,
                invitedBy: auth()->id(),
                name: $validated['name'],
                email: $validated['email'],
                role: $validated['role']
            );

            return redirect()
                ->route('admin.invitations.index')
                ->with('success', 'Invitation sent successfully.');

        } catch (Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        }
    }

    /**
     * Display the specified invitation.
     */
    public function show(Invitation $invitation)
    {
        abort_unless(
            $invitation->company_id === auth()->user()->company_id,
            403
        );

        $invitation->load('company', 'inviter');

        return view('admin.pages.invitation.show', compact('invitation'));
    }

    /**
     * Resend an invitation.
     */
    public function resend(Invitation $invitation)
    {
        abort_unless(
            $invitation->company_id === auth()->user()->company_id,
            403
        );

        try {

            $this->invitationService->resendInvitation($invitation);

            return redirect()
                ->route('admin.invitations.index')
                ->with('success', 'Invitation resent successfully.');

        } catch (Exception $e) {

            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        }
    }

    /**
     * Delete an invitation.
     */
    public function destroy(Invitation $invitation)
    {
        abort_unless(
            $invitation->company_id === auth()->user()->company_id,
            403
        );

        if ($invitation->accepted_at) {
            return back()->withErrors([
                'error' => 'Accepted invitations cannot be deleted.',
            ]);
        }

        $invitation->delete();

        return redirect()
            ->route('admin.invitations.index')
            ->with('success', 'Invitation deleted successfully.');
    }
}