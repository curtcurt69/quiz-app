<?php
require('../config.php');  
if(isset ($_GET['id'])&& $_GET['id']!=""){
$student_id=$_GET['id'];

$sql_delete = "DELETE FROM students_tbl WHERE student_id = $student_id";
$result = $makeconnection->query( $sql_delete );

}
header("Location: student_results.php");
?>