<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - إدارة الحسابات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .login-card {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card login-card border-0">
                    <div class="card-header login-header text-center py-4">
                        <i class="fas fa-calculator fa-3x mb-3"></i>
                        <h3>إدارة الحسابات</h3>
                        <p class="mb-0">تسجيل الدخول للنظام</p>
                    </div>
                    <div class="card-body p-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="email" class="form-label">
                                    <i class="fas fa-user me-2"></i>اسم المستخدم
                                </label>
                                <input id="email" type="text" 
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>كلمة المرور
                                </label>
                                <input id="password" type="password" 
                                       class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       name="password" required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        تذكرني
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-login btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>دخول
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <small class="text-white">
                        <i class="fas fa-shield-alt me-2"></i>
                        نظام محمي - يتطلب تسجيل الدخول
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
