<?php
require('../config.php');  
if(isset ($_GET['id'])&& $_GET['id']!=""){
$question_id=$_GET['id'];

$sql_delete = "DELETE FROM questions_tbl WHERE question_id = $question_id";
$result = $makeconnection->query( $sql_delete );

}
header("Location: quiz_read.php");
?>