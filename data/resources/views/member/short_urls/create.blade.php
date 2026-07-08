@extends('common.layout.admin_layout')

@section('title', 'Create Short URL')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Create Short URL</h1>

            <a href="{{ route('member.short-urls.index') }}" class="btn btn-secondary">
                <i class="fa fa-list"></i> View Short URLs
            </a>
        </div>
    </section>

    <section class="content">

        @include('messages')

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Short URL Details</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('member.short-urls.store') }}" method="POST">

                    @csrf

                    <div class="form-group mb-4">
                        <label for="destination_url">
                            Destination URL
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="url"
                            id="destination_url"
                            name="destination_url"
                            class="form-control @error('destination_url') is-invalid @enderror"
                            value="{{ old('destination_url') }}"
                            placeholder="https://example.com"
                            required>

                        @error('destination_url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <small class="text-muted">
                            Enter the full URL including <strong>https://</strong>.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-link"></i> Generate Short URL
                    </button>

                    <a href="{{ route('member.short-urls.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </section>

</div>

@endsection