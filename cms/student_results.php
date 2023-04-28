<?php

require( "../config.php" );

$sql_get_students = "SELECT * FROM students_tbl ORDER BY student_last";

$result = $makeconnection->query( $sql_get_students );





$sum_student_results=0;

$student_count = $result->num_rows;

//echo $student_count;

$F = 0;
$D = 0;
$C = 0;
$B = 0;
$A = 0;

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
					
					<th>Grade</th>

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

				$sum_student_results+=$row['student_percent'];

					

					?>

				</td>

					
				<td>
					<?php echo $row['student_lettergrade']; 
						switch($row['student_lettergrade']) {
							case "F":
								$F++;
								break;
							case "D":
								$D++;
								break;
							case "C":
								$C++;
								break;
							case "B":
								$B++;
								break;
							case "A":
								$A++;
								break;
								
						}
					
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

	<?php 
			
		$F_share=number_format($F/$student_count*100,2);
		$D_share=number_format($D/$student_count*100,2);
		$C_share=number_format($C/$student_count*100,2);
		$B_share=number_format($B/$student_count*100,2);
		$A_share=number_format($B/$student_count*100,2);
	?>
	
	<div id="myChart">
		<div class="bar" id="F"><p><?php echo "F: $F students<br>$F_share% of class"?></p></div>
		<div class="bar" id="D"><p><?php echo "D: $D students<br>$D_share% of class"?></p></div>
		<div class="bar" id="C"><p><?php echo "C: $C students<br>$C_share% of class"?></p></div>
		<div class="bar" id="B"><p><?php echo "B: $B students<br>$B_share% of class"?></p></div>
		<div class="bar" id="A"><p><?php echo "A: $B students<br>$A_share% of class"?></p></div>
	</div>


		<br>
			<br>
		 <br>

	<a href="../index.php"><button>Back to top portal</button></a>	

		

			











	  </main>

		<!--end main-->





	</div>

	<!--end container-->

</body>
	<style>
		.bar {
			width: 18%;
			position: absolute;
			bottom: 0px;
			opacity: 0.7;
			box-shadow: 3px -3px 10px #000;
			border-radius: 25px 25px 0 0;
		}
		
		.bar p {
			font-size: 13px;
			font-weight: 700;
			display: block;
			position: absolute;
			bottom: -45px;
		}
		
		#myChart {
			position: relative;
			width: 100%;
			height: 300px;
			background-color: #E4E1E1;
			background-image: url("images/grid.png");
			margin: 0 auto;
		}
		#F {
			height: <?php echo $F_share .'%;'?>;
			background-color: #E71313;
			left: 0%;
			z-index: 1;
		}
		#D {
			height: <?php echo $D_share . '%'?>;
			background-color: #F3F246;
			left: 20%;
			z-index: 1;
		}
		#C {
			height: <?php echo $C_share .'%'?>;
			background-color: #DAF800;
			left: 40%;
			z-index: 1;
		}
		#B {
			height: <?php echo $B_share . '%'?>;
			background-color: #3A7FB7;
			left: 60%;
			z-index: 1;
		}
		#A {
			height: <?php echo $A_share . '%'?>;
			background-color: #005900;
			left: 80%;
		}
	
	</style>
</html>