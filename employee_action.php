<?php
session_start();
include 'config/db.php';
include 'functions.php';

if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

$action = $_POST['action'];
$full_name = $_POST['full_name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$role = $_POST['role'];

if (!isValidEmail($email) || (!empty($phone) && !isValidPhone($phone))) {
    die("Invalid email or phone format.");
}

if ($action == 'add') {
    $stmt = $conn->prepare("INSERT INTO employees (full_name, dob, email, phone, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $full_name, $dob, $email, $phone, $role);
    $stmt->execute();
} elseif ($action == 'edit') {
    $id = $_POST['id'];
    $stmt = $conn->prepare("UPDATE employees SET full_name=?, dob=?, email=?, phone=?, role=? WHERE id=?");
    $stmt->bind_param("sssssi", $full_name, $dob, $email, $phone, $role, $id);
    $stmt->execute();
}

header("Location: dashboard.php");
?>