<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tertib Lolos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-hover: #45a049;
            --text-color: #333;
            --background-color: #f0f0f0;
            --input-bg: rgba(255, 255, 255, 0.9);
            --input-border: rgba(76, 175, 80, 0.5);
            --input-focus-shadow: rgba(76, 175, 80, 0.4);
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
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .filament-login:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .login-header {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 30px 20px;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 80%);
            transform: rotate(30deg);
        }

        .app-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .app-name {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .welcome-text {
            font-size: 18px;
            font-weight: 400;
            position: relative;
            z-index: 1;
        }

        .login-form {
            padding: 40px 30px;
        }

        .input-field {
            margin-bottom: 25px;
            position: relative;
        }

        .input-field label {
            display: block;
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .input-field input {
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            border: 2px solid var(--input-border);
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: var(--input-bg);
        }

        .input-field input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px var(--input-focus-shadow);
        }

        .input-field input:focus + label {
            color: var(--primary-color);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-hover);
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px;
            border: none;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login-button:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 480px) {
            .filament-login-container {
                padding: 10px;
            }

            .login-form {
                padding: 30px 20px;
            }

            .app-name {
                font-size: 22px;
            }

            .welcome-text {
                font-size: 16px;
            }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .app-logo {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="filament-login-container">
        <div class="filament-login">
            <div class="login-header">
                <img src="{{ asset('images/GambarTMJ.jpg') }}" alt="Tertib Lolos Logo" class="app-logo">
                <h1 class="app-name">Tertib Lolos</h1>
                <p class="welcome-text">Selamat Datang</p>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('filament.auth.login') }}">
                    @csrf

                    <div class="input-field">
                        <input type="text" name="login" id="login" value="{{ old('login') }}" required autofocus autocomplete="off">
                        <label for="login">Nama</label>
                    </div>

                    <div class="input-field">
                        <input type="password" name="password" id="password" required>
                        <label for="password">Password</label>
                        <span class="password-toggle" id="toggle-password">
                            <i class="fas fa-eye-slash"></i>
                        </span>
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

        const inputs = document.querySelectorAll('.input-field input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                input.previousElementSibling.classList.add('active');
            });
            input.addEventListener('blur', () => {
                if (input.value === '') {
                    input.previousElementSibling.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>

