<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Johen Gaming</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Poppins', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #1e3c72 0%, #2b3b90 50%, #6a1b9a 100%); padding: 24px; }
        .login-card { background: white; border-radius: 20px; padding: 48px 40px; width: 100%; max-width: 420px; box-shadow: 0 24px 64px rgba(0,0,0,0.3); }
        .login-logo { text-align: center; margin-bottom: 32px; }
        .login-logo-icon { width: 64px; height: 64px; background: linear-gradient(135deg, #1e3c72, #6a1b9a); border-radius: 16px; display: inline-flex; align-items: center; justify-content: center; color: white; font-size: 24px; font-weight: 800; margin-bottom: 12px; }
        .login-logo h1 { font-size: 22px; font-weight: 800; color: #1a1a2e; }
        .login-logo p { font-size: 13px; color: #6b7280; margin-top: 4px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #1a1a2e; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 14px 12px 40px; border: 1.5px solid #e5e7eb; border-radius: 10px; font-family: 'Poppins', sans-serif; font-size: 14px; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-control:focus { border-color: #2b59c3; box-shadow: 0 0 0 3px rgba(43,89,195,0.1); }
        .form-control.is-invalid { border-color: #ef4444; }
        .invalid-feedback { color: #ef4444; font-size: 12px; margin-top: 4px; }
        .btn-login { width: 100%; padding: 14px; background: linear-gradient(135deg, #1e3c72, #6a1b9a); color: white; border: none; border-radius: 10px; font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 700; cursor: pointer; transition: opacity 0.2s, transform 0.2s; margin-top: 8px; }
        .btn-login:hover { opacity: 0.9; transform: translateY(-1px); }
        .back-link { text-align: center; margin-top: 20px; font-size: 13px; color: #6b7280; }
        .back-link a { color: #2b59c3; text-decoration: none; font-weight: 500; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <img src="{{ asset('img/icon/icon_mengambang_logo.png') }}" alt="Johen Gaming" style="height:80px;width:auto;object-fit:contain;margin-bottom:12px;filter:drop-shadow(0 4px 12px rgba(26,63,168,0.25));">
            <h1>Admin Panel</h1>
            <p>PT. Johen Sukses Abadi — Masuk untuk melanjutkan</p>
        </div>

        @if($errors->any())
        <div style="background:#fee2e2;color:#991b1b;padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:20px;border-left:3px solid #ef4444">
            <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="admin@johengaming.com" required autofocus>
                </div>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> Masuk</button>
        </form>
        <div class="back-link"><a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke Website</a></div>
    </div>
</body>
</html>
