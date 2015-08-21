<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
  <title>Assignment 3</title>

  <style type="text/css">
    .ref0 { font-family: Georgia, monospace; font-size: 14pt }
    .ref1 { font-family: Georgia, monospace; font-size: 18pt; color: #0000ff }
    .ref2 { font-family: Georgia, monospace; font-size: 12pt; color: #ff0000 }
    .ref3 { font-family: Georgia, monospace; font-size: 10pt }
  </style>
</head>
<body>
<form method="post" action="function.php">

<?php
/* ********************************
   Samuel Azan
   036742104
   Section B
   LOTTERY FINDER: Select either Lotto6/49 or LottoMax,
                   and allow the user to select one of the 
                   four functions that will take your input
                   and display the actual/correct lottery draw.
   Danny Abesdris
   Due Date: Monday December 5, 2011
   Date submitted: Monday December 5, 2011
********************************** */
/* Determine if the lottery and function value exists */
if(isset($_POST["lottery"]) && isset($_POST["function"])):
	/* Determine which lottery your running the functions with */
	if($_POST["lottery"] == "lotto649"):
			/* Determine which function was chosen */
			if($_POST["function"] == "F1"):
?>
				<input type='hidden' name='operation' value='1' />
				
				<!-- List out the valid dates that the user can select -->
				<!-- Day -->
				<h3>Select the day, month, and year</h3>
				Day: <select name='day'>
					<option value='' selected='selected'></option>
					<option value='01'>1</option>
					<option value='02'>2</option>
					<option value='03'>3</option>
					<option value='04'>4</option>
					<option value='05'>5</option>
					<option value='06'>6</option>
					<option value='07'>7</option>
					<option value='08'>8</option>
					<option value='09'>9</option>
					<option value='10'>10</option>
					<option value='11'>11</option>
					<option value='12'>12</option>
					<option value='13'>13</option>
					<option value='14'>14</option>
					<option value='15'>15</option>
					<option value='16'>16</option>
					<option value='17'>17</option>
					<option value='18'>18</option>
					<option value='19'>19</option>
					<option value='20'>20</option>
					<option value='21'>21</option>
					<option value='22'>22</option>
					<option value='23'>23</option>
					<option value='24'>24</option>
					<option value='25'>25</option>
					<option value='26'>26</option>
					<option value='27'>27</option>
					<option value='28'>28</option>
					<option value='29'>29</option>
					<option value='30'>30</option>
					<option value='31'>31</option>
				</select>

				<!-- echo "\t"; -->
				&nbsp; &nbsp; &nbsp; &nbsp;
				
				<!-- Month -->
				Month: <select name='month'>
					<option value='' selected='selected'></option>
					<option value='01'>January</option>
					<option value='02'>February</option>
					<option value='03'>March</option>
					<option value='04'>April</option>
					<option value='05'>May</option>
					<option value='06'>June</option>
					<option value='07'>July</option>
					<option value='08'>August</option>
					<option value='09'>September</option>
					<option value='10'>October</option>
					<option value='11'>November</option>
					<option value='12'>December</option>
				</select>

				<!-- echo "\t"; -->
				&nbsp; &nbsp; &nbsp; &nbsp;

				<!-- Year -->
				Year: <select name='year'>
					<option value='2011' selected='selected'>2011</option>
					<option value='2010'>2010</option>
					<option value='2009'>2009</option>
					<option value='2008'>2008</option>
					<option value='2007'>2007</option>
					<option value='2006'>2006</option>
					<option value='2005'>2005</option>
					<option value='2004'>2004</option>
					<option value='2003'>2003</option>
					<option value='2002'>2002</option>
					<option value='2001'>2001</option>
					<option value='2000'>2000</option>
					<option value='1999'>1999</option>
					<option value='1998'>1998</option>
					<option value='1997'>1997</option>
					<option value='1996'>1996</option>
					<option value='1995'>1995</option>
					<option value='1994'>1994</option>
					<option value='1993'>1993</option>
					<option value='1992'>1992</option>
					<option value='1991'>1991</option>
					<option value='1990'>1990</option>
					<option value='1989'>1989</option>
					<option value='1988'>1988</option>
					<option value='1987'>1987</option>
					<option value='1986'>1986</option>
					<option value='1985'>1985</option>
					<option value='1984'>1984</option>
					<option value='1983'>1983</option>
					<option value='1982'>1982</option>
				</select>

				<!-- echo "\t"; -->
				&nbsp; &nbsp; &nbsp; &nbsp;
				
				<input type='submit' value='Check the date' />
<?php
			elseif($_POST["function"] == "F2"):
?>
				<input type='hidden' name='operation' value='2' />

				<h3>Determine what the minimum and maximum numbers are</h3>
				
				<!-- Min -->
				Min: <input type='text' name='min' />
				&nbsp; &nbsp; &nbsp; &nbsp;
				
				<!-- Max -->
				Max: <input type='text' name='max' />
				&nbsp; &nbsp; &nbsp; &nbsp;
				
				<input type='submit' value='Check the range between these numbers' />
<?php
			elseif($_POST["function"] == "F3"):
?>
				<input type='hidden' name='operation' value='3' />

				<h3>Choose a ball number from 1-7 (bonus number included), that you want to find the MEAN value for.</h3>
				Ball Number: <input type='text' name='ball' />
				&nbsp; &nbsp; &nbsp; &nbsp;

				<input type='submit' value='Determine the MEAN value from that ball' />
<?php
			elseif($_POST["function"] == "F4"):
?>
				<input type='hidden' name='operation' value='4' />

				<h3>Fill in the values with your favourite numbers, for each ball number (excluding bonus number), that will display your numbers that won.</h3>

				<!-- Balls 1-6 -->
				Ball #1: <input type='text' name='ballone' /><br /><br />
				Ball #2: <input type='text' name='balltwo' /><br /><br />
				Ball #3: <input type='text' name='ballthree' /><br /><br />
				Ball #4: <input type='text' name='ballfour' /><br /><br />
				Ball #5: <input type='text' name='ballfive' /><br /><br />
				Ball #6: <input type='text' name='ballsix' /><br /><br />

				<input type='submit' value='Determine if these lottery numbers have won' />
<?php				
			else:
?>		
				<h1>You need to choose a function</h1>
<?php
			endif;
	endif;
if($_POST["lottery"] == "lottoMax"):
        /* Determine which function was chosen */
        if($_POST["function"] == "F1"):
?>
			<input type='hidden' name='operation' value='5' />
			
			<!-- List out the valid dates that the user can select -->
			<!-- Day -->
			<h3>Select the day, month, and year</h3>
			Day: <select name='day'>
				<option value='' selected='selected'></option>
				<option value='01'>1</option>
				<option value='02'>2</option>
				<option value='03'>3</option>
				<option value='04'>4</option>
				<option value='05'>5</option>
				<option value='06'>6</option>
				<option value='07'>7</option>
				<option value='08'>8</option>
				<option value='09'>9</option>
				<option value='10'>10</option>
				<option value='11'>11</option>
				<option value='12'>12</option>
				<option value='13'>13</option>
				<option value='14'>14</option>
				<option value='15'>15</option>
				<option value='16'>16</option>
				<option value='17'>17</option>
				<option value='18'>18</option>
				<option value='19'>19</option>
				<option value='20'>20</option>
				<option value='21'>21</option>
				<option value='22'>22</option>
				<option value='23'>23</option>
				<option value='24'>24</option>
				<option value='25'>25</option>
				<option value='26'>26</option>
				<option value='27'>27</option>
				<option value='28'>28</option>
				<option value='29'>29</option>
				<option value='30'>30</option>
				<option value='31'>31</option>
			</select>

			<!-- echo "\t"; -->
			&nbsp; &nbsp; &nbsp; &nbsp;

			<!-- Month -->
			Month: <select name='month'>
				<option value='' selected='selected'></option>
				<option value='01'>January</option>
				<option value='02'>February</option>
				<option value='03'>March</option>
				<option value='04'>April</option>
				<option value='05'>May</option>
				<option value='06'>June</option>
				<option value='07'>July</option>
				<option value='08'>August</option>
				<option value='09'>September</option>
				<option value='10'>October</option>
				<option value='11'>November</option>
				<option value='12'>December</option>
			</select>

			<!-- echo "\t"; -->
			&nbsp; &nbsp; &nbsp; &nbsp;

			<!-- Year -->
			Year: <select name='year'>
				<option value='2011' selected='selected'>2011</option>
				<option value='2010'>2010</option>
				<option value='2009'>2009</option>
			</select>

			<!-- echo "\t"; -->
			&nbsp; &nbsp; &nbsp; &nbsp;
			
			<input type='submit' value='Check the date' />
<?php
        elseif($_POST["function"] == "F2"):
?>
			<input type='hidden' name='operation' value='6' />

			<h3>Determine what the minimum and maximum numbers are</h3>
			
			<!-- Min -->
			Min: <input type='text' name='min' />
			&nbsp; &nbsp; &nbsp; &nbsp;
			
			<!-- Max -->
			Max: <input type='text' name='max' />
			&nbsp; &nbsp; &nbsp; &nbsp;

			<input type='submit' value='Check the range between these numbers' />
<?php
        elseif($_POST["function"] == "F3"):
?>
			<input type='hidden' name='operation' value='7' />

			<h3>Choose a ball number from 1-8 (bonus number included), that you want to find the MEAN value for.</h3>
			Ball Number: <input type='text' name='ball' />
			&nbsp; &nbsp; &nbsp; &nbsp;

			<input type='submit' value='Determine the MEAN value from that ball' />
<?php
        elseif($_POST["function"] == "F4"):
?>
                <input type='hidden' name='operation' value='8' />

                <h3>Fill in the values with your favourite numbers, for each ball number (excluding bonus number), that will display your numbers that won.</h3>

                <!-- Balls 1-6 -->
                Ball #1: <input type='text' name='ballone' /><br /><br />
                Ball #2: <input type='text' name='balltwo' /><br /><br />
                Ball #3: <input type='text' name='ballthree' /><br /><br />
                Ball #4: <input type='text' name='ballfour' /><br /><br />
                Ball #5: <input type='text' name='ballfive' /><br /><br />
                Ball #6: <input type='text' name='ballsix' /><br /><br />
                Ball #7: <input type='text' name='ballseven' /><br /><br />

                <input type='submit' value='Determine if these lottery numbers have won' />
<?php
        else:
?>
                <h1>You need to choose a function</h1>
<?php
		endif;
endif;
endif;
?>

<!-- <p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>"; -->
<p><a href='int322_113b033.html'>Lottery Finder</a></p>

</form>
</body></html>
