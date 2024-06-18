<?php

define("hostName",  "localhost");
define("userName", "root");
define("password", "");
define("dbName", "ebewd2_cr5_animal_adoption_kristineortega");

$conn = mysqli_connect(hostName, userName, password, dbName);

function cleanInputs($value)
{
    $data = trim($value);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);

    return $data;
}
