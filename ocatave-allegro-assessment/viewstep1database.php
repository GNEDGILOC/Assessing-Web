<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql_select = "SELECT id, priority, impactarea FROM paoi";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    echo "<h2>Database</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Impact Area</th><th>Priority</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["impactarea"] . "</td><td>" . $row["priority"] . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "No data in database!";
}

$conn->close();
?>
