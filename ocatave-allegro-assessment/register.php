<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $account = $_POST["account"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO customer (name, account, password) VALUES ('$name', '$account', '$hashed_password')";
    // $sql = "INSERT INTO customer (name, account, password) VALUES ('$name', '$account', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "succeed";
        echo '<br><a href="index.html">返回</a>';
    } else {
        echo "failed: " . $conn->error;
    }
}

$conn->close();
?>
