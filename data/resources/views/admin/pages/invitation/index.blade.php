@extends('common.layout.admin_layout')

@section('title', 'Invitations')

@section('content')
    <div class="content-wrapper" style="min-height: 357px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Invitations</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a> </li>
                            <li class="breadcrumb-item active">Invitations</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Invitations</h3>
                                <h3 class="card-title" style="float: right!important;">
                                    <a href="{{ route('admin.invitations.create') }}" class="btn btn-success"><i
                                            class="fa fa-plus" aria-hidden="true"></i> New Invitation</a>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                @include('messages')

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Company</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Invited By</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse($invitations as $invitation)
                                            @php
                                                if ($invitation->accepted_at) {
                                                    $status = 'Accepted';
                                                    $badge = 'success';
                                                } elseif (
                                                    $invitation->expires_at &&
                                                    $invitation->expires_at->isPast()
                                                ) {
                                                    $status = 'Expired';
                                                    $badge = 'danger';
                                                } elseif ($invitation->status === 'Cancelled') {
                                                    $status = 'Cancelled';
                                                    $badge = 'secondary';
                                                } else {
                                                    $status = 'Pending';
                                                    $badge = 'warning';
                                                }
                                            @endphp

                                            <tr>
                                                <td>
                                                    {{ ($invitations->currentPage() - 1) * $invitations->perPage() + $loop->iteration }}
                                                </td>

                                                <td>{{ optional($invitation->company)->name }}</td>

                                                <td>{{ $invitation->role }}</td>

                                                <td>{{ $invitation->name }}</td>

                                                <td>{{ $invitation->email }}</td>

                                                <td>
                                                    <span class="badge badge-{{ $badge }}">
                                                        {{ $status }}
                                                    </span>
                                                </td>

                                                <td>
                                                    {{ $invitation->inviter->name ?? 'User #'.$invitation->invited_by }}
                                                </td>

                                            

                                                <td>
                                                    <a href="{{ route('admin.invitations.show', $invitation) }}"
                                                        class="btn btn-info btn-sm" data-toggle="tooltip"
                                                        data-placement="top" title="View"><i class="fa fa-eye"></i></a>

                                                    @if ($status === 'Expired' || $status === 'Cancelled')
                                                        <form action="{{ route('admin.invitations.resend', $invitation) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm"
                                                                data-toggle="tooltip" data-placement="top" title="Resend"
                                                                onclick="return confirm('Resend this invitation?')">
                                                                <i class="fas fa-sync-alt"></i>
                                                            </button>
                                                        </form>
                                                    @endif


                                                    <!-- <form action="{{ route('admin.invitations.destroy', $invitation) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            data-toggle="tooltip" data-placement="top" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this invitation?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form> -->

                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    No invitations found.
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                                <div class="mt-3">
                                    {{ $invitations->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
