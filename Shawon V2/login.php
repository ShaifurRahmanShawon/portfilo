<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<?php
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    
    $password = $_POST["password"];
    //var_dump($password);
    //exit;
    // Database connection
    require_once "database.php";

    // Prepare and execute the query to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM loginnn WHERE email = ?");
    
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    
    if ($user) {
        echo "Stored hash: " . htmlspecialchars($user['password']) . "<br>";
        echo "User input password: " . htmlspecialchars($password) . "<br>";
        if ($user["password"] === $password) {
            // Redirect to the admin page
            header("Location: Admin/index.php");
            die();
        } else {
            echo "<div>Password is incorrect.</div>";
        }
    } else {
        echo "<div>Email does not exist.</div>";
    }
    clearstatcache();
    $stmt->close();
    $conn->close();
}
?>

<div class="container">
    <div class="card">
        <div class="card2">
            <form action="login.php" method="post" class="form">
                <p id="heading">Login</p>

                <!-- Input Field for Email -->
                <div class="field">
                    <input type="email" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
                </div>
                
                <!-- Password Field -->
                <div class="field">
                    <input type="password" name="password" class="input-field" placeholder="Password" required>
                </div>

                <!-- Login Button -->
                <div class="btn">
                    <button type="submit" name="login" class="button1">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
</body>
</html>