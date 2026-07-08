<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation Cancelled</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Invitation Cancelled</h4>
                    </div>

                    <div class="card-body text-center">

                        <div class="mb-4">
                            <h5 class="text-danger">
                                You have cancelled this invitation.
                            </h5>

                            <p class="text-muted mt-3">
                                The invitation has been marked as <strong>Cancelled</strong>.
                                If this was a mistake, please contact the administrator to send you a new invitation.
                            </p>
                        </div>

                        <a href="{{ route('frontend.index') }}" class="btn btn-primary">
                            Go to Home
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>