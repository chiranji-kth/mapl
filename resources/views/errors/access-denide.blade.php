<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Access Denied - MAPL</title>

    <link rel="stylesheet" href="{{ asset('admin_assets/bootstrap/dist/css/bootstrap.min.css') }}">

    <style>
        body {
            background: linear-gradient(145deg, #f6f9fc, #e9eef5);
            font-family: "Segoe UI", sans-serif;
            height: 100vh;
            margin: 0;
        }

        .error-container {
            max-width: 550px;
            margin: auto;
            margin-top: 8%;
            padding: 40px;
            background: #ffffff;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
            animation: fadeIn 0.7s ease-in-out;
        }

        .error-icon {
            font-size: 70px;
            color: #ff4f4f;
            margin-bottom: 15px;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0.8;
            }
        }

        .error-title {
            font-size: 42px;
            font-weight: 700;
            color: #e63939;
            margin-bottom: 10px;
        }

        .error-text {
            font-size: 16px;
            color: #555;
            line-height: 26px;
            padding: 0 20px;
        }

        .btn-home {
            margin-top: 25px;
            padding: 10px 28px;
            border-radius: 8px;
            background-color: #2f8dee;
            color: #fff !important;
            font-size: 15px;
            transition: 0.3s ease;
        }

        .btn-home:hover {
            background-color: #1c6fc4;
        }

        footer {
            margin-top: 25px;
            color: #888;
            font-size: 13px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="error-container">
        <div class="error-icon">⚠️</div>

        <h1 class="error-title">Access Denied</h1>

        <p class="error-text">
            You do not have permission to view this page.<br>
            If you believe this is a mistake, please contact your administrator.
        </p>

        <a href="{{ url('dashboard') }}" class="btn btn-home">
            Go to Dashboard
        </a>

        <!-- <footer>
            © {{ date('Y') }} <strong>Next Dot</strong> • All Rights Reserved
        </footer> -->
    </div>

</body>

</html>