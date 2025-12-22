<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #000;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .btn {
            padding: 15px 40px;
            background: #ffffff;
            color: #000000;
            border-radius: 50px;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .btn:hover {
            background: #f1c40f;
            color: #000;
            transform: scale(1.1);
        }
    </style>
</head>
<body>

    <a href="{{ url('/login') }}" class="btn">Go to Login</a>

</body>
</html>
