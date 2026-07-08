@extends('common.layout.admin_layout')

@section('title', 'Invite Member')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Invite User</h1>

            <a href="{{ route('admin.invitations.index') }}" class="btn btn-secondary">
                <i class="fa fa-list"></i> View Invitations
            </a>
        </div>
    </section>

    <section class="content">

        @include('messages')

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Invitation Details</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('admin.invitations.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">
                            Full Name <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            placeholder="Enter full name"
                            required>

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">
                            Email Address <span class="text-danger">*</span>
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="Enter email address"
                            required>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="role">
                            Role <span class="text-danger">*</span>
                        </label>

                        <select
                            id="role"
                            name="role"
                            class="form-control @error('role') is-invalid @enderror"
                            required>

                            <option value="">-- Select Role --</option>

                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="Member" {{ old('role') == 'Member' ? 'selected' : '' }}>
                                Member
                            </option>

                        </select>

                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane"></i> Send Invitation
                    </button>

                    <a href="{{ route('admin.invitations.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>
        </div>

    </section>

</div>

@endsection