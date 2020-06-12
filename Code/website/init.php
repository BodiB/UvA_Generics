<?php
//Initial variables

//Login details to access the admin menu.
$admin_username = "<USERNAME>";
$admin_password = "<PASSWORD>";

// Boolean to set if B needs to be used.
// 0 = Do not set B
// 1 = Set B
$setB = 0;

// Setting reCAPTCHA
// 0 = Use reCAPTCHA, reCAPTCHA needs to verify the user not being a robot.
// 1 = No reCAPTCHA, user will automatically be approved.
$_SESSION["recaptcha"] = 1;
//public reCAPTCHA key
$public_key = "<reCAPTCHA PUBLIC KEY>";
//private reCAPTCHA key
$recaptcha_secret = '<reCAPTCHA PRIVATE KEY>';
?>