<?php
if(isset($_POST['firstName'])&&$_POST['firstName']!=""){
//hey, before we start, did we get a var called firstName? and its value is not empty?...that means the form passed format validation! lets process!!
$firstName=$_POST['firstName'];
$lastName=$_POST['lastName'];
$sender_email=$_POST['email'];
	

$rentOwn=$_POST['rentOwn'];

	
if (isset($_POST['over18'])){
$over18=$_POST['over18'];
		}else{
$over18="0";
}
	
$month=$_POST['month'];
$day=$_POST['day'];
$year=$_POST['year'];
	
$comments=$_POST['comments'];
//collecting, grabbing all the posts from the form into local vars.
//now some hidden vars.
$to="theguitarman2347@gmail.com";//recipient, to whom this form will be sent REPLACE WITH YOUrs!!!!!
$subject="Form submitted from my web dev site";
//the subject line of the email
	//now we start composing the body of the email:
$ebody="<html><body><h1>$subject</h1>";
//start the body wi the html structure, and a main heading.
$ebody.="<p>First Name: $firstName </p>";//append first name
$ebody.="<p> Last Name: $lastName </p>";//append last name
$ebody.="<p> Sender email: $sender_email </p>";//append email of the sender

if(isset($rentOwn)&&$rentOwn!=""){
//iff user picked something...
$ebody.="<p>Rent or own: $rentOwn </p>";//append value of rent or own
}else{//if none selected
$ebody.="<p>Rent or own: user didn't indicate</p>";
}//end if rent own


if($over18=='1'){//if the checkbox was checked....
$ebody.="<p>$firstName declares he/she is over 18 years of age</p>";
}else{//if box not checked-
$ebody.="<p>$firstName declares not over 18 years of age</p>";
}//end if-else

//now the date of birth
$ebody.="<p>Date of birth: $month/$day/$year</p>";//append the m d y
$ebody.="<p>Comments: $comments </p>";//append the comments
$ebody.="</body></html>";//close body close html
	
	
//now we format the headers
$headers="MIME-Version: 1.0\r\n";
//hey, recieving end (gmail)! this email complies with the standard called MIME
$headers.="Content-type:text/html;charset=utf-8\r\n";
//within the MIME standard, this email is: html formatted, and using utf-8
$headers .= "From: theguitarman2347@gmail.com \r\n";//your OWN email, the owner of the site! (REPLACE WITH YOUR OWN) a contact form is basically your own site sending an email to yourself. also helps with spam filtering.

$headers .= "Reply-To: $sender_email \r\n";
	
$fullName="$firstName $lastName";

$sent=mail($to,$subject,$ebody,$headers);
//now we can call the func mail(recipient,subject, content, headers-optional)

}//end of if form submitted
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	if($sent){
echo "<p> thank you ".ucwords($fullName).", you form was sent.</p>";
echo "<p>here is what you sent: </p> $ebody";
	}
?>

</body>
</html>