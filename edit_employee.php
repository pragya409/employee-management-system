<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'HR'])) {
    header('Location: dashboard.php');
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM employees WHERE id=$id");
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light fade-in">
<div class="container py-5">
    <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
        <h3 class="mb-4 text-center">Edit Employee</h3>
        <form method="post" action="employee_action.php">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input class="form-control" name="full_name" value="<?= $data['full_name'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input class="form-control" type="date" name="dob" value="<?= $data['dob'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" name="email" value="<?= $data['email'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input class="form-control" name="phone" value="<?= $data['phone'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-control" name="role" required>
                    <option <?= $data['role'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                    <option <?= $data['role'] == 'HR' ? 'selected' : '' ?>>HR</option>
                    <option <?= $data['role'] == 'Viewer' ? 'selected' : '' ?>>Viewer</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="dashboard.php" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update Employee</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
