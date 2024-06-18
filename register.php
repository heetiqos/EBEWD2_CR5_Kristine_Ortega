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
require_once "file_upload.php";
$error = false;
$fnameError = $lnameError = $passError = $emailError = $phoneError = $addressError = $first_name = $last_name = $email = $phone_number = $address = "";
if (isset($_POST["register"])) {
    $first_name = cleanInputs($_POST["first_name"]);
    $last_name = cleanInputs($_POST["last_name"]);
    $email = cleanInputs($_POST["email"]);
    $phone_number = cleanInputs($_POST["phone_number"]);
    $address = cleanInputs($_POST["address"]);
    $image = fileUpload($_FILES["image"]);
    $password = cleanInputs($_POST["password"]);
    if (empty($first_name)) {
        $error = true;
        $fnameError = "First name is required!";
    } elseif (strlen($first_name) < 3) {
        $error = true;
        $fnameError = "First name must have atleast 3 characters!";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $first_name)) {
        $error = true;
        $fnameError = "First name must contain only letter and spaces!";
    }
    if (empty($last_name)) {
        $error = true;
        $lnameError = "Last name is required!";
    } elseif (strlen($last_name) < 3) {
        $error = true;
        $lnameError = "Last name must have atleast 3 characters!";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
        $error = true;
        $lnameError = "Last name must contain only letter and space!";
    }
    if (empty($password)) {
        $error = true;
        $passError = "Password is required!";
    } elseif (strlen($password) < 10) {
        $error = true;
        $passError = "Password must be atleast 10 characters!";
    }
    if (empty($email)) {
        $error = true;
        $emailError = "Email is required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email address";
    } else {
        $query = "SELECT email FROM `user` WHERE email = '{$email}'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) != 0) {
            $error = true;
            $emailError = "Email is already in use!";
        }
    }
    if (empty($phone_number)) {
        $error = true;
        $phoneError = "Phone number is required!";
    }
    if (empty($address)) {
        $error = true;
        $addressError = "Address is required!";
    }
    if (!$error) {
        $password = hash("sha256", $password);
        $sql = "INSERT INTO `user`(`first_name`, `last_name`, `email`, `phone_number`, `address`, `image`, `password`)
                VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$phone_number}', '{$address}', '{$image[0]}', '{$password}')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<div class= 'alert alert-success'>
            <p> New account has been created, $image[1] </p>
            </div>";
            $first_name = $last_name = $email = $phone_number = $address = "";
        } else {
            echo "<div class= 'alert alert-danger'>
            <p> Something went wrong, please try again later! </p>
            </div>";
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
    <div class="container register regform">
        <h1 class="text-center">Registration Form</h1>
        <form method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="text" class="form-control" placeholder="First name" name="first_name" value="<?= $first_name ?>">
            <p class="text-danger"><?= $fnameError ?></p>
            <input type="text" class="form-control" placeholder="Last name" name="last_name" value="<?= $last_name ?>">
            <p class="text-danger"><?= $lnameError ?></p>
            <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $email ?>">
            <p class="text-danger"><?= $emailError ?></p>
            <input type="text" class="form-control" placeholder="Phone number" name="phone_number" value="<?= $phone_number ?>">
            <p class="text-danger"><?= $phoneError ?></p>
            <input type="text" class="form-control" placeholder="Address" name="address" value="<?= $address ?>">
            <p class="text-danger"><?= $addressError ?></p>
            <input type="file" class="form-control" name="image">
            <p></p>
            <input type="password" class="form-control" placeholder="Password" name="password">
            <p class="text-danger"><?= $passError ?></p>
            <input type="submit" class="btn btn-warning" value="Register" name="register">
            <a class="btn btn-primary" href="./login.php">Return to login</a>
        </form>
    </div>
</body>

</html>