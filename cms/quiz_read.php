<?php


if (isset($_GET['orderby']) && $_GET['orderby'] !== "") {
	$orderby = $_GET['orderby'];
} else {
	$orderby = 1;
}

function mark_selected($opt) {
    if (isset($_GET['orderby']) && $_GET['orderby'] !== "") {
        $orderby = $_GET['orderby'];
    } else {
        $orderby = 1;
    }

    if ($orderby==$opt) {
        echo 'selected="selected"';
    }
}

switch ($orderby) {
    case "1":
        $dataOrder = 'question_points';
        break;
    case "2":
        $dataOrder = 'question_points DESC';
        break;
    case "3":
        $dataOrder = 'question_statement';
        break;
    case "4":
        $dataOrder = 'question_statement DESC';
        break;
    case "5":
        $dataOrder = 'question_answer';
        break;
    case "6":
        $dataOrder = 'question_answer DESC';
        break;
    case "7":
        $dataOrder = 'question_id';
        break;
    case "8":
        $dataOrder = 'question_id DESC';
        break;
    default:
        $dataOrder="question_id";

}

require( "../config.php" );
$sql_get_all = "SELECT * FROM questions_tbl ORDER BY $dataOrder";
$result = $makeconnection->query( $sql_get_all );
$overAllPoints = 0;
$num=0;
?>
<!doctype html>
<html lang="en-us">
<head>
	<meta charset="UTF-8">
	<title>Questions- Read</title>
	<link href="cms_style.css" rel="stylesheet" type="text/css">
	<script>
		function JS_delete_item( question_id ) {
			if ( confirm( 'Are you sure you want to delete this question?' ) ) {
				window.location.href = 'quiz_delete.php?id=' + question_id;
			}
		}

        function selectMenu(selectionObj) {
            window.location.href = selectionObj.options[selectionObj.selectedIndex].value;
        }
	</script>
</head>

<body>
	<div id="container">
	  <header>
		<h1>CMS (teacher area): View Quiz</h1>
		<p><a href="student_results.php">view student results</a></p>

	  </header>
	
		<main>
			<!--<p>
				<a href="quiz_read.php?myOrder=question_points"><button>Order By Points Low to High</button></a>
				<a href="quiz_read.php?myOrder=question_points DESC"><button>Order By Points High To Low</button></a>
				<a href="quiz_read.php?myOrder=question_statement"><button>Order By Statement A-Z</button></a>
				<a href="quiz_read.php?myOrder=question_statement DESC"><button>Order By Statement Z-A</button></a>
				<a href="quiz_read.php?myOrder=question_answer"><button>Order By Answer, false's first</button></a>
				<a href="quiz_read.php?myOrder=question_answer DESC"><button>Order By Answer, true's first</button></a>
				<a href="quiz_read.php?myOrder=question_id"><button>Order By Id, low to high</button></a>
				<a href="quiz_read.php?myOrder=question_id DESC"><button>Order By Id, low to high</button></a>
			</p>-->

            <select  class="selectobj" onChange="selectMenu(this)">
                <option <?php mark_selected('1'); ?> value="quiz_read.php?orderby=1" >Order By Points Low to High</option>
                <option <?php mark_selected('2'); ?>  value="quiz_read.php?orderby=2">Order By Points High To Low</option>
                <option <?php mark_selected('3'); ?>  value="quiz_read.php?orderby=3">Order By Statement A-Z</option>
                <option <?php mark_selected('4'); ?>  value="quiz_read.php?orderby=4">Order By Statement Z-A</option>
                <option <?php mark_selected('5'); ?>  value="quiz_read.php?orderby=5">Order By Answer, false's first</option>
                <option <?php mark_selected('6'); ?>  value="quiz_read.php?orderby=6">Order By Answer, true's first</option>
                <option <?php mark_selected('7'); ?>  value="quiz_read.php?orderby=7">Order By Id, low to high</option>
                <option <?php mark_selected('8'); ?>  value="quiz_read.php?orderby=8">Order By Id, high to low</option>
            </select>
		  <table style="width:100%;border:0;">
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>Statement</th>
					<th>Answer</th>
					<th>Points</th>
					<th>Modify</th>
					<th>Delete</th>

				</tr>

			<?php while ($row = $result->fetch_assoc()) { ?>
				<tr>
				<td>
						<?php $num++; echo $num ?>
					</td>	
					
					
					<td>
						<?php echo $row["question_id"]; ?>
					</td>
					<td>
						<?php echo $row["question_statement"]; ?>
					</td>
					<td>
						<?php  echo  ($row["question_answer"] == 1) ? "true" : "false" ; ?>
					</td>
					<td>
						<?php echo $row["question_points"]; ?>
					</td>
					<td><a href="quiz_modify.php?id=<?php echo $row["question_id"]; ?>"><button>Modify</button></a>
					</td>
					<td><a href="javascript:JS_delete_item(<?php echo $row['question_id']; ?>);"><button>Delete</button></a>
					</td>
				</tr>


				<?php

				$overAllPoints += $row[ "question_points" ];

				} //end while


				?>

				<tr class="tableTotals">
					<td colspan="4" style="text-align: right;">
						<p style="text-align: right">The total number of points in the quiz is:</p>
						<p style="text-align: right"> Each point in the quiz is worth:</p>

					</td>
					<td colspan="3">
						<p>
							<?php echo $overAllPoints ?>
					  </p>
						<p>
							<?php echo number_format(100/$overAllPoints,2) ?>% </p>
				  </td>
			</tr>


		  </table>
			<br>
		<p>	<a href="quiz_add.php"><button>Add Question</button></a></p>
		
<p>	<a href="../index.php"><button>Back to top portal</button></a>	</p>



	  </main>
		<!--end main-->


	</div>
	<!--end container-->
</body>
</html>