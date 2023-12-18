<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ts = $_POST["threat_scenarios"];

    $sql = "INSERT INTO ts (threat_scenarios) VALUES ('$ts')";
    
    if ($conn->query($sql) === TRUE) {
        echo "新记录插入成功";
        echo '<br><a href="Step5.html">Back</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'showData') {
    echo "<h2>Threat Scenarios</h2>";

    $sql_select = "SELECT refnum, threat_scenarios FROM ts";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Ref Num</th><th>Threat Scenarios</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["refnum"] . "</td><td>" . $row["threat_scenarios"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 结果";
    }
}

$conn->close();
?>
