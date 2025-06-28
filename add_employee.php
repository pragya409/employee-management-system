<?php
session_start();
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['Admin', 'HR'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light fade-in">
<div class="container py-5">
    <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
        <h3 class="mb-4 text-center">Add New Employee</h3>
        <form method="post" action="employee_action.php">
            <input type="hidden" name="action" value="add">
            
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input class="form-control" name="full_name" placeholder="Enter full name" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input class="form-control" type="date" name="dob" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" name="email" placeholder="example@mail.com" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input class="form-control" name="phone" placeholder="+91XXXXXXXXXX" pattern="^\+?[0-9]{10,15}$" title="Phone number should be 10 to 15 digits long." required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-control" name="role" required>
                    <option>Admin</option>
                    <option>HR</option>
                    <option>Viewer</option>
                </select>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="dashboard.php" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Save Employee</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
