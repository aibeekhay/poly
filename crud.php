<?php
include 'conn.php';

$sql = ""; // Initialize $sql variable

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $sql = "INSERT INTO new (name, email) VALUES ('$name', '$email')";
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    $sql = "UPDATE new SET name='$name', email='$email' WHERE id=$id";
}

if(isset($_POST['delete'])){
    $name = $_POST['name'];
    
    $sql = "DELETE FROM new WHERE name='$name'";
}
$sql = "SELECT * FROM new";

if(isset($_POST['search'])){
    $search_query = $_POST['search_query'];
    $sql = "SELECT * FROM new WHERE Surname LIKE '%$search_query%' OR email LIKE '%$search_query%'";
}

if(!empty($sql)) {
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error executing query: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            echo "<table border='1'>
            <tr>
            <th>Surname</th>
            <th>Other_names</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Action</th>
            </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Surname"] . "</td>";
                echo "<td>" . $row["Other_names"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["Telephone"] . "</td>";
                echo "<td><form method='post'><input type='hidden' name='id' value='" . $row["id"] . "'><input type='submit' name='submit_update' value='Update'><input type='submit' name='submit_delete' value='Delete'></form></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "0 results";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="post">
    Surname: <input type="text" name="name"><br>
    Other_names: <input type="text" name="other_names"><br> <!-- Changed input name to avoid conflict -->
    Email: <input type="text" name="email"><br>
    <input type="submit" name="register" value="register">
</form>

<form method="post">
    Search: <input type="text" name="search_query" value="<?php echo isset($search_query) ? $search_query : ''; ?>"><br>
    <input type="submit" name="search" value="Search">
</form>

</body>
</html>
