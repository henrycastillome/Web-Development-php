<!DOCTYPE html>
<html lang="en">

<head>
    <title>Codehw1 </title>
</head>
<style>
input[type=number], select {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  width:50%;
  background-color: blue;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
h3{
    font-size: 1rem;
    font-weight: 400;
}

</style>

<body>
    <h1>Challange: Correct change</h1>

    <form action='codehw1.php' method='post'>
        <label for='amount'><h3>Enter the total amount</h3></label> 
        <input type='number'id='amount' name='amount' step='0.01' min='1'><br><br>
        <input type='submit' value="Submit">
    </form>

    <br><br>

    <?php

    if(isset($_POST['amount']) && !empty($_POST['amount'])) {

        //using if statment to wrap and differentiate the two forms

    $amount = $_POST['amount'];
    $singles = floor($amount);
    $remaining = $amount - $singles;


    //initizialing the variables
    $quarters = 0;
    $dimes = 0;
    $nickles = 0;
    $penny = 0;
    $tolerance = 0.000001; // added tolerance to deal with the floating precision

    if ($remaining >= 0.25 - $tolerance) {
        $remaining = bcadd($remaining,'0',2);
        $quarters = floor(bcdiv($remaining, 0.25, 2));
        $remaining = bcsub($remaining, bcmul($quarters, 0.25,2), 2);
    }

    


    if ($remaining >= 0.10 - $tolerance) {
        $dimes = floor($remaining / 0.10);
        $remaining = fmod($remaining, 0.10);
    };
    
    if ($remaining >= 0.05 - $tolerance) {
        $remaining = bcadd($remaining, '0', 2);
        $nickles = floor(bcdiv($remaining, 0.05, 2));
        $remaining = bcsub($remaining, bcmul($nickles, 0.05, 2), 2);
    }

    if ($remaining >= 0.01 - $tolerance) {
        $remaining = bcadd($remaining, '0', 2);
        $penny = floor(bcdiv($remaining, 0.01, 2));
        $penny = floor(100 * $remaining / 0.01) / 100;
    }

   
    echo "<p>"; 
    echo "You are due <b> $ $amount </b> back in change total";
    echo "<br>";
    echo "<br>";
    echo "You are due back <b>$ $singles dollar (s) </b>, <b>$ $quarters quarters</b>, <b>$ $dimes dimes</b>, <b> $ $nickles nickles<b> and <b>$ $penny cents</b>";
    echo "</p>";
}


    ?>

    <br><br>

    <h1>Challenge: 99 Bottles of Beer </h1>
      <form action='codehw1.php' method='post'>
        <label for='lyric_count'><h3>Enter the amount of loop times</h3></label> 
        <input type='number'id='lyric_count' name='lyric_count' min='1'><br><br>
        <input type='submit' value="Submit">
    </form>

    <br><br><br>



    <?php

    if(isset($_POST['lyric_count']) && !empty($_POST['lyric_count'])) {

    $lyric_count= $_POST['lyric_count'];

    for($lyric_count; $lyric_count >=1; --$lyric_count){
        echo "<b>$lyric_count  bottles </b> on the wall, <b>$lyric_count bottles</b> of beer";
        echo "<br>";
        $lyric=$lyric_count-1;
        echo "Take one down, pass it around, <b>$lyric bottles </b> of beer on the wall. ";
        echo "<br>";
       
        
        }
    }


    




?>

</body>

</html>