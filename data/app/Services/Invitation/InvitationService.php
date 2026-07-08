<?php

namespace App\Services\Invitation;

use App\Mail\InvitationMail;
use App\Models\Invitation;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationService
{
    /**
     * Create an invitation for an existing company.
     */
    public function createInvitation(
        int $companyId,
        int $invitedBy,
        string $name,
        string $email,
        string $role
    ): Invitation {
        return DB::transaction(function () use (
            $companyId,
            $invitedBy,
            $name,
            $email,
            $role
        ) {

            $invitation = Invitation::create([
                'company_id' => $companyId,
                'invited_by' => $invitedBy,
                'name'       => $name,
                'email'      => $email,
                'role'       => $role,
                'token'      => Str::random(64),
                'status'     => 'Pending',
                'expires_at' => now()->addDays(1),
            ]);

            Mail::to($invitation->email)
                ->send(new InvitationMail($invitation));

            return $invitation;
        });
    }

    /**
     * Resend an expired invitation.
     */
    public function resendInvitation(Invitation $invitation): Invitation
    {
        if ($invitation->accepted_at) {
            throw new Exception('This invitation has already been accepted.');
        }

        if (
            $invitation->status === 'Pending' &&
            $invitation->expires_at &&
            now()->lt($invitation->expires_at)
        ) {
            throw new Exception('This invitation has not expired yet.');
        }

        $invitation->update([
            'token'      => Str::random(64),
            'status'     => 'Pending',
            'expires_at' => now()->addDays(7),
        ]);

        Mail::to($invitation->email)
            ->send(new InvitationMail($invitation));

        return $invitation->fresh();
    }
}