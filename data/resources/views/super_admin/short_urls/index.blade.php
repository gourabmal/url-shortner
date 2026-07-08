@extends('common.layout.admin_layout')

@section('title', 'Short URLs')

@section('content')
    <div class="content-wrapper" style="min-height: 357px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Short URLs</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('superadmin.dashboard')}}">Dashboard</a> </li>
                            <li class="breadcrumb-item active">Short URLs</li>
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
                                <h3 class="card-title">All Short URLs</h3>
                                {{-- <h3 class="card-title" style="float: right!important;">
                                    <a href="{{ route('super.short-urls.create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create Short URL</a>
                                </h3> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                 @include('messages')

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Short URL</th>
                                        <th>Destination URL</th>
                                        <th>Company</th>
                                        <th>Clicks</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Created</th>
                                    </tr>
                                    </thead>
                                        <tbody>

                                        @forelse($shortUrls as $url)

                                            <tr>

                                                <td>{{ $url->id }}</td>

                                                <td>
                                                    <a href="{{ url($url->code) }}"
                                                       target="_blank">

                                                        {{ url($url->code) }}

                                                    </a>
                                                </td>

                                                <td style="max-width:350px;word-break:break-all;">
                                                    {{ $url->destination_url }}
                                                </td>

                                                <td>{{ $url->company?->name }}</td>

                                                <td>{{ $url->clicks }}</td>

                                                <td>

                                                    @if($url->is_active)

                                                        <span class="badge badge-success">
                                                            Active
                                                        </span>

                                                    @else

                                                        <span class="badge badge-danger">
                                                            Disabled
                                                        </span>

                                                    @endif

                                                </td>

                                                <td>{{ $url->creator?->name }}</td>

                                                <td>{{ $url->created_at->format('d M Y') }}</td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td colspan="8" class="text-center">

                                                    No Short URLs Found

                                                </td>

                                            </tr>

                                        @endforelse

                                        </tbody>
                                    </table>

                                @if($shortUrls->hasPages())
                                    <div class="mt-3">
                                        {{ $shortUrls->links() }}
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection