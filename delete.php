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

require "db_connect.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sqlSelect = "SELECT image FROM `animal` WHERE id = {$id}";
    $result = mysqli_query($conn, $sqlSelect);
    $row = mysqli_fetch_assoc($result);

    if ($row["image"] != "test_pic.jpg") {
        unlink("pictures/{$row["image"]}");
    }

    $sql = "DELETE FROM `animal` WHERE id = {$id} ";
    mysqli_query($conn, $sql);
    header("Location: dashboard.php");
}
