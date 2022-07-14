<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/public/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/public/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

    </style>
</head>


<body data-sidebar="dark">
    <main>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="alert alert-danger">
                            Incorrect Username/Password
                        </div>
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">
                                                <span class="lead">
                                                    Welcome Back !
                                                </span>
                                            </h5>
                                            <p class='lead'>Sign in to continue to </p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="/public/assets/images/profile-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="auth-logo">
                                    <a href="" class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="/public/assets/images/logo.png'" alt=""
                                                    class="rounded-circle" height="70">
                                            </span>
                                        </div>
                                    </a>

                                    <a href="" class="auth-logo-dark">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="/public/assets/images/logo.png" alt=""
                                                    class="rounded-circle" height="70">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2">
                                    <form class="form-horizontal" method="POST" action="login-post">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">
                                                <span class="lead">
                                                    Username
                                                </span>
                                            </label>
                                            <input type="username" name="username"
                                                class="form-control form-control-lg rounded-0"
                                                id="username" placeholder="Enter username"
                                                value="">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">
                                                <span class="lead">
                                                    Password
                                                </span>
                                            </label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" name="password"
                                                    class="form-control form-control-lg  rounded-0"
                                                    placeholder="Enter password" aria-label="Password"
                                                    aria-describedby="password-addon">
                                                <button class="btn btn-light " tabindex="-1" type="button"
                                                    id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>

                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light text-uppercase"
                                                type="submit">
                                                <span class="lead">
                                                    Log In
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="/public/assets/libs/jquery/jquery.min.js"></script>
    <script src="/public/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/public/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/public/assets/libs/node-waves/waves.min.js"></script>
    <script src="/public/assets/js/app.js"></script>
</body>

</html>
