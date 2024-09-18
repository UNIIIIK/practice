<?php 

$host = "localhost";
$dbuser = "root"; 
$dbpassword = "";
$dbname = "students";

$db = "mysql:host=$host;dbname=$dbname"; 
$connection = new PDO($db, $dbuser, $dbpassword);
$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$id = "6";
$first_name = "Nielvin";
$last_name = "Unabia";
$age = "26";
$gender = "MALE";

$sqlUpdate = "UPDATE stupidents SET first_name = :first_name, last_name = :last_name, age = :age, gender = :gender WHERE id = :id";
$stmtUpdate = $connection->prepare($sqlUpdate);
$stmtUpdate->execute(['first_name' => $first_name, 'last_name' => $last_name, 'age' => $age, 'gender' => $gender, 'id' => $id]);

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sqlDelete = "DELETE FROM stupidents WHERE id = :id";
    $stmtDelete = $connection->prepare($sqlDelete);
    $stmtDelete->execute(['id' => $delete_id]);
}

$stmt = $connection->query("SELECT * FROM stupidents"); 
while ($row = $stmt->fetch()) {
    echo $row['id'] . " " . $row['first_name'] . " " . $row['last_name'] . " - " . $row['age'];
    echo " <a href='?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a><br>"; 
} 

?>
