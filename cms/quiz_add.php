<?php
//add
require('../config.php'); 

if (isset($_POST['submit'])) {

	
$question_statement = $_POST['question_statement'];

$replace_str = "'";
$question_statement = str_replace($replace_str, "\'", $question_statement);

$replace_str = '"';
$question_statement = str_replace($replace_str, '\"', $question_statement);

	
	$question_answer = $_POST['question_answer'];
	$question_points = $_POST['question_points'];

	
	
	
	
$insertSQL = "INSERT INTO questions_tbl
(question_statement, question_answer, question_points)
VALUES
('$question_statement','$question_answer','$question_points')";
$result = $makeconnection->query( $insertSQL );

header ("Location: quiz_read.php");
}

?>



<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width,initial-scale=1.0" name="viewport">
	<title>Add Question</title>
	<link href="cms_style.css" rel="stylesheet" type="text/css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="../jquery-validation/dist/jquery.validate.js"></script>
	<link href="../jquery-validation/basic_form_styling.css" rel="stylesheet" type="text/css">
</head>
<div id="container">
	<header>
		<h1>CMS (teacher area): Add question</h1>
		<p><a href="quiz_read.php">Back to quiz</a>
		</p>
	</header>

	<main>

		<form action="" method="post" id="add_question_form">
			<table width="100%" border="0" cellspacing="10">
				<tr>
					<td colspan="2" align="center">
						<h2>Add Question</h2>
					</td>
				</tr>
				<tr>
					<td width="25%" height="150" align="right" valign="top">Statement</td>
					<td valign="top"><input type="text" name="question_statement" id="question_statement" required size="50" maxlength="150">
					</td>
				</tr>

				<tr>
					<td width="25%" height="150" align="right" valign="top">Correct answer</td>
					<td valign="top">
						<label>true </label>
						<input type="radio" id="question_answer" name="question_answer" value="1"/>
					<br>

						<label>false</label>
						<input type="radio" id="question_answer" name="question_answer" value="0"/>
						<br>
						
						<label for="question_answer" class="radioreq error"></label>

					</td>
				</tr>

					<tr>
					<td width="25%" height="150" align="right" valign="top">Points</td>
					<td valign="top">
						<select name="question_points" id="question_points" required>
							<option selected disabled>assign points</option>
							<?php
								for ($i=100;$i>=5;$i-=5){
								echo "<option value=\"$i\">Question is  worth $i points</option>";
								}
							?>
						</select>
						<br>
							<label for="question_points" class="selectreq error"></label>
					</td>
				</tr>


				<tr>
					<td align="right" valign="middle">&nbsp;</td>
					<td><input type="submit" name="submit" id="submit" value="Submit">
					</td>
				</tr>

			</table>

		</form>
		<script>
			$( "#add_question_form" ).validate( {
				rules: {
					question_statement: {
						required: true
					},
					question_answer: {
						required: true
					},
					question_points: {
						required: true
					}
				},
				messages: {
					question_statement: "Compose a statement!",
					question_answer: "Choose a correct answer!",
					question_points: "Assign points, example: \"25\"."

				}
			} );
		</script>
	</main>
	<!--end main-->


</div>
<!--end container-->

<body>
</body>
</html>