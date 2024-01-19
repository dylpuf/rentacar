<?php
include '../database/db.php';

session_start();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];

        $db = new Database();
        $user = $db->login($email);

        if ($user && isset($user['wachtwoord']) && password_verify($password, $user['wachtwoord'])) {
            $_SESSION['userId'] = $user['id'];
            $_SESSION['naam'] = $user['naam'];
            $_SESSION['role'] = $user['role'];
            header('Location: home.php?ingelogd');
            exit();
        } else {
            $loginError = "Incorrect email or password";
        }
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css"> 
</head>
<body>
    <div class="alles">
        <form action="login.php" method="post">
            <div class="Alles">
                <h1>Login</h1><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required> <br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required> <br><br>

                <button type="submit">Login</button>
            </div>
            <footer><p>Don't have a account?<a href="begin.php">Sign up</a></p></footer>
        </form>
        
        <?php
        if (isset($loginError)) {
            echo "<p>$loginError</p>";
        }
        ?>
    </div>
</body>
</html>
