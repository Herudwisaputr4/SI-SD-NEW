<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Admin Panel</title>
    <link rel="shortcut icon" type="image/png" href="{{ url('public') }}/assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="{{ url('public') }}/assets/css/styles.min.css" />
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
        data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">

        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0 shadow-lg">
                            <div class="card-body">
                                <!-- Logo -->
                                <a href="{{ url('login') }}"
                                    class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ url('public') }}/assets/images/logos/logosisd.png" width="180" alt="Logo">
                                </a>

                                <!-- Copywriting -->
                                <div class="text-center mb-4">
                                    <h4 class="fw-bold text-primary">Selamat Datang!</h4>
                                    <p class="text-muted small">Masuk untuk mengelola data dengan cepat dan efisien.<br>Sistem Informasi yang cerdas untuk solusi pendidikan yang lebih baik.</p>
                                </div>

                                <!-- Alert -->
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
 
                                <!-- Form -->
                                <form action="{{ url('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="username"
                                            aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-2 fs-5 mb-3 rounded-2">Masuk Sekarang</button>
                                </form>
                            </div>
                        </div>
                        <p class="text-center text-muted mt-3 small">© {{ date('Y') }} Sistem Informasi Sekolah Dasar. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('public') }}/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('public') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
