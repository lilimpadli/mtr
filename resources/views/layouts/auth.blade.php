<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Rental Motor - Auth</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f1f3f5;
      font-family: 'Poppins', sans-serif;
    }
    .auth-container {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .auth-card {
      width: 100%;
      max-width: 400px;
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <div class="card auth-card shadow">
      <div class="card-body">
        @yield('content')
      </div>
    </div>
  </div>
</body>
</html>
