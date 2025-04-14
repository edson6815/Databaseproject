<?php
$conn = new mysqli("localhost", "root", "", "user_image_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>User Management System</title>
<style>
    body {
        font-family: 'Verdana', sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(135deg, #dff9fb, #c7ecee);
        color: #2d3436;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    h2 {
        text-align: center;
        color: #0984e3;
        margin-top: 30px;
        font-weight: normal;
    }

    form {
        max-width: 600px;
        margin: 20px auto;
        padding: 25px;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #dfe6e9;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(6px);
    }

    form input, form button {
        width: 100%;
        margin: 10px 0;
        padding: 12px;
        border: 1px solid #b2bec3;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    form input:focus {
        outline: none;
        border-color: #00cec9;
        box-shadow: 0 0 5px rgba(0, 206, 201, 0.3);
    }

    form button {
        background-color: #00cec9;
        color: white;
        font-weight: bold;
        border: none;
        cursor: pointer;
    }

    form button:hover {
        background-color: #00b894;
    }

    table {
        width: 90%;
        margin: 30px auto;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 16px;
        text-align: center;
        border-bottom: 1px solid #dcdde1;
    }

    th {
        background-color: #00cec9;
        color: white;
    }

    tr:hover {
        background-color: #f1f2f6;
    }

    img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #00cec9;
    }

    a {
        color: #0984e3;
        font-weight: bold;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
        color: #0652dd;
    }

    footer {
        margin-top: auto;
        background-color: #00cec9;
        color: white;
        text-align: center;
        padding: 15px 0;
        font-size: 14px;
    }
</style>
</head>
<body>

<h2>Add New User</h2>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="file" name="profile_image" accept="image/*" required>
    <button type="submit">Submit</button>
</form>

<h2>All Users</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Profile Image</th>
        <th>Created At</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td>
                <img src="uploads/<?= htmlspecialchars($row['image_path']); ?>" alt="Profile">
            </td>
            <td><?= $row['created_at']; ?></td>
            <td>
                <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
