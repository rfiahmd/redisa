<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Template</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f4f4;
    }

    .email-container {
      max-width: 600px;
      margin: 30px auto;
      background: #ffffff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .email-header {
      text-align: center;
      background: linear-gradient(135deg, #007bff, #0056b3);
      color: white;
      padding: 20px;
      border-radius: 10px 10px 0 0;
    }

    .email-footer {
      text-align: center;
      font-size: 14px;
      color: #6c757d;
      padding: 15px;
      background: #f1f1f1;
      border-radius: 0 0 10px 10px;
    }

    .btn-login {
      display: block;
      width: 100%;
      text-align: center;
      background: #007bff;
      color: white;
      padding: 12px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }

    .btn-login:hover {
      background: #003d82;
    }

    .email-body {
      padding: 20px;
      text-align: center;
    }

    .email-body p {
      font-size: 16px;
      color: #333;
    }

    .user-details {
      background: #eef5ff;
      padding: 15px;
      border-radius: 5px;
      margin: 20px 0;
    }
  </style>
</head>

<body>
  <div class="email-container">
    <div class="email-header">
      <h2>Selamat Datang di ReDisa</h2>
    </div>
    <div class="email-body">
      <p>Halo <strong>{{ $nama_lengkap }}</strong>,</p>
      <p>Akun Anda telah berhasil dibuat dengan rincian sebagai berikut:</p>
      <div class="user-details">
        <p><strong>Username:</strong> {{ $username }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Password:</strong> {{ $password }}</p>
      </div>
      <p>Silakan klik tombol di bawah ini untuk masuk ke akun Anda:</p>
      <a href="{{ route('login') }}" class="btn-login">Login Sekarang</a>
    </div>
    <div class="email-footer">
      <p>&copy; 2025 Perusahaan Anda. Semua Hak Dilindungi.</p>
    </div>
  </div>
</body>

</html>
