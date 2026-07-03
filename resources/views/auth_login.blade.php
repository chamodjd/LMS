<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Sign In · Eduleb</title>
    <style>
        :root {
            --indigo: #5D5FEF;
            --indigo-dark: #4A4CD6;
            --navy: #1B1B33;
            --gray: #8A8AA3;
            --danger: #E14B4B;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(160deg, #FDF6E3 0%, #EFEBFB 60%, #E7E6FB 100%);
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 380px;
            background: #fff;
            border-radius: 18px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(27, 27, 51, 0.1);
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 28px;
        }

        h2 {
            font-size: 24px;
            color: var(--navy);
            margin: 0 0 6px 0;
            font-weight: 800;
        }

        .sub {
            color: var(--gray);
            font-size: 14px;
            margin-bottom: 26px;
        }

        .field {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1.5px solid #E4E4EF;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            background: #FAFAFD;
        }

        input:focus {
            border-color: var(--indigo);
            background: #fff;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 10px;
            background: var(--indigo);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 6px;
        }

        button:hover {
            background: var(--indigo-dark);
        }

        .error-msg {
            background: #FDEDED;
            color: var(--danger);
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="hero-text-img">
        <img src={{asset('assets/img/logo.png')}} alt="Logo">
    </div>

    @if ($errors->any())
        <div class="error-msg">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field" aria-placeholder="Email">
            <input type="email" id="email" name="email" required autocomplete="email" value="{{ old('email') }}"
                   placeholder="Enter Your Email"/>
        </div>
        <div class="field" aria-placeholder="Password">
            <input type="password" id="password" name="password" required autocomplete="current-password"
                   placeholder="Password"/>
        </div>
        <button type="submit">Sign In</button>
    </form>
</div>
</body>
</html>
