<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login' }}</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* body {
            background-color: #fff; 
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-card {
            background: #ccc;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 0 20px rgba(255,255,255,0.07);
            color: #fff;
        }

        .auth-card label {
            color: #111;
        }

        .btn-custom {
            background: #f1c40f;
            color: #000;
            font-weight: 600;
        }

        .btn-custom:hover {
            background: #ffd23a;
        }

        a {
            color: #f1c40f;
        }

        a:hover {
            color: #ffe57e;
        } */
    </style>
</head>

<body>

    <div class="auth-card">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- J query cdn link -->
     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- JQuery validator cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    @stack('js')
</body>

</html>