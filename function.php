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
   /* Determine what function was called */
   if($_POST["operation"] == "1"){
      $year = $_POST["year"];
      $month = $_POST["month"];
      $day = $_POST["day"];
      $dbase = "int322_113b03";
      mysql_connect("db-mysql", "int322_113b03", "jpLN7296") or die("unable to connect to database");
      @mysql_select_db("int322_113b03") or die("unable to select database");

      if($day == '' && $month == ''){
         $query = "Select * from lotto_649_winning_nums where substr(ddate,1,4) LIKE '$year'";
         $result = mysql_query($query);
      }
      if($day == '' && $month >= '1'){
         $query = "Select * from lotto_649_winning_nums where substr(ddate,1,4) LIKE '$year' AND substr(ddate,6,2) LIKE '$month'";
         $result = mysql_query($query);
      }
      if($day != '' && $month != ''){
         $query = "Select * from lotto_649_winning_nums where ddate LIKE '$year-$month-$day'";
         $result = mysql_query($query);
      }

      $num = mysql_numrows($result);

      if(!$result){
         die(mysql_error());
      }

      mysql_close();

      echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
      echo "<h3>Lottery Numbers For This Date</h3>";

      if($num < 1){
         echo "There are no lottery numbers that match with this date.<br />Try inputting a different date.";
      }
      else{
         $a = 0;
         while($a < $num){
            $id = mysql_result($result,$a,"id");
            $ddate = mysql_result($result,$a,"ddate");
            $ball1 = mysql_result($result,$a,"ball1");
            $ball2 = mysql_result($result,$a,"ball2");
            $ball3 = mysql_result($result,$a,"ball3");
            $ball4 = mysql_result($result,$a,"ball4");
            $ball5 = mysql_result($result,$a,"ball5");
            $ball6 = mysql_result($result,$a,"ball6");
            $bonus = mysql_result($result,$a,"bonus");

            echo "Draw: $id $ddate $ball1 $ball2 $ball3 $ball4 $ball5 $ball6 $bonus<br />";

            $a++;
         }
      }
   }
   if($_POST["operation"] == "2"){
      $min = $_POST["min"];
      $max = $_POST["max"];

      /* Determine if the minimum and maximum values are valid */
      if($min < 21 || $max > 279 || $min >= $max || preg_match('/[^0-9]/', $min) || preg_match('/[^0-9]/', $max)){
         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Error! You must submit the following for this to be right:</h3><br />";
         echo "The minimum value must be greater than 20.<br />";
         echo "The maximum value must be less than 280.<br />";
         echo "The minimum value must be less than the maximum value.<br />";
         echo "BOTH values must be numeric.";
      }
      else{
         mysql_connect("db-mysql", "int322_113b03", "jpLN7296") or die("unable to connect to database");
         @mysql_select_db("int322_113b03") or die("unable to select database");
         $query = "Select * from lotto_649_winning_nums";
         $result = mysql_query($query);
         $num = mysql_numrows($result);

         if(!$result){
            die(mysql_error());
         }

         mysql_close();

         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Lottery Numbers For This Range</h3>";
         echo "<h4>If nothing appeared, try inputting a different value again until your range brings up a lottery draw.</h4>";

         if($num < 1){
            echo "There are no lottery numbers that match with this range.<br />Try inputting a different range.";
         }
         else{
            $a = 0;
            while($a < $num){
               $id = mysql_result($result,$a,"id");
               $ddate = mysql_result($result,$a,"ddate");
               $ball1 = mysql_result($result,$a,"ball1");
               $ball2 = mysql_result($result,$a,"ball2");
               $ball3 = mysql_result($result,$a,"ball3");
               $ball4 = mysql_result($result,$a,"ball4");
               $ball5 = mysql_result($result,$a,"ball5");
               $ball6 = mysql_result($result,$a,"ball6");
               $bonus = mysql_result($result,$a,"bonus");

               $sum = $ball1 + $ball2 + $ball3 + $ball4 + $ball5 + $ball6;

               if($sum >= $min && $sum <= $max){
                  echo "Draw: $id $ddate $ball1 $ball2 $ball3 $ball4 $ball5 $ball6 $bonus<br />";
               }

               $a++;
            }
         }
      }
   }
   if($_POST["operation"] == "3"){
      $ballNum = $_POST["ball"];

      /* Determine if the ball number is in between 1-7 */
      if($ballNum < 1 || $ballNum > 7 || preg_match('/[^0-9]/', $ballNum)){
         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Error! You must submit the following for this to be right:</h3><br />";
         echo "The ball number must be between 1-7.<br />";
         echo "The ball number must be numeric.";
      }
      else{
         mysql_connect("db-mysql", "int322_113b03", "jpLN7296") or die("unable to connect to database");
         @mysql_select_db("int322_113b03") or die("unable to select database");
         $query = "Select * from lotto_649_winning_nums";
         $result = mysql_query($query);
         $num = mysql_numrows($result);

         if(!$result){
            die(mysql_error());
         }

         mysql_close();

         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Mean value for this ball number</h3>";

         if($num < 1){
            echo "There are no lottery numbers that can be calculated with this ball number.<br />Try inputting a different ball number.";
         }
         else{
            $a = 0;
            $sum = 0;
            while($a < $num){
               $id = mysql_result($result,$a,"id");
               $ddate = mysql_result($result,$a,"ddate");
               $ball1 = mysql_result($result,$a,"ball1");
               $ball2 = mysql_result($result,$a,"ball2");
               $ball3 = mysql_result($result,$a,"ball3");
               $ball4 = mysql_result($result,$a,"ball4");
               $ball5 = mysql_result($result,$a,"ball5");
               $ball6 = mysql_result($result,$a,"ball6");
               $bonus = mysql_result($result,$a,"bonus");

               $a++;

               /* Calculate the sum by whichever ball value you inputted */
               if($ballNum == '1'){
                  $sum += $ball1;
               }
               if($ballNum == '2'){
                  $sum += $ball2;
               }
               if($ballNum == '3'){
                  $sum += $ball3;
               }
               if($ballNum == '4'){
                  $sum += $ball4;
               }
               if($ballNum == '5'){
                  $sum += $ball5;
               }
               if($ballNum == '6'){
                  $sum += $ball6;
               }
               if($ballNum == '7'){
                  $sum += $bonus;
               }
            }
               $mean = $sum / $a;
               $mean = sprintf("%.4f", $mean);

               echo "For lottery: Lotto 6/49 the mean value of ball #$ballNum is: $mean<br />";
         }
      }
   }
   if($_POST["operation"] == '4'){
      $one = $_POST["ballone"];
      $two = $_POST["balltwo"];
      $three = $_POST["ballthree"];
      $four = $_POST["ballfour"];
      $five = $_POST["ballfive"];
      $six = $_POST["ballsix"];

      /* Determine if the inputted values are numeric*/
      if(preg_match('/[^0-9]/', $one) || preg_match('/[^0-9]/', $two) || preg_match('/[^0-9]/', $three) || preg_match('/[^0-9]/', $four) || preg_match('/[^0-9]/', $five) || preg_match('/[^0-9]/', $six)){
         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Error! You must submit the following for this to be right:</h3><br />";
         echo "The values for each ball number must be between numeric.<br />";
      }
      else{
         mysql_connect("db-mysql", "int322_113b03", "jpLN7296") or die("unable to connect to database");
         @mysql_select_db("int322_113b03") or die("unable to select database");
         $query = "Select * from lotto_649_winning_nums";
         $result = mysql_query($query);
         $num = mysql_numrows($result);

         if(!$result){
            die(mysql_error());
         }

         mysql_close();

         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Chosen numbers that have either won or lost</h3>";

         if($num < 1){
            echo "There are no numbers that match with any of the lottery numbers.<br />Try inputting your values again.";
         }
         else{
            $a = 0;
            $ok = 0;
            while($a < $num){
               $id = mysql_result($result,$a,"id");
               $ddate = mysql_result($result,$a,"ddate");
               $ball1 = mysql_result($result,$a,"ball1");
               $ball2 = mysql_result($result,$a,"ball2");
               $ball3 = mysql_result($result,$a,"ball3");
               $ball4 = mysql_result($result,$a,"ball4");
               $ball5 = mysql_result($result,$a,"ball5");
               $ball6 = mysql_result($result,$a,"ball6");
               $bonus = mysql_result($result,$a,"bonus");

               /* Determine if each ball number matches one of the lottery draws */
               if($ball1 == $one){
                  if($ball2 == $two){
                     if($ball3 == $three){
                        if($ball4 == $four){
                           if($ball5 == $five){
                              if($ball6 == $six){
                                 $ok = 1;
                              }
                           }
                        }
                     }
                  }
               }

               $a++;
            }

            /* Display the lottery row if all ball numbers were correct */
            if($ok == 1){
               echo "Your numbers: $one, $two, $three, $four, $five, $six have won!";
            }
            else{
                echo "Your numbers: $one, $two, $three, $four, $five, $six have never won!";
            }
         }
      }
   }
   /* Lotto MAX */
   if($_POST["operation"] == "5"){
      $year = $_POST["year"];
      $month = $_POST["month"];
      $day = $_POST["day"];
      $dbase = "int322_113b03";
      mysql_connect("db-mysql", "int322_113b03", "jpLN7296") or die("unable to connect to database");
      @mysql_select_db("int322_113b03") or die("unable to select database");

      if($day == '' && $month == ''){
         $query = "Select * from lotto_MAX_winning_nums where substr(ddate,1,4) LIKE '$year'";
         $result = mysql_query($query);
      }
      if($day == '' && $month >= '1'){
         $query = "Select * from lotto_MAX_winning_nums where substr(ddate,1,4) LIKE '$year' AND substr(ddate,6,2) LIKE '$month'";
         $result = mysql_query($query);
      }
      if($day != '' && $month != ''){
         $query = "Select * from lotto_MAX_winning_nums where ddate LIKE '$year-$month-$day'";
         $result = mysql_query($query);
      }

      $num = mysql_numrows($result);

      if(!$result){
         die(mysql_error());
      }

      mysql_close();

      echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
      echo "<h3>Lottery Numbers For This Date</h3>";

      if($num < 1){
         echo "There are no lottery numbers that match with this date.<br />Try inputting a different date.";
      }
      else{
         $a = 0;
         while($a < $num){
            $id = mysql_result($result,$a,"id");
            $ddate = mysql_result($result,$a,"ddate");
            $ball1 = mysql_result($result,$a,"ball1");
            $ball2 = mysql_result($result,$a,"ball2");
            $ball3 = mysql_result($result,$a,"ball3");
            $ball4 = mysql_result($result,$a,"ball4");
            $ball5 = mysql_result($result,$a,"ball5");
            $ball6 = mysql_result($result,$a,"ball6");
            $ball7 = mysql_result($result,$a,"ball7");
            $bonus = mysql_result($result,$a,"bonus");

            echo "Draw: $id $ddate $ball1 $ball2 $ball3 $ball4 $ball5 $ball6 $ball7 $bonus<br />";

            $a++;
         }
      }
   }
   if($_POST["operation"] == "6"){
      $min = $_POST["min"];
      $max = $_POST["max"];

      /* Determine if the minimum and maximum values are valid */
      if($min < 28 || $max > 308 || $min >= $max || preg_match('/[^0-9]/', $min) || preg_match('/[^0-9]/', $max)){
         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Error! You must submit the following for this to be right:</h3><br />";
         echo "The minimum value must be greater than 27.<br />";
         echo "The maximum value must be less than 309.<br />";
         echo "The minimum value must be less than the maximum value.<br />";
         echo "BOTH values must be numeric.";
      }
      else{
         mysql_connect("db-mysql", "int322_113b03", "jpLN7296") or die("unable to connect to database");
         @mysql_select_db("int322_113b03") or die("unable to select database");
         $query = "Select * from lotto_MAX_winning_nums";
         $result = mysql_query($query);
         $num = mysql_numrows($result);

         if(!$result){
            die(mysql_error());
         }

         mysql_close();

         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Lottery Numbers For This Range</h3>";
         echo "<h4>If nothing appeared, try inputting a different value again until your range brings up a lottery draw.</h4>";

         if($num < 1){
            echo "There are no lottery numbers that match with this range.<br />Try inputting a different range.";
         }
         else{
            $a = 0;
            while($a < $num){
               $id = mysql_result($result,$a,"id");
               $ddate = mysql_result($result,$a,"ddate");
               $ball1 = mysql_result($result,$a,"ball1");
               $ball2 = mysql_result($result,$a,"ball2");
               $ball3 = mysql_result($result,$a,"ball3");
               $ball4 = mysql_result($result,$a,"ball4");
               $ball5 = mysql_result($result,$a,"ball5");
               $ball6 = mysql_result($result,$a,"ball6");
               $ball7 = mysql_result($result,$a,"ball7");
               $bonus = mysql_result($result,$a,"bonus");

               $sum = $ball1 + $ball2 + $ball3 + $ball4 + $ball5 + $ball6 + $ball7;

               if($sum >= $min && $sum <= $max){
                  echo "Draw: $id $ddate $ball1 $ball2 $ball3 $ball4 $ball5 $ball6 $ball7 $bonus<br />";
               }

               $a++;
            }
         }
      }
   }
   if($_POST["operation"] == "7"){
      $ballNum = $_POST["ball"];

      /* Determine if the ball number is in between 1-8 */
      if($ballNum < 1 || $ballNum > 8 || preg_match('/[^0-9]/', $ballNum)){
         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Error! You must submit the following for this to be right:</h3><br />";
         echo "The ball number must be between 1-8.<br />";
         echo "The ball number must be numeric.";
      }
      else{
         mysql_connect("db-mysql", "int322_113b03", "jpLN7296") or die("unable to connect to database");
         @mysql_select_db("int322_113b03") or die("unable to select database");
         $query = "Select * from lotto_MAX_winning_nums";
         $result = mysql_query($query);
         $num = mysql_numrows($result);

         if(!$result){
            die(mysql_error());
         }

         mysql_close();

         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Mean value for this ball number</h3>";

         if($num < 1){
            echo "There are no lottery numbers that can be calculated with this ball number.<br />Try inputting a different ball number.";
         }
         else{
            $a = 0;
            $sum = 0;
            while($a < $num){
               $id = mysql_result($result,$a,"id");
               $ddate = mysql_result($result,$a,"ddate");
               $ball1 = mysql_result($result,$a,"ball1");
               $ball2 = mysql_result($result,$a,"ball2");
               $ball3 = mysql_result($result,$a,"ball3");
               $ball4 = mysql_result($result,$a,"ball4");
               $ball5 = mysql_result($result,$a,"ball5");
               $ball6 = mysql_result($result,$a,"ball6");
               $ball7 = mysql_result($result,$a,"ball7");
               $bonus = mysql_result($result,$a,"bonus");

               $a++;

               /* Calculate the sum by whichever ball value you inputted */
               if($ballNum == '1'){
                  $sum += $ball1;
               }
               if($ballNum == '2'){
                  $sum += $ball2;
               }
               if($ballNum == '3'){
                  $sum += $ball3;
               }
               if($ballNum == '4'){
                  $sum += $ball4;
               }
               if($ballNum == '5'){
                  $sum += $ball5;
               }
               if($ballNum == '6'){
                  $sum += $ball6;
               }
               if($ballNum == '7'){
                  $sum += $ball7;
               }
               if($ballNum == '8'){
                  $sum += $bonus;
               }
            }
               $mean = $sum / $a;
               $mean = sprintf("%.4f", $mean);

               echo "For lottery: Lotto MAX the mean value of ball #$ballNum is: $mean<br />";
         }
      }
   }
   if($_POST["operation"] == '8'){
      $one = $_POST["ballone"];
      $two = $_POST["balltwo"];
      $three = $_POST["ballthree"];
      $four = $_POST["ballfour"];
      $five = $_POST["ballfive"];
      $six = $_POST["ballsix"];
      $seven = $_POST["ballseven"];

      /* Determine if the inputted values are numeric*/
      if(preg_match('/[^0-9]/', $one) || preg_match('/[^0-9]/', $two) || preg_match('/[^0-9]/', $three) || preg_match('/[^0-9]/', $four) || preg_match('/[^0-9]/', $five) || preg_match('/[^0-9]/', $six) || preg_match('/[^0-9]/', $seven)){
         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Error! You must submit the following for this to be right:</h3><br />";
         echo "The values for each ball number must be between numeric.<br />";
      }
      else{
         mysql_connect("db-mysql", "int322_113b03", "jpLN7296") or die("unable to connect to database");
         @mysql_select_db("int322_113b03") or die("unable to select database");
         $query = "Select * from lotto_MAX_winning_nums";
         $result = mysql_query($query);
         $num = mysql_numrows($result);

         if(!$result){
            die(mysql_error());
         }

         mysql_close();

         echo "<p><a href='http://zenit.senecac.on.ca/~int322_113b03/int322_113b033.html'>Lottery Finder</a></p>";
         echo "<h3>Chosen numbers that have either won or lost</h3>";

         if($num < 1){
            echo "There are no numbers that match with any of the lottery numbers.<br />Try inputting your values again.";
         }
         else{
            $a = 0;
            while($a < $num){
               $id = mysql_result($result,$a,"id");
               $ddate = mysql_result($result,$a,"ddate");
               $ball1 = mysql_result($result,$a,"ball1");
               $ball2 = mysql_result($result,$a,"ball2");
               $ball3 = mysql_result($result,$a,"ball3");
               $ball4 = mysql_result($result,$a,"ball4");
               $ball5 = mysql_result($result,$a,"ball5");
               $ball6 = mysql_result($result,$a,"ball6");
               $ball7 = mysql_result($result,$a,"ball7");
               $bonus = mysql_result($result,$a,"bonus");

               /* Determine if each ball number matches one of the lottery draws */
               if($ball1 == $one){
                  if($ball2 == $two){
                     if($ball3 == $three){
                        if($ball4 == $four){
                           if($ball5 == $five){
                              if($ball6 == $six){
                                 if($ball7 == $seven){
                                    $ok = 1;
                                 }
                              }
                           }
                        }
                     }
                  }
               }

               $a++;
            }

            /* Display the lottery row if all ball numbers were correct */
            if($ok == 1){
               echo "Your numbers: $one, $two, $three, $four, $five, $six, $seven have won!";
            }
            else{
                echo "Your numbers: $one, $two, $three, $four, $five, $six, $seven have never won!";
            }
         }
      }
   }

?>
</body></html>
