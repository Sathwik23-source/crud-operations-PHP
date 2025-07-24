<?php
// Database Connection
$host = "localhost";
$user = "root";
$password = ""; // XAMPP default
$dbname = "crud_db";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// CREATE
if (isset($_POST['create'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
  $conn->query($sql);
}

// UPDATE
if (isset($_POST['update'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
  $conn->query($sql);
}

// DELETE
if (isset($_POST['delete'])) {
  $id = $_POST['id'];
  $sql = "DELETE FROM users WHERE id=$id";
  $conn->query($sql);
}

// READ
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Simple PHP CRUD (Single File)</title>
</head>
<body>
  <h2>Create User</h2>
  <form method="POST">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    <button type="submit" name="create">Create</button>
  </form>

  <h2>Update User</h2>
  <form method="POST">
    ID: <input type="number" name="id" required><br>
    New Name: <input type="text" name="name" required><br>
    New Email: <input type="email" name="email" required><br>
    <button type="submit" name="update">Update</button>
  </form>

  <h2>Delete User</h2>
  <form method="POST">
    ID: <input type="number" name="id" required><br>
    <button type="submit" name="delete">Delete</button>
  </form>

  <h2>All Users</h2>
  <?php
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "ID: ".$row["id"]." | Name: ".$row["name"]." | Email: ".$row["email"]."<br>";
    }
  } else {
    echo "No users found.";
  }
  ?>
</body>
</html>
