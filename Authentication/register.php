<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        h1,
        h2,
        h3,
        h4,
        h1,
        h6,
        p,
        label {
            margin: 0px !important;
            padding: 0px !important;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid vh-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col col-12 col-md-8 col-lg-7 col-xl-5 col-xxl-4">
                <form action="../operations/op_register.php" method="POST">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Register</h1>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Fill out the form carfully to register</h6>
                            <div class="row">
                                <div class="col">
                                    <label for="fname">First name</label>
                                    <input type="text" name="fname" id="fname" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="lname">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="pw">Password</label>
                                    <input type="password" name="pw" id="pw" class="form-control">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mt-3">Sign up</button>
                            <div class="row text-center mt-2">
                                <p>Already have an account? <a href="login.php"> Sign in</a></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</body>

</html>