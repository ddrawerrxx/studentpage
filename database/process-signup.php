<?php

if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) <8) {
    die("Password must be at least 8 character");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("password must contain at least one number");
}

print_r($_POST);