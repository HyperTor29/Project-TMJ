<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tertib Izin Lintas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-hover: #45a049;
            --primary-light: rgba(76, 175, 80, 0.1);
            --text-color: #333;
            --text-muted: #666;
            --background-color: #f0f0f0;
            --input-bg: rgba(255, 255, 255, 0.95);
            --input-border: rgba(76, 175, 80, 0.3);
            --input-focus-shadow: rgba(76, 175, 80, 0.2);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-hover-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
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
            background-image: url("{{ asset('images/LoginPage.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .filament-login {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            transform-style: preserve-3d;
        }

        .filament-login:hover {
            transform: translateY(-5px) rotateX(5deg);
            box-shadow: var(--card-hover-shadow);
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color), #2E7D32);
            color: white;
            text-align: center;
            padding: 40px 20px;
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
            animation: shimmer 8s linear infinite;
        }

        @keyframes shimmer {
            0% { transform: rotate(30deg) translateY(0%); }
            100% { transform: rotate(30deg) translateY(50%); }
        }

        .app-logo {
            width: 160px;
            height: 100px;
            margin: 0 auto 20px auto;
            display: block;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            animation: float 4s ease-in-out infinite;
        }

        .app-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-text {
            font-size: 18px;
            font-weight: 400;
            position: relative;
            z-index: 1;
            opacity: 0.9;
        }

        .login-form {
            padding: 40px 30px;
            background-color: rgba(255, 255, 255, 0.8); /* Added transparency */
            border-radius: 12px; /* Optional: Add border-radius for better appearance */
        }

        .input-field {
            margin-bottom: 25px;
            position: relative;
        }

        .input-field label {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: var(--text-muted);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
            margin-bottom: 0;
        }

        .input-field input {
            width: 100%;
            /* padding: 16px 15px; */
            border-radius: 12px;
            border: 2px solid var(--input-border);
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: var(--input-bg);
        }

        .input-field input:focus,
        .input-field input:not(:placeholder-shown) {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px var(--input-focus-shadow);
        }

        .input-field input:focus + label,
        .input-field input:not(:placeholder-shown) + label {
            transform: translateY(-170%) scale(0.85);
            background-color: white;
            padding: 0 6px;
            color: var(--primary-color);
            font-weight: 500;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-muted);
            transition: all 0.3s ease;
            padding: 5px;
            border-radius: 50%;
            background-color: var(--primary-light);
        }

        .password-toggle:hover {
            color: var(--primary-color);
            background-color: var(--primary-light);
            transform: translateY(-50%) scale(1.1);
        }

        .login-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, var(--primary-color), #2E7D32);
            color: white;
            border-radius: 12px;
            border: none;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .login-button:hover::before {
            left: 100%;
        }

        @media (max-width: 480px) {
            .filament-login-container {
                padding: 15px;
            }

            .login-form {
                padding: 30px 20px;
            }

            .app-name {
                font-size: 24px;
            }

            .welcome-text {
                font-size: 16px;
            }

            .app-logo {
                width: 80px;
                height: 80px;
            }

            .input-field input {
                padding: 14px 12px;
            }
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-10px) rotate(-3deg); }
            75% { transform: translateY(10px) rotate(3deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        /* Error states */
        .input-field.error input {
            border-color: #dc3545;
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
        }

        .input-field.error label {
            color: #dc3545;
        }

        /* Success states */
        .input-field.success input {
            border-color: var(--primary-color);
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .error-message i {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="filament-login-container">
        <div class="filament-login">
            <div class="login-header">
                <img src="{{ asset('images/GambarTMJ.jpg') }}" alt="Tertib Lolos Logo" class="app-logo">
                <h1 class="app-name">Tertib Izin Lintas</h1>
                <p class="welcome-text">Selamat Datang Kembali</p>
            </div>
            <div class="login-form">
                <form method="POST" action="{{ route('filament.auth.login') }}" id="loginForm">
                    @csrf

                    <div class="input-field">
                        <input
                            type="text"
                            name="login"
                            id="login"
                            value="{{ old('login') }}"
                            required
                            autofocus
                            autocomplete="off"
                            placeholder=" "
                        >
                        <label for="login">Nama Pengguna</label>
                        @error('login')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="input-field">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            placeholder=" "
                        >
                        <label for="password">Kata Sandi</label>
                        <span class="password-toggle" id="toggle-password" title="Tampilkan/Sembunyikan kata sandi">
                            <i class="fas fa-eye-slash"></i>
                        </span>
                        @error('password')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="login-button">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password');
        const loginForm = document.getElementById('loginForm');

        let passwordVisible = false;

        togglePassword.addEventListener('click', function() {
            passwordVisible = !passwordVisible;
            passwordField.type = passwordVisible ? 'text' : 'password';
            togglePassword.innerHTML = `<i class="fas fa-eye${passwordVisible ? '' : '-slash'}"></i>`;
        });

        // Improved form validation
        loginForm.addEventListener('submit', function(e) {
            const inputs = this.querySelectorAll('input[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.parentElement.classList.add('error');
                } else {
                    input.parentElement.classList.remove('error');
                    input.parentElement.classList.add('success');
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });

        // Real-time validation
        const inputs = document.querySelectorAll('.input-field input');
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                if (input.value.trim()) {
                    input.parentElement.classList.remove('error');
                    input.parentElement.classList.add('success');
                } else {
                    input.parentElement.classList.remove('success');
                }
            });
        });

        // Add loading state to button on form submit
        loginForm.addEventListener('submit', function() {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Memproses...';
            button.disabled = true;
        });
    </script>
</body>
</html>
