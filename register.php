<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $errors = [];

    if (empty($name) || empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $errors[] = "Email already registered.";
    }
    $stmt->close();

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        
        if ($stmt->execute()) {
            $_SESSION['user_email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            $errors[] = "Registration failed. Please try again.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            min-height: 100vh;
            height: 100%;
            font-family: 'Nunito', Arial, sans-serif;
            display: flex;
        }
        .split-left {
            width: 50vw;
            background: #f8efd9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .logo-img {
            width: 540px;
            max-width: 90vw;
            margin-bottom: 18px;
        }
        .brand-title {
            font-size: 2.8rem;
            font-family: 'Nunito', cursive;
            color: #226b3a;
            font-weight: 700;
            letter-spacing: 8px;
            margin-bottom: 8px;
        }
        .brand-tagline {
            color: #b85c1c;
            font-size: 1.05rem;
            margin-top: 0;
            letter-spacing: 0.5px;
        }
        .split-right {
            width: 50vw;
            background: #065b2e;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-card {
            background: #f8efd9;
            border-radius: 12px;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.10);
            padding: 38px 38px 28px 38px;
            min-width: 340px;
            max-width: 370px;
            text-align: center;
        }
        .form-title {
            color: #f7b32b;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 6px;
        }
        .form-subtitle {
            color: #b85c1c;
            font-size: 0.95rem;
            margin-bottom: 18px;
        }
        .error {
            color: #ed4956;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .form-group {
            margin-bottom: 14px;
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            background: #fff;
            border: 1px solid #dbdbdb;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
            font-family: 'Nunito', Arial, sans-serif;
            margin-bottom: 6px;
        }
        input:focus {
            border-color: #43cea2;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #065b2e;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin: 14px 0 0 0;
            transition: background 0.3s, transform 0.2s;
        }
        button:hover {
            background: #226b3a;
            transform: translateY(-2px) scale(1.03);
        }
        .login-link {
            margin-top: 18px;
            font-size: 14px;
        }
        .login-link a {
            color: #226b3a;
            text-decoration: none;
            font-weight: 700;
        }
        @media (max-width: 900px) {
            .split-left, .split-right {
                width: 100vw;
                min-width: 0;
            }
            body {
                flex-direction: column;
            }
        }
        @media (max-width: 600px) {
            .split-left {
                display: none;
            }
            .split-right {
                width: 100vw;
            }
            .form-card {
                min-width: unset;
                width: 100vw;
                border-radius: 0;
                box-shadow: none;
                padding: 28px 10vw 18px 10vw;
            }
        }
    </style>
</head>
<body>
    <div class="split-left">
        <img src="no-bg-logo.png" alt="Logo" class="logo-img" />
    </div>
    <div class="split-right">
        <div class="form-card">
            <div class="form-title">REGISTER</div>
            <div class="form-subtitle">Create your CALASAG account</div>
            <?php if (!empty($errors)): ?>
                <div class="error">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="Full Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <button type="submit">Sign Up</button>
                <div class="login-link">
                    Have an account? <a href="index.php">Log in</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>