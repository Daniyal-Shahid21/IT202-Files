<body>
<?php
$servername = "sql1.njit.edu";
$username = "sds";
$password = "Pillowcase#1";
$dbname = "sds";
$con = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<style>
        th, td {
          border: solid seagreen medium;
          padding: 10px;
          border-radius: 10px;
          font-weight: italic;
        }
        
        table {
          margin: auto;
          width: 50%;
        }
      </style>';

    session_start();
    $studName = $_POST["nameVar"];
    $sql = "SELECT * FROM Student WHERE Name='" . $studName . "'";
    $result = $con->query($sql);

    echo '<table>';
    echo '<tr> 
            <th>Name </th>
            <th>ID </th>
            <th>Major </th>
          </tr>';

    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["Name"] . '</td>';
            echo '<td>' . $row["ID"] . '</td>';
            echo '<td>' . $row["Major"] . '</td>';
            echo '</tr>';
        }
    } 
    else {
        echo '<tr><td colspan="3">No matching records found</td></tr>';
    }

    echo '</table>';
}
?>

<form method="post" action="HW14Assignment.php">
    <label for="nameVar">Student Name</label>
    <input type="text" name="nameVar" id="nameVar"><br>
    <button type="submit" name="sub">Submit</button>
</form>
</body>