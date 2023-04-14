<?php
require( "../config.php" );
$student_email = $_POST[ 'student_email' ];
$student_first = $_POST[ 'student_first' ];
$student_last = $_POST[ 'student_last' ];
$student_datetime = date_create()->format( 'Y-m-d H:i:s' );
//echo $student_email;

$find_email = "SELECT * FROM students_tbl WHERE student_email ='$student_email' ";
//hey, is there such an email already?
$wasfound = $makeconnection->query( $find_email );
//press send, 0 or 1
$count = $wasfound->num_rows; // how many? 0 or 1
//echo $count;
if ( $count > 0 ) {
  //found this email BAAAAAAAD
  header( "Location: quiz_take.php?message=emailfound" );
  //redirect with message
} else {
  //GOOOOD! no such email found time to process!!!


  $posted = $_POST; /// capture all the form as one big array
  //print_r($posted);

  $question_value_array = array_values( $posted ); // extrtact an array of only values
  //print_r($question_value_array);
  $question_value_array = array_slice( $question_value_array, 3 );//slice it at index 3	
  //print_r($question_value_array);
  array_pop( $question_value_array ); // get rid of the last one, submit.

  //print_r($question_value_array);
  $max_avail_points = 0;
  $points_earned = 0;
  $correct_answers = 0;
  $incorrect_answers = 0;
  $current = "0";

  $sql_get_all = "SELECT * FROM questions_tbl"; ///ask the db for the real info
  $result = $makeconnection->query( $sql_get_all );
  ///press send
  ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Quiz processor</title>
<link href="front_style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="container">
  <header>
    <h1>Quiz Results</h1>
  </header>
  <main>
    <?php

    echo "<h2>Name:  $student_first $student_last </h2>";
    echo "<h3>Email:  $student_email </h3>";
    echo "<h3>Date-time exam was taken:  $student_datetime </h3>";
    echo "<hr>";
    echo "<h3> Exam results</h3><br>";


    while ( $row = $result->fetch_assoc() ) { //while there are quiestions to convert to assoc array.
      if ( $question_value_array[ $current ] == $row[ 'question_answer' ] ) { //does the student answer match the db?
        $correct_answers += 1; // up by 1
        $points_earned += $row[ 'question_points' ];

        echo "<p>Question " . ( $current + 1 ) . " correct, earned " . $row[ 'question_points' ] . " points</p>";
      } else { //if no match
        $incorrect_answers += 1;
        echo '<p class="wrong">Question ' . ( $current + 1 ) . " incorrect, earned 0 points</p>";

      }
      $max_avail_points += $row[ 'question_points' ];
      $current++;
    } //end while loop
    echo "<hr>";
    echo "Total correct answers: $correct_answers <br>";
    echo "Total incorrect answers: $incorrect_answers <br>";
    echo "<h2>Total points earned: $points_earned out of $max_avail_points</h2>";
    $student_percent = number_format( $points_earned / $max_avail_points * 100, 1 );
    echo "<h2>Percent earned: $student_percent%</h2>";


    $sql_insert_result = "INSERT INTO students_tbl
 (student_first, student_last, student_email, student_points, student_outof, student_percent, student_datetime)
  VALUES
  ('$student_first', '$student_last', '$student_email', $points_earned, $max_avail_points, $student_percent, '$student_datetime')";

    if ( $result = $makeconnection->query( $sql_insert_result ) ) {
      echo "success";
    } else {
      echo "error-unable to insert row to students_tbl";
    }


    }
    ?>
    <br>
    <a href="../index.php">
    <button>developer: Back to top portal</button>
    </a> </main>
</div>
</body>
</html>