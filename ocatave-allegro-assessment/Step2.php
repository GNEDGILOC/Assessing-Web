<?php
include("dbconnect.php");

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formname = $_POST["formname"];
    $tablecontent = $_POST["tablecontent"];
    $descriptions = $_POST["descriptions"];

    $sql = "INSERT INTO studentprofile (formname, tablecontent, descriptions) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $formname, $tablecontent, $descriptions);

    if ($stmt->execute()) {
        echo "数据插入成功！";
        echo '<br><a href="Step2.html">Back</a>';
    } else {
        echo "错误: " . $stmt->error;
        echo '<br><a href="Step2.html">Back</a>';
    }

    $stmt->close();
}

if (isset($_GET['action']) && $_GET['action'] == 'showData') {
    echo "<h2>studentprofile</h2>";

    $sql_select = "SELECT formname, tablecontent, descriptions FROM studentprofile";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Critical Assets/Owner/Reuquirements</th><th>Contents</th><th>Description</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["formname"] . "</td><td>" . $row["tablecontent"] . "</td><td>" . $row["descriptions"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 结果";
    }
}

$conn->close();
?>
