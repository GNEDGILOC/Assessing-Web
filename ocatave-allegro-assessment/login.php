<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account = $_POST["account"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM customer WHERE account = '$account'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            header("Location: index.html");
            exit();
        } else {
            echo "Login successfully";
            echo '<br><a href="index.html">Back</a>';
        }
    } else {
        echo "Login failed, No user here";
        echo '<br><a href="index.html">Back</a>';
    }
}

$conn->close();
?>
