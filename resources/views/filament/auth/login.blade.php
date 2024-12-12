<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-hover: #45a049;
            --text-color: #333;
            --background-color: #f0f0f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url("{{ asset('images/GambarTol.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .filament-login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .filament-login {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .filament-login:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .login-header {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .login-header h2 {
            font-size: 28px;
            font-weight: 600;
        }

        .login-form {
            padding: 30px;
        }

        .input-field {
            margin-bottom: 20px;
            position: relative;
        }

        .input-field label {
            display: block;
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .input-field input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .input-field input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--primary-color);
        }

        .remember-me {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 20px;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: var(--primary-hover);
        }

        @media (max-width: 480px) {
            .filament-login-container {
                padding: 10px;
            }

            .login-form {
                padding: 20px;
            }

            .login-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="filament-login-container">
        <div class="filament-login">
            <div class="login-header">
                <h2>Selamat Datang</h2>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('filament.auth.login') }}">
                    @csrf

                    <div class="input-field">
                        <label for="login">Nama</label>
                        <input type="text" name="login" id="login" value="{{ old('login') }}" required autofocus autocomplete="off">
                    </div>

                    <div class="input-field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                        <span class="password-toggle" id="toggle-password">
                            <i class="fas fa-eye-slash"></i>
                        </span>
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Ingat Password</label>
                    </div>

                    <button type="submit" class="login-button">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password');

        let passwordVisible = false;

        togglePassword.addEventListener('click', function() {
            passwordVisible = !passwordVisible;
            if (passwordVisible) {
                passwordField.type = 'text';
                togglePassword.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                passwordField.type = 'password';
                togglePassword.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });
    </script>
</body>
</html>
