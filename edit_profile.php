<?php
session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit();
}
require_once "db_connect.php";
require_once "file_upload.php";
$id = isset($_SESSION["adm"]) ? $_SESSION["adm"] : $_SESSION["user"];
$backLink = isset($_SESSION["adm"]) ? "dashboard.php" : "home.php";
$sql = "SELECT * FROM `user` WHERE id = {$id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$fnameError = $lnameError = $phoneError = $addressError = "";
$error = false;
if (isset($_POST["update"])) {
    $first_name = cleanInputs($_POST["first_name"]);
    $last_name = cleanInputs($_POST["last_name"]);
    $phone_number = cleanInputs($_POST["phone_number"]);
    $address = cleanInputs($_POST["address"]);
    $image = fileUpload($_FILES["image"]);
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
    if (empty($phone_number)) {
        $error = true;
        $phoneError = "Phone number is required!";
    }
    if (empty($address)) {
        $error = true;
        $addressError = "Address is required!";
    }
    if (!$error) {
        if ($_FILES["image"]["error"] == 4) {
            $sqlUpdate = "UPDATE `user` SET `first_name` = '{$first_name}', `last_name` = '{$last_name}', `phone_number` = '{$phone_number}',
        `address` = '{$address}' WHERE id = {$id}";
        } else {
            $sqlUpdate = "UPDATE `user` SET `first_name` = '{$first_name}', `last_name` = '{$last_name}', `phone_number` = '{$phone_number}',
        `address` = '{$address}', `image` = '{$image[0]}' WHERE id = {$id}";
        }
    }
    if (mysqli_query($conn, $sqlUpdate)) {
        header("Location: " . $backLink);
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
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="btn btn-danger" href="logout.php?logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="register">
            <h1>Edit User Profile</h1>
            <form method="post" enctype="multipart/form-data">
                <input type="text" class="form-control" placeholder="First name" name="first_name" value="<?= $row["first_name"] ?>">
                <p class="text-danger"><?= $fnameError ?></p>
                <input type="text" class="form-control" placeholder="Last name" name="last_name" value="<?= $row["last_name"] ?>">
                <p class="text-danger"><?= $lnameError ?></p>
                <input type="text" class="form-control" placeholder="Phone number" name="phone_number" value="<?= $row["phone_number"] ?>">
                <p class="text-danger"><?= $phoneError ?></p>
                <input type="text" class="form-control" placeholder="Address" name="address" value="<?= $row["address"] ?>">
                <p class="text-danger"><?= $addressError ?></p>
                <input type="file" class="form-control" name="image">
                <p></p>
                <input type="submit" class="btn btn-primary" value="Update" name="update">
                <a class="btn btn-warning" href="<?= $backLink ?>">Back to Homepage</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>