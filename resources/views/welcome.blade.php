<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('Welcome') }} - {{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/jpg">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: system-ui, sans-serif;
        }

        /* BACKGROUND IMAGE */
        .bg {
            position: fixed;
            inset: 0;
            background: url("{{ asset('images/journey.jpg') }}") center/cover no-repeat;
        }

        /* VERY LIGHT OVERLAY (LOW OPACITY ONLY) */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.20); /* soft dim only */
        }

        /* CENTER WRAPPER */
        .container {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* CARD */
        .card {
            width: 100%;
            max-width: 420px;

            background: #fffbeb;
            border: 1px solid #f3e2b3;

            border-radius: 14px;
            padding: 40px 30px;

            box-shadow: 0 20px 50px rgba(0,0,0,0.18);
            text-align: center;
        }

        .title {
            font-size: 22px;
            font-weight: 800;
            color: #92400e;
            margin-bottom: 6px;
        }

        .subtitle {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 12px;
            border-radius: 10px;

            background: #d97706;
            color: white;

            font-weight: 600;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .btn:hover {
            background: #b45309;
            transform: translateY(-2px);
        }

        @media (max-width: 480px) {
            .card {
                padding: 28px 18px;
            }

            .title {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

<div class="bg"></div>
<div class="overlay"></div>

<div class="container">
    <div class="card">

        <div class="title">BOC - VBS2026</div>
        <div class="subtitle">Welcome to the system portal</div>

        @if (Route::has('login'))
            @auth
                <a href="{{ route('dashboard') }}" class="btn">
                    Enter Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn">
                    Login
                </a>
            @endauth
        @endif

    </div>
</div>

</body>
</html>
