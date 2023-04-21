<?php
//take quiz
require( "../config.php" );
$sql_get_all = "SELECT * FROM questions_tbl";
$result = $makeconnection->query( $sql_get_all );
$overAllPoints = 0; ///the sum of all the points in the quiz
$num = 0; //question number

if (isset($_GET['message']) && $_GET['message'] != "") {
    $message = $_GET[ 'message' ]; //if there is a var called messgae on URL- find it.
} else {
    $message = "";
}



?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Take Quiz</title>
<link href="front_style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
<script src="../jquery-validation/dist/jquery.validate.js"></script>
<link href="../jquery-validation/basic_form_styling.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="container">
  <header>
    <h1>Take Quiz</h1>
  </header>
  <main>
    <form action="quiz_process.php" method="post" id="take_quiz_form">
      <table class="info" width="100%" border="0">
        <!--this is the user info table.-->
        <tr>
          <td width="16%">First name*</td>
          <td width="84%"><input type="text" name="student_first" id="student_first" required></td>
        </tr>
        <tr>
          <td>Last Name*</td>
          <td><input type="text" name="student_last" id="student_last" required></td>
        </tr>
        <tr>
          <td>Email*</td>
          <td><input type="email" name="student_email" id="student_email" required>
            <?php
            if ( $message == "emailfound" ) { //this email is already used
              echo '<p class="wrong">Sorry, it seemns like the owner of this email already took the exam</p>';
            }

            ?></td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr>
          <th>#</th>
          <th>Statement</th>
          <th>Answer</th>
          <th>Points</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php $num++; echo $num ?></td>
          <td><?php echo $row["question_statement"]; ?></td>
          <td>
			<label>true </label>
            <input type="radio" id="question_answer" name="<?php echo $row["question_id"];?>" required value="1"/>
            <br>
            <label>false</label>
            <input type="radio" id="question_answer" name="<?php echo $row["question_id"];?>" required value="0"/>
            <br></td>
          <td><?php echo $row["question_points"]; ?></td>
        </tr>
        <?php

        $overAllPoints += $row[ "question_points" ];

        } //end while


        ?>
        <tr class="tableTotals">
          <td colspan="3" align="right"><p style="text-align: right">The total number of points in the quiz is:</p>
            <p style="text-align: right"> Each point in the quiz is worth:</p></td>
          <td><p> <?php echo $overAllPoints ?> </p>
            <p> <?php echo number_format(100/$overAllPoints,2) ?>% </p></td>
        </tr>
        <tr class="tableTotals">
          <td colspan="3" align="right" valign="middle">&nbsp;</td>
          <td><input type="submit" name="submit" id="submit" value="Submit"></td>
        </tr>
      </table>
    </form>
    <script>
			$( "#take_quiz_form" ).validate();
		</script> 
  </main>
  <!--end main--> 
  
</div>
<!--end container-->
</body>
</html>