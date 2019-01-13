<?php

include "../../config.php";
require "../Classes/Users.php";

if (isset($_POST['name'])){
    $value = $_POST['name'];
    $users = new Users($con);
    echo $users->filterUserByName($value);
}

if (isset($_POST['id'])){
    $value = $_POST['id'];
    $users = new Users($con);
    echo $users->filterUserById($value);
}

if (isset($_POST['default'])){
    $value = $_POST['default'];
    $users = new Users($con);
    echo $users->defaultSearch();
}