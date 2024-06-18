<?php
session_start();
$buttons = "";
if (isset($_SESSION["adm"]) && isset($_GET["id"])) {
    $buttons = '
        <tr>
            <td><a href="./edit.php?id=' . $_GET['id'] . '" class="btn btn-warning">Edit</a></td>
            <td><a href="./delete.php" class="btn btn-danger">Delete</a></td>
        </tr>
    ';
}
require_once "db_connect.php";
require_once "file_upload.php";
$id = isset($_SESSION["adm"]) ? $_SESSION["adm"] : $_SESSION["user"];
$sql = "SELECT * FROM `user` WHERE id = {$id}";
$result = mysqli_query($conn, $sql);
$user_data = mysqli_fetch_assoc($result);
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM `animal` WHERE id = {$id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: home.php");
}
$available = "";
if ($row["availability"] == 0) {
    $available = "adopted";
} else {
    $available = "available";
}
$vaccinate = "";
if ($row["vaccinated"] == 0) {
    $vaccinate = "not vaccinated";
} else {
    $vaccinate = "vaccinated";
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
        <div class="card" style="margin-top: 0px; padding: 10px; height: fit-content;">
            <div class="card-detail row row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                <div class="img">
                    <img src='pictures/<?= $row['image'] ?>' class='card-img-top' alt='...'>
                </div>
                <div class='card-body'>
                    <h5 class='card_title'><?= $row["name"] ?></h5>
                    <div class="row">
                        <div class="col-md-6">Breed:</div>
                        <div class="col-md-6"><?= $row["breed"]; ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Age:</div>
                        <div class="col-md-6"><?= $row["age"]; ?></div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">Size:</div>
                        <div class="col-md-6"><?= $row["size"]; ?></div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">Location:</div>
                        <div class="col-md-6"><?= $row["location"]; ?></div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">Vaccinated:</div>
                        <div class="col-md-6"><?= $vaccinate; ?></div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">Availability:</div>
                        <div class="col-md-6"><?= $available; ?></div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6">Description:</div>
                        <div class="col-md-6"><?= $row["description"] ?></div>
                    </div>
                    <div class="row btn-back">
                        <a href="home.php" class="btn btn-primary">Back to Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.html"; ?>


</body>

</html>