@extends('common.layout.admin_layout')

@section('title', 'Invitation Details')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Invitation Details</h1>

            <a href="{{ route('admin.invitations.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </section>

    <section class="content">

        @include('messages')

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Invitation Information
                </h3>
            </div>

            <div class="card-body">

                @php
                    if ($invitation->accepted_at) {
                        $status = 'Accepted';
                        $badge = 'success';
                    } elseif ($invitation->status === 'Cancelled') {
                        $status = 'Cancelled';
                        $badge = 'secondary';
                    } elseif ($invitation->expires_at && $invitation->expires_at->isPast()) {
                        $status = 'Expired';
                        $badge = 'danger';
                    } else {
                        $status = 'Pending';
                        $badge = 'warning';
                    }
                @endphp

                <table class="table table-bordered">

                    <tr>
                        <th width="250">Company</th>
                        <td>{{ optional($invitation->company)->name }}</td>
                    </tr>

                    <tr>
                        <th>Name</th>
                        <td>{{ $invitation->name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $invitation->email }}</td>
                    </tr>

                    <tr>
                        <th>Role</th>
                        <td>
                            <span class="badge badge-primary">
                                {{ $invitation->role }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge badge-{{ $badge }}">
                                {{ $status }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Invitation Token</th>
                        <td>
                            <code>{{ $invitation->token }}</code>
                        </td>
                    </tr>

                    <tr>
                        <th>Invited By</th>
                        <td>
                            {{ $invitation->inviter->name ?? 'User #'.$invitation->invited_by }}
                        </td>
                    </tr>

                    <tr>
                        <th>Created At</th>
                        <td>{{ $invitation->created_at->format('d M Y h:i A') }}</td>
                    </tr>

                    <tr>
                        <th>Expires At</th>
                        <td>
                            {{ $invitation->expires_at ? $invitation->expires_at->format('d M Y h:i A') : 'N/A' }}
                        </td>
                    </tr>

                    <tr>
                        <th>Accepted At</th>
                        <td>
                            @if($invitation->accepted_at)
                                {{ $invitation->accepted_at->format('d M Y h:i A') }}
                            @else
                                <span class="text-muted">Not Accepted Yet</span>
                            @endif
                        </td>
                    </tr>

                </table>

            </div>

            <div class="card-footer">

                <a href="{{ route('admin.invitations.index') }}"
                   class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>

                @if($status === 'Expired' || $status === 'Cancelled')

                    <form action="{{ route('admin.invitations.resend', $invitation) }}"
                          method="POST"
                          class="d-inline">
                        @csrf

                        <button type="submit"
                                class="btn btn-warning"
                                onclick="return confirm('Resend this invitation?')">
                            <i class="fa fa-refresh"></i>
                            Resend Invitation
                        </button>

                    </form>

                @endif

            </div>

        </div>

    </section>

</div>

@endsection