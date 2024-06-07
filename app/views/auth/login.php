<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- icon -->
    <link rel="icon" type="image/x-icon" href="<?= APP_URL; ?>/img/wings_logo.svg">
    <link rel="stylesheet" href="<?= APP_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/css/bootstrap-4.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-container {
            width: 400px;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: white;
        }
        .login-container h2 {
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #00bfff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">LOGIN</h2>
        <form action="<?= APP_URL; ?>/auth/login" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Username" name="user" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <button type="submit" class="btn btn-custom btn-block">LOGIN</button>
        </form>
    </div>
    <script src="<?= APP_URL; ?>/js/jquery.min.js"></script>
    <script src="<?= APP_URL; ?>/js/popper.min.js"></script>
    <script src="<?= APP_URL; ?>/js/bootstrap.min.js"></script>
    <script src="<?= APP_URL; ?>/js/sweetalert2.min.js"></script>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 5000,
        });
    </script>
    <?php Flasher::flash(); ?>
</body>
</html>
