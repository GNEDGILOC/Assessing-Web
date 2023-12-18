<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $impactarea = $_POST["impactarea"];
    $moderate = $_POST["moderate"];

    $sql_existing_data = "SELECT priority FROM paoi where impactarea = '$impactarea'";
    $result_existing_data = $conn->query($sql_existing_data);

    if ($result_existing_data->num_rows > 0) {
        $row_existing_data = $result_existing_data->fetch_assoc();
        $priority = $row_existing_data["priority"];
    }

    $high = $priority + $moderate;

    $sql_update = "UPDATE paoi SET impactarea = '$impactarea', priority = '$priority', low = '$priority', moderate = '$moderate', high = '$high' WHERE impactarea = '$impactarea'";

    if ($conn->query($sql_update) === TRUE) {
        $sql_sum = "SELECT SUM(high) AS total_score FROM paoi";
        $result_sum = $conn->query($sql_sum);

        if ($result_sum->num_rows > 0) {
            $row_sum = $result_sum->fetch_assoc();
            $total_score = $row_sum["total_score"];

            $sql_update_score = "UPDATE paoi SET score = $total_score";
            if ($conn->query($sql_update_score) === TRUE) {
                echo "Data updating successfully";
                echo '<br><a href="Step7.html">Back</a>';
            } else {
                echo "Score updating failed: " . $conn->error;
            }
        } else {
            echo "Failed to retrieve total score";
        }
    } else {
        echo "Data updating failed: " . $conn->error;
    }
}

$sql_select = "SELECT * FROM paoi";

$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    echo "<h2>Database content</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Impact Area</th><th>Priority</th><th>Low</th><th>Moderate</th><th>High</th><th>Score</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["impactarea"] . "</td><td>" . $row["priority"] . "</td><td>" . $row["priority"] . "</td><td>" . $row["moderate"] . "</td><td>" . $row["high"] . "</td><td>" . $row["score"] . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "No data in database";
}

$conn->close();
?>
