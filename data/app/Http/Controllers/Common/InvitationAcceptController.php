<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InvitationAcceptController extends Controller
{
    /**
     * Show invitation page.
     */
    public function show(string $token)
    {
        $invitation = Invitation::with('company')
            ->where('token', $token)
            ->firstOrFail();

        if ($invitation->status === 'Accepted') {
            return view('invitation.already-accepted');
        }

        if ($invitation->status === 'Cancelled') {
            return view('invitation.cancelled');
        }

        if (now()->gt($invitation->expires_at)) {

            if ($invitation->status === 'Pending') {
                $invitation->update([
                    'status' => 'Expired',
                ]);
            }

            return view('invitation.expired');
        }

        return view('invitation.accept', compact('invitation'));
    }

    /**
     * Accept invitation.
     */
    public function accept(string $token)
    {
        $invitation = Invitation::with('company')
            ->where('token', $token)
            ->firstOrFail();

        if ($invitation->status !== 'Pending') {
            abort(404);
        }

        $user = null;

        DB::transaction(function () use ($invitation, &$user) {

            $name = explode(' ', trim($invitation->name), 2);

            $user = User::create([
                'company_id' => $invitation->company_id,
                'first_name' => $name[0],
                'last_name'  => $name[1] ?? null,
                'email'      => $invitation->email,
                'password'   => Hash::make(Str::random(40)),
                'status'     => 'Active',
            ]);

            $user->assignRole($invitation->role);

            $invitation->update([
                'status'      => 'Accepted',
                'accepted_at' => now(),
                'token'       => Str::random(64),
            ]);
        });

        return redirect()->route('invitation.set-password', $user);
    }

    /**
     * Reject invitation.
     */
    public function reject(string $token)
    {
        $invitation = Invitation::where('token', $token)
            ->firstOrFail();

        if ($invitation->status !== 'Pending') {
            abort(404);
        }

        $invitation->update([
            'status' => 'Cancelled',
            'expires_at' => null,
            // invalidate old URL
            'token' => Str::random(64),
        ]);

        return view('invitation.cancelled');
    }

        public function setPassword(User $user)
    {
        return view('invitation.set-password', compact('user'));
    }

    public function storePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin_login')
            ->with('success', 'Password created successfully. Please login.');
    }
}
