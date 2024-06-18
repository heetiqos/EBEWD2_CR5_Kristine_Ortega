<?php
session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit();
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit();
}
require_once "db_connect.php";
require_once "file_upload.php";
$id = $_SESSION["adm"];
$sql = "SELECT * FROM `user` WHERE id = {$id}";
$result = mysqli_query($conn, $sql);
$user_data = mysqli_fetch_assoc($result);
$sql = "SELECT * FROM `animal` ";
$result = mysqli_query($conn, $sql);
$layout = "";
if (mysqli_num_rows($result) == 0) {
    $layout .= "No results found";
} else {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($rows as $row) {
        $status = "";
        $adopt_btn = "";
        if ($row["availability"] == 1) {
            $adopt_btn = "<a href= 'adoption.php?id={$row["id"]}' class='btn btn-primary'>Take me home</a>";
        } else {
            $status = "<p style='color: red; text-align: center; margin-top: 10px'> This pet has already been adopted.</p>";
        }
        $layout .= "
        <div>
        <div class='card index' style='width: 18rem; height: 25rem; margin: 2rem;'>
        <a href= 'details.php?id={$row["id"]}'>
  <img src='pictures/{$row["image"]}' class='card-img-top' alt='image of pet'>
  </a>
  <div class='card-body'>
    <h2 class='card-title'>{$row["name"]}</h2>
    <p class='card-text'> {$row["breed"]}</p>
        <div class='btns-flex'>
            <a href= 'details.php?id={$row["id"]}' class='btn btn-info'>Details</a>
            <a href= 'edit.php?id={$row["id"]}' class='btn btn-success'>Edit</a>
            <a href= 'delete.php?id={$row["id"]}' class='btn btn-danger'>Delete</a>
        </div>
 <!--  <p style = 'text-align: center; margin-top: 10px'> {$adopt_btn}</p> -->
    {$status}
  </div>
</div>
</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello <?= $user_data["first_name"] ?></title>
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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./create.php">Register a Pet</a>
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
    <div class="container">
        <h1>All Pets</h1>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php include "footer.html"; ?>

</body>

</html>