<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accept Invitation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Accept Invitation</h4>
                    </div>

                    <div class="card-body">

                        <p>
                            You have been invited to join
                            <strong>{{ $invitation->company->name }}</strong>.
                        </p>

                        <hr>

                        <div class="mb-3">
                            <strong>Name</strong>
                            <div>{{ $invitation->name }}</div>
                        </div>

                        <div class="mb-3">
                            <strong>Email</strong>
                            <div>{{ $invitation->email }}</div>
                        </div>

                        <div class="mb-3">
                            <strong>Role</strong>
                            <div>{{ $invitation->role }}</div>
                        </div>

                        <div class="mb-3">
                            <strong>Invitation Expires</strong>
                            <div>{{ $invitation->expires_at->format('d M Y h:i A') }}</div>
                        </div>

                        <hr>

                        <div class="alert alert-info mb-0">
                            <div class="d-grid gap-2">

                                <form method="POST"
                                    action="{{ route('invitation.accept.submit', $invitation->token) }}">
                                    @csrf

                                    <button class="btn btn-success w-100">
                                        Accept Invitation
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('invitation.reject', $invitation->token) }}">
                                    @csrf

                                    <button class="btn btn-danger w-100">
                                        Reject Invitation
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>
