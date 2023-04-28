<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Email contact form example</title>
<script type="text/javascript" src="jquery-validation/lib/jquery.js"></script>
<!--gonna use jquer? gotta link to the lib first.-->
<script type="text/javascript" src="jquery-validation/dist/jquery.validate.js"></script>
<!--link to this specific script.-->
<link href="jquery-validation/basic_form_styling.css" rel="stylesheet" type="text/css">
<!--styles for the form validation-->
</head>

<body>
<h2>Please contact us!</h2>
<form method="post" action="email_process.php" id="email_form">
  <table width="950" border="0">
    <tbody>
      <tr>
        <td align="right" width="300">First name*:</td>
 <td><input type="text" name="firstName" id="firstName" required size="30" placeholder="first name"></td>
      </tr>
      <tr>
        <td align="right">Last name*</td>
        <td><input type="text" name="lastName" id="lastName" required size="30" placeholder="last name"></td>
      </tr>
      <tr>
        <td align="right">email*</td>
 <td><input type="email" name="email" id="email" required size="40" placeholder="user@domain.com"></td>
      </tr>
      <tr>
		  <!--example of a radio button group-->
        <td align="right">
			<h5>Do you rent ot own?</h5>
			 <p> Rent</p>
			<p>Own</p>
			<p>Other</p>
		  </td>
        <td><p>
         <h5> </h5>
         <p>   <input type="radio" name="rentOwn" value="rent" id="rentOwn_0"></p>
           
          
          
        <p>    <input type="radio" name="rentOwn" value="own" id="rentOwn_1" ></p>
            
        
		
       <p>     <input type="radio" name="rentOwn" value="other" id="rentOwn_2" ></p>
          
       
        </td>
      </tr>
      <tr>
		  <!--example of a checkbox-->
        <td align="right">Are you over 18?</td>
        <td><input type="checkbox" name="over18" id="over18" value="1" ></td>
      </tr>
      <tr>
        <td align="right">Date of birth</td>
        <td>
        <!--month-->
        	<select name="month" id="month" required>
        	<option value="" selected disabled>choose month</option>
        		<option value="1">Jan</option>
        		<option value="2">Feb</option>
        		<option value="3">Mar</option>
        		<option value="4">Apr</option>
        		<option value="5">May</option>
        		<option value="6">Jun</option>
        		<option value="7">Jul</option>
        		<option value="8">Aug</option>
        		<option value="9">Sep</option>
        		<option value="10">Oct</option>
        		<option value="11">Nov</option>
        		<option value="12">Dec</option>
        		</select>
        	<!--day-->
        	<select name="day" id="day" required>
        	<option value="" selected disabled>day</option>
        	<?php
        		for($i=1;$i<32;$i++){
		//loop thru a range of numbers. 3 parameter: start value;condition;increment	
					echo '<option value="'.$i.'">'.$i.'</option>';
				}//end for loop day
				
				
        		?>
        	</select>
        	
        	
        	<!--year-->
        	<select name="year" id="year" required>
        	<option value="" selected disabled>year</option>
        	<?php
        		for($i=2021;$i>1916;$i--){
		//loop thru a range of numbers. 3 parameter: start value;condition;increment	
					echo '<option value="'.$i.'">'.$i.'</option>';
				}//end for loop day
        		?>
        	</select>
        	
        	
        	
        </td>
      </tr>
      <tr>
        <td align="right">Comments</td>
        <td><textarea name="comments" cols="40" rows="7" id="comments"></textarea></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><input type="submit" value="Go!"></td>
      </tr>
    </tbody>
  </table>
	<script>
$("#email_form").validate( {//hey jq, please validate the form that has the id email_form
				rules: {
					firstName: {
						required: true
					},
					lastName: {
						required: true
					},
					email: {
						required: true
					},
					rentOwn: {
						required: true
					},
						month: {
						required: true
					},
						day: {
						required: true
					},
						
				},
				messages: {
					firstName: "Required",
					lastName: "Required",
					email: "Required",
					rentOwn: "Required",
					month: "Required",
					day: "Required",
					year: "Required"

				}
			} );
</script>

	
</form>
</body>
</html>