@extends('common.layout.admin_layout')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Invite Company Admin</h1>

            <a href="{{ route('superadmin.invitations.index') }}" class="btn btn-secondary">
               <i class="fa fa-list"></i> View Invitations
            </a>
        </div>
    </section>

    <section class="content">

        @include('messages')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Company Information</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('superadmin.invitations.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="company_name">Company Name <span class="text-danger">*</span></label>

                        <input
                            type="text"
                            id="company_name"
                            name="company_name"
                            class="form-control @error('company_name') is-invalid @enderror"
                            value="{{ old('company_name') }}"
                            placeholder="Enter company name"
                            required>

                        @error('company_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Admin Name <span class="text-danger">*</span></label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Enter admin name"
                            required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="email">Admin Email <span class="text-danger">*</span></label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="Enter admin email"
                            required>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane"></i> Send Invitation
                    </button>

                    <a href="{{ route('superadmin.invitations.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>
        </div>

    </section>

</div>

@endsection
