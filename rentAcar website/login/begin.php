<?php
include '../database/db.php';

session_start();

// Signup Process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $wachtwoord = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $db = new Database();
    $db->aanmelden($naam, $email, $wachtwoord);

    header('Location: login.php'); // Redirect to the login page after successful signup
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="begin.css"> 
</head>
<body>
    <div class="alles">
        <form action="begin.php" method="post">
            <div class="Alles">
                <h1>Sign Up</h1><br>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required> <br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required> <br><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required> <br><br>

                <button type="submit">Sign Up</button>
            </div>
        </form>
    </div>
</body>
</html>
