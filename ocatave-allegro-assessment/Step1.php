<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $impactarea = $_POST["impactarea"];
    $priority = $_POST["priority"];

    $sql = "INSERT INTO paoi (impactarea, priority) VALUES ('$impactarea', '$priority')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saving successfully";
        echo '<br><a href="Step1.html">Back</a>';
    } else {
        echo "Data saving failed: " . $conn->error;
    }
}

$sql_select = "SELECT id, priority, impactarea FROM paoi";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    echo "<h2>Database content</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Impact Area</th><th>Priority</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["impactarea"] . "</td><td>" . $row["priority"] . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "No data in database";
}

$conn->close();
?>
