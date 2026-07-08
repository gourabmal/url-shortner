@extends('common.layout.login_layout')
@section('login_layout')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in Admin</p>

            @include('messages')

            <div class="input-group" id="message_print"></div>

            <form method="post" id="loginForm" autocomplete="off">
                @csrf
                <div class="input-group">
                    <input type="email" name="user_name" id="user_name" onkeypress="hide_error_msg(this.name)" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>
                <span id="user_name_err" class="error-msg-print"></span>

                <div class="mb-3"></div>

                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" onkeypress="hide_error_msg(this.name)" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <span id="password_err" class="error-msg-print"></span>

                <div class="mb-3"></div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember_me" name="remember_me" value="remember_me">
                            <label for="remember_me">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>

            
        </div>
        <!-- /.login-card-body -->
    </div>

@push('login_script')
    <script>
        $('#message_print').html('');

        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            let close_success = document.getElementById("close_success");
            if (close_success) {
                close_success.click();
            }

            const insert = {
                user_name: $('#user_name').val(),
                password: $('#password').val(),
                remember_me: $('#remember_me').is(':checked') ? 'remember_me' : '',
                _token: '{{ csrf_token() }}'
            };

            document.getElementById("loader_run").style.visibility = "visible";

            $.ajax({
                method: "POST",
                url: "{{ route('admin_login_check') }}",
                data: insert,
                success: function(response) {
                    if (response.error) {
                        printValidationError(response.error);
                    } if (response.status === 'success') {
                        printSuccess(response.msg);
                        window.location.href = response.redirect;
                    } else if (response.status === 'error') {
                        printError(response.msg);
                    }
                    document.getElementById("loader_run").style.visibility = "hidden";
                },
                error: function(xhr) {
                    console.warn(xhr.responseText);
                    document.getElementById("loader_run").style.visibility = "hidden";
                }
            });
        });
    </script>
@endpush
@endsection
