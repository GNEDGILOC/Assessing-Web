<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ac = $_POST["action"];
    $ma = $_POST["mitigation_approach"];

    $sql = "INSERT INTO ma (action, mitigation_approach) VALUES ('$ac', '$ma')";
    
    if ($conn->query($sql) === TRUE) {
        echo "新记录插入成功";
        echo '<br><a href="Step8.html">Back</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'showData') {
    echo "<h2>Mitigation Approach</h2>";

    $sql_select = "SELECT refnum, action, mitigation_approach FROM ma";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Ref Num</th><th>Action</th><th>Mitigation Approach</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["refnum"] . "</td><td>" . $row["action"] . "</td><td>" . $row["mitigation_approach"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 结果";
    }
}

$conn->close();
?>
