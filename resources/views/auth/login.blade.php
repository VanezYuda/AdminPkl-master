<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: #f5f6fa;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .left-side {
            width: 50%;
            background: #3c4a63;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: white;
        }

        .left-side h1 {
            font-size: 30px;
            font-weight: 600;
            margin-top: 20px;
        }

        .right-side {
            width: 50%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 340px;
        }

        .login-box h2 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #111;
        }

        .login-box p {
            color: #666;
            font-size: 13px;
            margin-bottom: 25px;
        }

        label {
            font-size: 14px;
            font-weight: 500;
            color: #444;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #d2d6dc;
            margin-top: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }

        .show-pass {
            position: relative;
        }

        .toggle {
            position: absolute;
            right: 12px;
            top: 12px;
            cursor: pointer;
            font-size: 16px;
            color: #777;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #1e66f2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            margin-top: 5px;
        }

        .btn:hover {
            background: #1652c0;
        }

        .bottom-text {
            font-size: 13px;
            text-align: center;
            margin-top: 15px;
        }

        a {
            color: #1e66f2;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="left-side">
        <img src="{{ asset('images/whites.png') }}" width="80" alt="Logo">
        <h1>Kantina</h1>
    </div>

    <div class="right-side">
        <div class="login-box">

            <h2>Login Akun</h2>
            <p>Masukkan Username dan Password</p>

            {{-- error umum dari withErrors(['login' => '...']) --}}
            @if ($errors->has('login'))
                <p class="error">{{ $errors->first('login') }}</p>
            @endif

            {{-- error validasi field (username / password) --}}
            @if ($errors->has('username') || $errors->has('password'))
                <p class="error">
                    @error('username') {{ $message }}<br>@enderror
                    @error('password') {{ $message }}@enderror
                </p>
            @endif

            <form method="POST" action="{{ route('login.proses') }}">
                @csrf

                <label>Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required>

                <label>Password</label>
                <div class="show-pass">
                    <input type="password" id="password" name="password" required>

                    <!-- Icon Bootstrap -->
                    <i class="bi bi-eye-slash toggle" id="toggleIcon" onclick="togglePassword()"></i>
                </div>

                <button type="submit" class="btn">Login</button>
            </form>

            <div class="bottom-text">
               Tidak Bisa Login<br>
                Tolong Hubungi Admin
            </div>

        </div>
    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById("password");
        const icon = document.getElementById("toggleIcon");

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        }
    }
</script>

</body>
</html>
