<?php
/**
 * Login - PadosiAgent Admin
 * Premium Design | Secure Authentication
 */
require_once 'database.php'; // config.php is included here via database.php

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        try {
            // Use prepared statements for 100% security
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            $admin = $stmt->fetch();

            if ($admin) {
                // Check if password matches (handling both hashed and plain for existing users)
                // Check if password matches (supporting both hashed and plain text)
                $isValid = password_verify($password, $admin['password']) || ($password === $admin['password']);

                if ($isValid) {
                    $_SESSION['admin_auth'] = true;
                    $_SESSION['admin_user'] = $admin['name'];
                    $_SESSION['admin_email'] = $admin['email'];
                    
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error = "Invalid email or password.";
                }
            } else {
                $error = "Admin account not found.";
            }
        } catch (PDOException $e) {
            $error = "A system error occurred. Please try again later.";
        }
    } else {
        $error = "Please enter both email and password.";
    }
}

// If already logged in, skip login page
if (isset($_SESSION['admin_auth']) && $_SESSION['admin_auth'] === true) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - PadosiAgent</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #0061ff;
      --secondary: #64748b;
      --bg: #f8fafc;
      --card-bg: rgba(255, 255, 255, 0.9);
      --input-border: #e2e8f0;
      --text-main: #1e293b;
    }

    body {
      font-family: 'Inter', system-ui, sans-serif;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);
      color: var(--text-main);
    }

    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: radial-gradient(circle at 10% 20%, rgba(0, 97, 255, 0.05) 0%, transparent 40%),
                  radial-gradient(circle at 90% 80%, rgba(0, 97, 255, 0.05) 0%, transparent 40%);
      z-index: -1;
    }

    .login-container {
      width: 100%;
      max-width: 420px;
      padding: 20px;
    }

    .login-logo {
      text-align: center;
      margin-bottom: 32px;
    }

    .login-logo img {
      width: 220px;
      height: auto;
    }

    .card {
      background: var(--card-bg);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.8);
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .title {
      font-size: 24px;
      font-weight: 800;
      margin: 0 0 8px;
      text-align: center;
      color: #0f172a;
    }

    .subtitle {
      font-size: 14px;
      color: var(--secondary);
      margin-bottom: 32px;
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-size: 14px;
      font-weight: 600;
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid var(--input-border);
      border-radius: 12px;
      font-size: 15px;
      font-family: inherit;
      box-sizing: border-box;
      transition: all 0.2s;
      background: white;
    }

    input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(0, 97, 255, 0.1);
    }

    .btn {
      width: 100%;
      background: var(--primary);
      color: white;
      border: none;
      padding: 14px;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 8px;
      box-shadow: 0 4px 6px -1px rgba(0, 97, 255, 0.2);
    }

    .btn:hover {
      background: #0056e0;
      transform: translateY(-1px);
      box-shadow: 0 10px 15px -3px rgba(0, 97, 255, 0.3);
    }

    .btn:active {
      transform: translateY(0);
    }

    .error-box {
      background: #fef2f2;
      color: #b91c1c;
      padding: 12px;
      border-radius: 12px;
      font-size: 13px;
      margin-bottom: 20px;
      border: 1px solid #fee2e2;
      text-align: center;
      font-weight: 500;
      animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
    }

    @keyframes shake {
      10%, 90% { transform: translate3d(-1px, 0, 0); }
      20%, 80% { transform: translate3d(2px, 0, 0); }
      30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
      40%, 60% { transform: translate3d(4px, 0, 0); }
    }

    .footer {
      text-align: center;
      margin-top: 32px;
      color: var(--secondary);
      font-size: 13px;
    }
  </style>
</head>
<body>

<div class="login-container">
  <div class="login-logo">
    <img src="images/logo.png" alt="PadosiAgent Admin">
  </div>

  <div class="card">
    <h1 class="title">Welcome Back</h1>
    <p class="subtitle">Enter your credentials to access the admin panel</p>

    <?php if ($error): ?>
      <div class="error-box"><?= h($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label>Email Address</label>
        <input type="email" name="email" placeholder="admin@padosiagent.com" required autofocus>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>
      </div>

      <button type="submit" class="btn">Sign In</button>
    </form>
  </div>

  <div class="footer">
    &copy; <?= date('Y') ?> PadosiAgent Admin Panel. All Rights Reserved.
  </div>
</div>

</body>
</html>
