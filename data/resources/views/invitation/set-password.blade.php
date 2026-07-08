<!DOCTYPE html>
<html>
<head>
    <title>Set Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header">
                    <h4 class="mb-0">Create Your Password</h4>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('invitation.store-password', $user) }}">

                        @csrf

                        <div class="mb-3">
                            <label>Email</label>

                            <input
                                class="form-control"
                                value="{{ $user->email }}"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Save Password
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>