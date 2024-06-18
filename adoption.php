<?php
session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit();
}
require "db_connect.php";
if (isset($_SESSION['user'])) {
    $uid = $_SESSION['user'];
    $link = "<a href=\"home.php\" class='btn btn-primary'>Back to pets</a>";
} else {
    $uid = $_SESSION['adm'];
    $link = "<a href=\"dashboard.php\" class='btn btn-primary'>Back to pets</a>";
}
$sql = "SELECT * FROM `user` WHERE id = {$uid}";
$result = mysqli_query($conn, $sql);
$user_data = mysqli_fetch_assoc($result);
$errorMsg = "";
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "Select availability from animal where id = '$id';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $available = "";
    if ($row["availability"] == 0) {
        $errorMsg = "<p>Pet is not available</p>";
    } else {
        $sql = "INSERT INTO pet_adoption (animal_id, user_id, adoption_date) VALUES ('$id', '$uid', NOW());";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sql = "UPDATE animal SET availability = 0 WHERE id = '$id';";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $errorMsg = "<p>Pet adopted successfully.</p>";
            }
        } else {
            $errorMsg = "<p>An error has occurred</p>";
        }
    }
} else {
    header("Location: dashboard.php");
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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./senior.php">Senior Pet</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="nav-link" href="edit_profile.php"><?= $user_data["email"] ?>
                        <img height="30px" src="pictures/<?= $user_data['image'] ?>"> </a>
                    <a class="btn btn-danger" href="logout.php?logout">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container detail">
        <div class="row">
            <?= $errorMsg ?>
            <?= $link ?>
        </div>
    </div>
</body>

</html>