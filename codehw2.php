<!DOCTYPE html>
<html lang="en">

<head>
    <title>Codehw2 </title>
</head>
<style>
    input[type=text],
    select {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 50%;
        background-color: blue;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .button {
        width: 20%;
        background-color: white;
        color: blue;
        padding: 14px 20px;
        margin: 8px 0;
        border-color: blue;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
    }

    h3 {
        font-size: 1rem;
        font-weight: 400;
    }



    .coin {
        width: 100px;
        height: 100px;
        position: relative;
        transform-style: preserve-3d;
        animation-name: flip;
        animation-duration: 3s;
        animation-timing-function: linear;
        animation-fill-mode: forwards;
    }

    @keyframes flip {
        0% {
            transform: rotateX(0deg) rotateY(0deg);
        }

        10% {
            transform: rotateX(-30deg) rotateY(10deg);
        }

        20% {
            transform: rotateX(-60deg) rotateY(20deg);
        }

        30% {
            transform: rotateX(-90deg) rotateY(30deg);
        }

        40% {
            transform: rotateX(-120deg) rotateY(20deg);
        }

        50% {
            transform: rotateX(-150deg) rotateY(10deg);
        }

        60% {
            transform: rotateX(-180deg) rotateY(0deg);
        }

        70% {
            transform: rotateX(-150deg) rotateY(-10deg);
        }

        80% {
            transform: rotateX(-120deg) rotateY(-20deg);
        }

        90% {
            transform: rotateX(-90deg) rotateY(-30deg);
        }

        100% {
            transform: rotateX(0deg) rotateY(-360deg);
        }
    }


    .front,
    .back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
    }

    .front {
        z-index: 1;
    }

    .back {
        z-index: 0;
        transform: rotateY(180deg);
    }
</style>

<body>
    <h1>Challange: ISBN validation</h1>

    <form action='codehw2.php' method='post'>
        <label for='isbn'>
            <h3>Enter the 10-ISBN number</h3>
        </label>
        <input type='text' id='isbn' name='isbn' minlength="10" maxlength="10"><br><br>
        <input type='submit' value="Submit">
    </form>

    <br><br>

    <?php


if(isset($_POST['isbn']) && !empty($_POST['isbn'])) {

    $isbn = $_POST['isbn'];

    //converting the string to an array

    $array_isbn = str_split($isbn);


    //checking if the last digit is 10 and do the conversion

    if ($array_isbn[9] == 'x') {
        $array_isbn = str_replace('x', '10', $array_isbn);
    } elseif ($array_isbn[9] == 'X') {
        $array_isbn = str_replace('X', '10', $array_isbn);
    }

    $array_factor = array(10, 9, 8, 7, 6, 5, 4, 3, 2, 1);


    function validation($array1, $array2)
    {
        return ($array1 * $array2);
    }
    $array_multiplication = array_map('validation', $array_factor, $array_isbn);
    $array_validation = array_sum($array_multiplication) / 11;

    if (is_float($array_validation)) {
        echo 'this is <b> NOT </b> a valid ISBN';
    } else {
        echo 'this is a <b> valid ISBN </b>';
        echo "<br> <br>";


        // adding the free API open library to print the book info

        $url = "https://openlibrary.org/api/books?bibkeys=ISBN:" . $isbn . "&jscmd=data&format=json";
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        $book_data = $data["ISBN:" . $isbn];

        echo "Title: <b>" . $book_data["title"] . "</b> <br>";
        echo "Author: <b>" . $book_data["authors"][0]["name"] . "</b> <br>";
        echo "Publisher: <b>" . $book_data["publishers"][0]["name"] . "</b><br>";
        echo "Publish date: <b>" . $book_data["publish_date"] . "</b><br>";
        echo "<br>";
        $cover = $book_data["cover"]["large"];
        $alt_book = $book_data["title"];
        echo "<img src='$cover' alt='book name:  $alt_book'>";

        echo "<br> <br>";
        echo "<a href='https://isbnsearch.org/isbn/$isbn' target= '_blank'> Click here to check more information about the book </a>";
    }


    echo "<br>";

}
    ?>
    

    <br><br>

    <h1>Challange: Coin toss</h1>

    <button class="button" onclick="window.location.reload()">Click to toss all the coins again</button>
     <!-- Adding window.location.reload() to reload the page when the button is clicked-- in this case to trigger the coin toss -->

    <!-- Flipping one time -->
    <h2> Coin toss one time </h6>

        <?php

        function cointoss($head, $tails)
        {

            $coin_toss = mt_rand($head, $tails);
            $result = ($coin_toss == 1) ? "Heads" : "Tails";
            return $result;
        }


        $coin_toss = cointoss(1, 2);

        $heads_image = "https://upload.wikimedia.org/wikipedia/en/0/0f/2022_Washington_quarter_obverse.jpeg?20220831152954";
        $tails_image = 'https://upload.wikimedia.org/wikipedia/commons/3/3c/Washington_Quarter_Silver_1944S_Reverse.png?20111014035414';

        $result = ($coin_toss == "Heads") ? "Heads" : "Tails";
        $image = ($coin_toss == "Heads") ? $heads_image : $tails_image;


        ?>



        <p>The result is <?php echo "<b> $result </b>"; ?></p>
        <div class="coin">
            <img class="front" src="<?php echo $image ?>" alt="<?php echo $result; ?>" width="400px">
            <img class="back" src="<?php echo $tails_image; ?>" alt="<?php echo $result; ?>" width="400px">
        </div>





       

        <br><br><br>
       


        <!-- Flipping three times -->

        <h2> Coin toss three times </h6>

           

                <?php
                $coin_toss_array = array();


                while (count($coin_toss_array) < 3) {
                    $result = cointoss(1, 2);
                    $coin_toss_array[] = $result; }

                

             


                for ($x = 0; $x <= (count($coin_toss_array) - 1); $x++) {
                    $result = ($coin_toss_array[$x] == "Heads") ? "Heads" : "Tails";
                    $image = ($result == "Heads") ? $heads_image : $tails_image;
                    echo "<div style='display: inline-block; margin:10px;'  >";
                    echo "<p> The result is <b>$result </b>";
                    echo "<br><br>";
                    echo "<div class='coin'>";
                    echo "<img class='front' src=$image alt=$result width='200px' >";
                    echo "<img class='back' src=$tails_image alt=$result width='200px' >";
                    echo "</div>";
                    echo "</div>";
                }

                ?>





                <!-- Flipping five times -->

                <h2> Coin toss five times </h6>

                    <?php

                    while (count($coin_toss_array) < 5) {
                        $result = cointoss(1, 2);
                        $coin_toss_array[] = $result; }

                   


                    for ($x = 0; $x <= (count($coin_toss_array) - 1); $x++) {
                        $result = ($coin_toss_array[$x] == "Heads") ? "Heads" : "Tails";
                        $image = ($result == "Heads") ? $heads_image : $tails_image;
                        echo "<div style='display: inline-block; margin:20px;'  >";
                        echo "<p> The result is <b>$result </b>";
                        echo "<br><br>";
                        echo "<div class='coin'>";
                        echo "<img class='front' src=$image alt=$result width='200px' >";
                        echo "<img class='back' src=$tails_image alt=$result width='200px' >";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>

                    <!-- Flipping seven times -->

                    <h2> Coin toss seven times </h6>

                        <?php

                        while (count($coin_toss_array) < 7) {
                            $result = cointoss(1, 2);
                            $coin_toss_array[] = $result; }


                        for ($x = 0; $x <= (count($coin_toss_array) - 1); $x++) {
                            $result = ($coin_toss_array[$x] == "Heads") ? "Heads" : "Tails";
                            $image = ($result == "Heads") ? $heads_image : $tails_image;
                            echo "<div style='display: inline-block; margin:20px;'  >";
                            echo "<p> The result is <b>$result </b>";
                            echo "<br><br>";
                            echo "<div class='coin'>";
                            echo "<img class='front' src=$image alt=$result width='200px' >";
                            echo "<img class='back' src=$tails_image alt=$result width='200px' >";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>

                        <!-- Flipping nine times -->

                        <h2> Coin toss nine times </h6>

                            <?php

                            while (count($coin_toss_array) < 9) {
                                $result = cointoss(1, 2);
                                $coin_toss_array[] = $result; }


                            for ($x = 0; $x <= (count($coin_toss_array) - 1); $x++) {
                                $result = ($coin_toss_array[$x] == "Heads") ? "Heads" : "Tails";
                                $image = ($result == "Heads") ? $heads_image : $tails_image;
                                echo "<div style='display: inline-block; margin:20px;'  >";
                                echo "<p> The result is <b>$result </b>";
                                echo "<br><br>";
                                echo "<div class='coin'>";
                                echo "<img class='front' src=$image alt=$result width='200px' >";
                                echo "<img class='back' src=$tails_image alt=$result width='200px' >";
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>





                            <!-- Flipping until two heads in a row -->

                            <h2> Coin toss until two heads in a row </h6>

                                <?php
                                // initializing the varoiable for the loops
                                
                                $found_result = false;


                                while (count($coin_toss_array) < 100) {
                                    $result = cointoss(1, 2);
                                    $coin_toss_array[] = $result; //adding the variable to the array



                                    for ($x = 1; $x < count($coin_toss_array); $x++) {

                                        if ($coin_toss_array[$x] == "Heads" && $coin_toss_array[$x - 1] == "Heads") {
                                            $found_result = true;
                                            break;
                                        }
                                    }
                                    if ($found_result) {
                                        break;
                                    }
                                }
                                for ($x = 0; $x <= (count($coin_toss_array) - 1); $x++) {
                                    $result = ($coin_toss_array[$x] == "Heads") ? "Heads" : "Tails";
                                    $image = ($result == "Heads") ? $heads_image : $tails_image;
                                    echo "<div style='display: inline-block; margin:20px;'  >";
                                    echo "<p> The result is <b>$result </b>";
                                    echo "<br><br>";
                                    echo "<div class='coin'>";
                                    echo "<img class='front' src=$image alt=$result width='200px' >";
                                    echo "<img class='back' src=$tails_image alt=$result width='200px' >";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                $total_loops = count($coin_toss_array);
                                echo "<br><br>";
                                echo "<p>Total loops needed: <b> $total_loops total </b></p>"

                                ?>
                                <br>






















</body>

</html>