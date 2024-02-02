<body>
<?php
$servername = "sql1.njit.edu";
$username = "sds";
$password = "Pillowcase#1";
$dbname = "sds";
$con = mysqli_connect($servername,$username,$password,$dbname);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

echo '<style>
        th, td {
          border: solid seagreen medium;
          padding: 10px;
          border radius: 10 px;
          font-weight: italic;
        }
        
        table {
          margin: auto;
          width: 50%;
        }
      </style>';
session_start();

if(!isset($_SESSION["studentId"])) {
  header("Location: HW11Assignment.php");
  die;

}

$studId = $_SESSION["studentId"];
$sql = "SELECT S.Name, S.ID, S.Major, T.Course, T.Grade 
        FROM Student S INNER JOIN Transcript T ON S.ID=T.ID
        WHERE S.ID=". $studId;
$product = $con->query($sql);

echo '<table>';
echo '<tr> 
            <th>Name </th>
            <th>ID </th>
            <th>Major </th>
            <th>Course </th>
            <th>Grade </th>
      </tr>';
      
while ($row = $product->fetch_assoc()) {
    echo '<tr>';
    foreach($row as $info) {
      echo '<td>' . $info . '</td>';
    }
    echo '</tr>';
}
echo'</table>';
echo '<button onclick = "window.location.href=\'HW11Assignment.php\';" id="home">Home</button>';
?>
</body>