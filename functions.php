<?php
function calculateAge($dob) {
    return date_diff(date_create($dob), date_create('today'))->y;
}
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function isValidPhone($phone) {
    return preg_match('/^\+?[0-9]{10,15}$/', $phone);
}
?>