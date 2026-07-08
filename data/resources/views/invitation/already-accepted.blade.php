<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation Already Accepted</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Invitation Already Used</h4>
                    </div>

                    <div class="card-body text-center">

                        <h5>This invitation has already been accepted.</h5>

                        <p class="mt-3">
                            If you already have an account, please log in.
                        </p>

                        <a href="{{ route('admin::login') }}" class="btn btn-primary">
                            Go to Login
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>