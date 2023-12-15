<x-guest-layout>
    <style>
        /* Example styles for Google Drive style login page */
        
        /* Overall login container */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        /* Login box */
        .login-box {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Drive logo */
        .drive-logo {
            width: 150px;
            margin-bottom: 20px;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .error {
            color: #ff0000;
            font-size: 14px;
            display: block;
            margin-top: 5px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-checkbox {
            margin-right: 10px;
        }

        .remember-label {
            font-size: 14px;
        }

        /* Forgot password link */
        .forgot-password {
            display: block;
            margin-bottom: 20px;
            color: #4285f4;
            text-decoration: none;
            font-size: 14px;
        }

        /* Login button */
        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #3367d6;
        }
    </style>

    <div class="login-container">
        <div class="login-box">
            <img src="{{ asset('images/google-drive-logo.png') }}" alt="Google Drive Logo" class="drive-logo">
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf
                <!-- Email Address -->
                <div class="form-group">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Email" class="form-control">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Password -->
                <div class="form-group">
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password" class="form-control">
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Remember Me -->
                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember" class="remember-checkbox">
                    <label for="remember_me" class="remember-label">Remember me</label>
                </div>
                <!-- Forgot Password Link -->
                <a href="{{ route('password.request') }}" class="forgot-password">Forgot your password?</a>
                <!-- Login Button -->
                <button type="submit" class="login-button">Log in</button>
            </form>
        </div>
    </div>
</x-guest-layout>
