@extends('common.layout.admin_layout')

@section('title', 'Dashboard')

@section('content')
    <div class="content-wrapper" style="min-height: 357px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">

                @include('messages')

                <!-- Welcome banner -->
                <div class="card mb-4" style="background: linear-gradient(135deg,#4e73df 0%,#375ad3 100%); border: none;">
                    <div class="card-body py-4 d-flex justify-content-between align-items-center flex-wrap">
                        <div>
                            <h3 class="text-white mb-1">Welcome back, {{ auth()->user()->name }} 👋</h3>
                            <p class="text-white-50 mb-2">Here's a global overview of the URL Shortener platform.</p>
                            <span class="badge badge-light text-dark">
                                <i class="fa fa-id-badge mr-1"></i> {{ auth()->user()->getRoleNames()->first() ?? 'Super Admin' }}
                            </span>
                        </div>
                        <a href="{{ route('superadmin.invitations.create') }}" class="btn btn-light mt-3 mt-md-0">
                            <i class="fa fa-plus"></i> Invite Company Admin
                        </a>
                    </div>
                </div>

                <!-- Stat widgets -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $totalCompanies ?? 0 }}</h3>
                                <p>Total Companies</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <a href="{{ route('superadmin.invitations.index') }}" class="small-box-footer">
                                View all <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalShortUrls ?? 0 }}</h3>
                                <p>Total Short URLs</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-link"></i>
                            </div>
                            <a href="{{ route('superadmin.short-urls.index') }}" class="small-box-footer">
                                View all <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalClicks ?? 0 }}</h3>
                                <p>Total Clicks</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-mouse-pointer"></i>
                            </div>
                            <a href="{{ route('superadmin.short-urls.index') }}" class="small-box-footer">
                                View all <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $pendingInvitations ?? 0 }}</h3>
                                <p>Pending Invitations</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <a href="{{ route('superadmin.invitations.index') }}" class="small-box-footer">
                                View all <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row (stat widgets) -->

                <div class="row">
                    <!-- Recent Short URLs -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Short URLs</h3>
                                <h3 class="card-title" style="float: right!important;">
                                    <a href="{{ route('superadmin.short-urls.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Short URL</th>
                                            <th>Company</th>
                                            <th>Clicks</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(($recentShortUrls ?? collect()) as $url)
                                            <tr>
                                                <td>
                                                    <a href="{{ url($url->code) }}" target="_blank">
                                                        {{ url($url->code) }}
                                                    </a>
                                                </td>
                                                <td>{{ optional($url->company)->name }}</td>
                                                <td>{{ $url->clicks }}</td>
                                                <td>
                                                    @if($url->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Disabled</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">No short URLs yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <!-- Recent Invitations -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Recent Invitations</h3>
                                <h3 class="card-title" style="float: right!important;">
                                    <a href="{{ route('superadmin.invitations.index') }}" class="btn btn-sm btn-outline-secondary">View All</a>
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Company</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(($recentInvitations ?? collect()) as $invitation)
                                            @php
                                                if ($invitation->accepted_at) {
                                                    $status = 'Accepted';
                                                    $badge = 'success';
                                                } elseif ($invitation->expires_at && $invitation->expires_at->isPast()) {
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
                                                <td>{{ optional($invitation->company)->name }}</td>
                                                <td>{{ $invitation->name }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $badge }}">{{ $status }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">No invitations yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row (recent activity) -->

            </div>
        </section>
    </div>
@endsection