<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-lg rounded-4">
                <div class="card-body p-4">
                    <h4 class="text-center mb-4">Register</h4>

                    <div id="alert"></div>

                    <form id="loginForm", action="/register" method="post">
                        @csrf
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                        
                    </form>
                    <p>Sudah punya akun? <a href="/login">Login</a></p>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
