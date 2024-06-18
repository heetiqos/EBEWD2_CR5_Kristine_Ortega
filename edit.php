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
$error = false;
$nameError = $ageError = $locError = $breedError = $sizeError = $availError = $descriptionError = $vacError = $name = $age = $breed = $location = $size = $availability = $description = $vaccinated = "";
if (isset($_POST["edit"]) && isset($_GET['id'])) {
    $name = cleanInputs($_POST["name"]);
    $age = cleanInputs($_POST["age"]);
    $location = cleanInputs($_POST["location"]);
    $breed = cleanInputs($_POST["breed"]);
    $size = cleanInputs($_POST["size"]);
    $image = fileUpload($_FILES["image"]);
    $availability = cleanInputs($_POST["availability"]);
    $description = cleanInputs($_POST["description"]);
    $vaccinated = cleanInputs($_POST["vaccinated"]);
    if (empty($name)) {
        $error = true;
        $nameError = "Name is required!";
    } elseif (strlen($name) < 3) {
        $error = true;
        $nameError = "Name must have atleast 3 characters!";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        $error = true;
        $nameError = "Name must contain only letter and spaces!";
    }
    if (empty($location)) {
        $error = true;
        $locError = "Location is required!";
    } elseif (strlen($location) < 3) {
        $error = true;
        $locError = "Location must have atleast 3 characters!";
    }
    if (empty($size)) {
        $error = true;
        $sizeError = "Size is required!";
    }
    if (empty($age)) {
        $error = true;
        $ageError = "Age is required!";
    }
    if (empty($breed)) {
        $error = true;
        $breedError = "Breed is required!";
    }
    //if (empty($availability)) {
    //$error = true;
    //$availError = "Availability is required!";
    //}
    if (empty($description)) {
        $error = true;
        $descriptionError = "Description is required!";
    }
    if (empty($vaccinated)) {
        $error = true;
        $vacError = "Vaccination is required!";
    }
    if (!$error) {
        $sql = "UPDATE animal SET name = '" . $name . "', image = '" . $image[0] . "', location='" . $location . "', description='" . $description . "', size='" . $size . "', age='" . $age . "', vaccinated='" . $vaccinated . "', breed = '" . $breed . "', availability='" . $available . "' WHERE id='" . $_GET['id'] . "';";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<div class= 'alert alert-success'>
            <p> Update has been saved, $image[1] </p>
            </div>";
            $name = $age = $breed = $location = $size = $availability = $description = $vaccinated = "";
            header("Location: details.php?id=" . $_GET['id']);
        } else {
            echo "<div class= 'alert alert-danger'>
            <p> Something went wrong, please try again later! </p>
            </div>";
            header("Location: details.php?id=" . $_GET['id']);
        }
    }
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM `animal` WHERE id = {$id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: dashboard.php");
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
    <div class="container register">
        <h1 class="text-center">Edit pet: <?= $row['name'] ?></h1>
        <form method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="text" class="form-control" placeholder="Name" name="name" value="<?= $row['name'] ?>">
            <p class="text-danger"><?= $nameError ?></p>
            <input type="text" class="form-control" placeholder="Age" name="age" value="<?= $row['age'] ?>">
            <p class="text-danger"><?= $ageError ?></p>
            <input type="text" class="form-control" placeholder="Location" name="location" value="<?= $row['location'] ?>">
            <p class="text-danger"><?= $locError ?></p>
            <input type="text" class="form-control" placeholder="Description" name="description" value="<?= $row['description'] ?>">
            <p class="text-danger"><?= $descriptionError ?></p>
            <input type="text" class="form-control" placeholder="Size" name="size" value="<?= $row['size'] ?>">
            <p class="text-danger"><?= $sizeError ?></p>
            <input type="text" class="form-control" placeholder="Vaccinated" name="vaccinated" value="<?= $vaccinate ?>">
            <p class="text-danger"><?= $vacError ?></p>
            <input type="text" class="form-control" placeholder="Breed" name="breed" value="<?= $row['breed'] ?>">
            <p class="text-danger"><?= $breedError ?></p>
            <input type="text" class="form-control" placeholder="Availability" name="availability" value="<?= $available ?>">
            <p class="text-danger"><?= $availError ?></p>
            <input type="file" class="form-control" name="image">
            <p></p>
            <input type="submit" class="btn btn-primary" value="Edit" name="edit">
        </form>
    </div>
</body>

</html>