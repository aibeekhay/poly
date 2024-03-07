<?php
$conn = new mysqli ("localhost", "root", "", "interview");

if ($conn->connect_error) {
    die ("server not found" . $conn->connect_error);
}
