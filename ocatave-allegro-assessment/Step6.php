<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST["location"];
    $ex_d = $_POST["external_description"];
    $in_d = $_POST["internal_description"];
    $owner = $_POST["owner"];

    $sql = "INSERT INTO iac (locationcontainer, external_description, internal_description, info_owner) VALUES ('$location', '$ex_d', '$in_d', '$owner')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record inserted successfully";
        echo '<br><a href="Step3.html">Back</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'showData') {
    echo "<h2>Information Asset Containers</h2>";

    $sql_select = "SELECT locationcontainer, external_description, internal_description, info_owner FROM iac";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Location Container</th><th>External Description</th><th>Internal Description</th><th>Information Owner</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["locationcontainer"] . "</td><td>" . $row["external_description"] . "</td><td>" . $row["internal_description"] . "</td><td>" . $row["info_owner"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}

$conn->close();
?>
