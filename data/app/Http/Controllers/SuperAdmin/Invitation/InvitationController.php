<?php

namespace App\Http\Controllers\SuperAdmin\Invitation;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Invitation;
use App\Services\Invitation\InvitationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    protected InvitationService $invitationService;

    public function __construct(InvitationService $invitationService)
    {
        $this->invitationService = $invitationService;
    }

    /**
     * List all invitations.
     */
    public function index()
    {
        $invitations = Invitation::with(['company', 'inviter'])
            ->latest()
            ->paginate(10);

        return view('super_admin.pages.invitation.index', compact('invitations'));
    }

    /**
     * Show invite admin page.
     */
    public function create()
    {
        return view('super_admin.pages.invitation.invite');
    }

    /**
     * Store invitation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255|unique:companies,name',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email|unique:invitations,email',
        ]);

        DB::beginTransaction();

        try {

            $company = Company::create([
                'name'   => $validated['company_name'],
                'slug'   => Str::slug($validated['company_name']),
                'status' => true,
            ]);

            $this->invitationService->createInvitation(
                companyId: $company->id,
                invitedBy: auth()->id(),
                name: $validated['name'],
                email: $validated['email'],
                role: 'Admin'
            );

            DB::commit();

            return redirect()
                ->route('superadmin.invitations.index')
                ->with('success', 'Invitation sent successfully.');

        } catch (Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        }
    }

    /**
     * Show invitation details.
     */
    public function show(Invitation $invitation)
    {
        $invitation->load(['company', 'inviter']);

        return view('super_admin.pages.invitation.show', compact('invitation'));
    }

    /**
     * Resend invitation.
     */
    public function resend(Invitation $invitation)
    {
        try {

            $this->invitationService->resendInvitation($invitation);

            return redirect()
                ->route('superadmin.invitations.index')
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
     * Delete invitation.
     */
    public function destroy(Invitation $invitation)
    {

        DB::transaction(function () use ($invitation) {

            $company = $invitation->company;

            $invitation->delete();

            if (
                $company &&
                $company->users()->count() === 0 &&
                $company->invitations()->count() === 0
            ) {
                $company->delete();
            }
        });

        return redirect()
            ->route('superadmin.invitations.index')
            ->with('success', 'Invitation deleted successfully.');
    }
}