<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit();
}
if (isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
    exit();
}
require_once "db_connect.php";
$error = false;
$passError = $emailError = $email = "";
if (isset($_POST["login"])) {
    $email = cleanInputs($_POST["email"]);
    $password = cleanInputs($_POST["password"]);
    if (empty($email)) {
        $error = true;
        $emailError = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    }
    if (empty($password)) {
        $error = true;
        $passError = "Password is required";
    }
    if (!$error) {
        $password = hash("sha256", $password);
        $sql = "SELECT * FROM `user` WHERE email='{$email}' AND password= '{$password}'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            if ($row["status"] == "adm") {
                $_SESSION["adm"] = $row["id"];
                header("Location: dashboard.php");
                exit();
            } else {
                $_SESSION["user"] = $row["id"];
                header("Location: home.php");
                exit();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="login row row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
            <div class="login-img">
                <img src="pictures\login_image4.jpg" alt="child playing with pet">
                <p class="login-text">Login or register to see pets looking for a new home.</p>
            </div>
            <div class="register">
                <h1 class="text-center">Login</h1>
                <form method="post" style="margin-bottom: 50px;">
                    <input type="email" class="form-control mt-2" placeholder="Email" name="email" value="<?= $email ?>">
                    <p class="text-danger"><?= $emailError ?></p>
                    <input type="password" class="form-control mt-2" placeholder="Password" name="password">
                    <p class="text-danger"><?= $passError ?></p>
                    <input type="submit" class="btn btn-primary mt-2" name="login" value="Login">
                </form>
                <hr>
                <a class="btn btn-warning" href="register.php?register">Create new account</a>
            </div>
        </div>
    </div>

    <?php include "footer.html"; ?>

</body>

</html>