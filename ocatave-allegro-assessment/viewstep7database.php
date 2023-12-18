<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_select = "SELECT * FROM paoi";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    echo "<h2>Database</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Priority</th><th>Impact Area</th><th>Low</th><th>Moderate</th><th>High</th><th>Score</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["priority"] . "</td><td>" . $row["impactarea"] . "</td><td>" . $row["low"] . "</td><td>" . $row["moderate"] . "</td><td>" . $row["high"] . "</td><td>" . $row["score"] . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "No data in database!";
}

$conn->close();
?>
