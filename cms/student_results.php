<?php
require( "../config.php" );
$sql_get_students = "SELECT * FROM students_tbl ORDER BY student_last";
$result = $makeconnection->query( $sql_get_students );


$sum_student_results=0;
$student_count = $result->num_rows;
//echo $student_count;
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Student results Read</title>
	<link href="cms_style.css" rel="stylesheet" type="text/css">
	<script>
		function JS_delete_student( student_id ) {
			if ( confirm( 'Are you sure you want to delete this student and their quiz results?' ) ) {
				window.location.href = 'student_delete.php?id=' + student_id;
			}
		}
	</script>
</head>

<body>
	<div id="container">
	  <header>
		<h1>CMS (teacher area): View Student results, gradebook</h1>
		<p><a href="quiz_read.php">view/setup quiz</a></p>

	  </header>

		<main>

		  <table width="100%" border="0">
				<tr>
					<th>Last Name</th>
					<th>First Name</th>
					<th>email</th>
					<th>Points earned</th>
					<th>Out of</th>
					<th>Percentage</th>
					<th>Date&Time</th>
					<th>Delete</th>
					
				
				</tr>

			<?php while ($row = $result->fetch_assoc()) { 
			  
			  
			  
			  
			  ?>
				<tr>
				<td>
					<?php echo $row['student_last']; ?>
				</td>
					
					<td>
					<?php echo $row['student_first']; ?>
				</td>
					
				<td>
					<?php echo $row['student_email']; ?>
				</td>
				
				<td>
					<?php echo $row['student_points']; ?>
				</td>
				
				<td>
					<?php echo $row['student_outof']; ?>
				</td>
				
				<td>
					<?php echo $row['student_percent'].'%'; 
				$sum_student_results+=$row['student_points'];
					
					?>
				</td>
					
				<td>
					<?php echo $row['student_datetime']; ?>
				</td>	
					
					<td>
					<a href="javascript:JS_delete_student(<?php echo $row['student_id']; ?>);"><button>Delete</button></a>
				</td>
					
					
				</tr>


				<?php

			

				} //end while


				?>
 </table>
				
	<h2>Stats:</h2>
	<p>Total number of students who took the quiz: <?php echo $student_count; ?></p>
	<p>Average percent grade: <?php echo number_format($sum_student_results/$student_count,2);?>%</p>	


		 <br>
	<a href="../index.php"><button>Back to top portal</button></a>	
		
			





	  </main>
		<!--end main-->


	</div>
	<!--end container-->
</body>
</html>