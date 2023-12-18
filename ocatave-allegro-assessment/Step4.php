<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aoc = $_POST["concern_area"];

    $sql = "INSERT INTO aoc (concern_area) VALUES ('$aoc')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Insert successfully";
        echo '<br><a href="Step4.html">Back</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'showData') {
    echo "<h2>Area of Concern</h2>";

    $sql_select = "SELECT refnum, concern_area FROM aoc";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Ref Num</th><th>Area of Concern</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["refnum"] . "</td><td>" . $row["concern_area"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 result";
    }
}

$conn->close();
?>
