<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Code hw3</title>
</head>
<style>
    body {
        margin: 0.5em;

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
    <h1> Challenge: Book lists</h1>
    <br>
    <br>


    <?php

    $books = array(
        "PHP and MySQL Web Development" => array(
            'author' => array(
                "first name" => "Luke",
                "last name" => "Wielling"
            ),
            'pages' => "144",
            'type' => 'paperback',
            'price' => 31.63
        ),

        "Web Design with HTML, CSS, JavaScript and jQuery" => array(
            'author' => array(
                "first name" => "Jon",
                "last name" => "Ducket"
            ),
            'pages' => "135",
            'type' => 'paperback',
            'price' => 41.23
        ),

        "PHP Cookbook: Solutions & Examples for PHP programmers" => array(
            'author' => array(
                "first name" => "David",
                "last name" => "Sklar"
            ),
            'pages' => "14",
            'type' => 'paperback',
            'price' => 40.88
        ),

        "JavaScript and JQuery: Interactive Front-End Web Development " => array(
            'author' => array(
                "first name" => "Jon",
                "last name" => "Ducket"
            ),

            'pages' => "251",
            'type' => 'paperback',
            'price' => 22.09
        ),

        "Modern PHP: New Features and Good Practices " => array(
            'author' => array(
                "first name" => "Josh",
                "last name" => "Lockhart"
            ),
            'pages' => "7",
            'type' => 'paperback',
            'price' => 28.49
        ),
        "Programming PHP" => array(
            'author' => array(
                "first name" => "Kevin",
                "last name" => "Tatroe"
            ),
            'pages' => "26",
            'type' => 'paperback',
            'price' => 28.96
        ),


    );



    echo '<table class="table table-hover">';
    echo "<thead class='thead-dark'>";
    echo "<tr>";
    echo "<th scope='col'>#</th>";
    echo "<th scope='col'>Title <small> (click to get more info about the book) </small></th>";
    echo "<th scope='col'>First Name</th>";
    echo "<th scope='col'>Last Name</th>";
    echo "<th scope='col'>Pages</th>";
    echo "<th scope='col'>Type</th>";
    echo "<th scope='col'>Price</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "<tr>";

    $sum_price = array(); // initializing the variable to save the price value and then sum them
    $i = 1; //counter for the book

    foreach ($books as $name_book => $info) {

        echo "<tr>";
        echo "<th scope='row'> $i </th>";
        $url_search = urlencode($name_book);

        echo "<td><a href=https://www.google.com/search?tbm=bks&q=$url_search  target= '_blank'>$name_book</a></td>";
        foreach ($info as $description => $value) {
            foreach ($value as  $key => $name) {
                echo "<td> $name </td>";
            }
            if ($description == "author") {
                continue; //adding a if statement to skip the author description because it was printed already
            }

            if ($description == 'price') {
                echo "<td> $ $value </td>";
                $sum_price[] = $value;
                continue;
            }
            echo "<td>$value</td>";
        }



        echo "</tr>";
        $i = $i + 1;
    }

    $total = array_sum(($sum_price));
    echo "<tr class='table-warning' style='font-weight:bold'>";
    echo "<td colspan='6' style='text-align:center'>";
    echo "Total";
    echo "</td>";
    echo "<td >";
    echo "$ $total";
    echo "</td>";
    echo "</tbody>";
    echo "</table>";

    ?>

    <br>
    <br>

    <h1>Challenge: Coin Toss, continued </h1>
    <br>
    <br>


    <?php





    function cointoss_user($user_input)
    {
        $coin_toss_array = array();

        $heads_image = "https://upload.wikimedia.org/wikipedia/en/0/0f/2022_Washington_quarter_obverse.jpeg?20220831152954";
        $tails_image = 'https://upload.wikimedia.org/wikipedia/commons/3/3c/Washington_Quarter_Silver_1944S_Reverse.png?20111014035414';


        $coin_counter = array();




        while (count($coin_toss_array) < 100) {

            $result = mt_rand(1, 2); //heads=1 and tails=2
            $coin_counter[] = $result;
            if ($result == 1) {
                $coin_toss_array[] = $result;
                if (array_sum($coin_toss_array) == $user_input) {
                    break;
                }
            } else {
                $coin_toss_array = array();
            }
        }
        for ($x = 0; $x <= (count($coin_counter) - 1); $x++) {
            $result = ($coin_counter[$x] == 1) ? "Heads" : "Tails";
            $image = ($result == 1) ? $heads_image : $tails_image;
            echo "<div style='display: inline-block; margin:20px;'  >";
            echo "<p> The result is <b>$result </b>";
            echo "<br><br>";
            echo "<div class='coin'>";
            echo "<img class='front' src=$image alt=$result width='200px' >";
            echo "<img class='back' src=$tails_image alt=$result width='200px' >";
            echo "</div>";
            echo "</div>";
        }
        $total_loops = count($coin_counter);
        echo "<br><br>";
        echo "<table class='table table-hover'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        echo "<th scope='col'>Heads in a row requested</th>";
        echo "<th scope='col'>Total Loops needed</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        echo "<tr class='table-success'>";
        echo "<td style='text-align:center'> $user_input</td>";
        echo "<td style='text-align:center'> $total_loops</td>";
        echo '</tr>';
        echo "</tbody>";
        echo "</table>";
        
    }

    ?>
    <form action='codehw3.php' method='post'>
        <div class="form-group">
            <label for='coin'>How many heads in a row you want? </label>
            <input type='number' class="form-control" id='coin' name='coin' aria-describedby="numberHelp" placeholder="Enter a number" min="1" max="30">
            <small id="numberHelp" class='form-text text-muted'>Enter a number lower than 30 to avoid crashing the system</small>

        </div>
        <input type='submit' class="btn btn-primary btn-lg" value="Submit">
    </form>

    

    <?php
    
    if (isset($_POST['coin']) && !empty($_POST['coin'])) {
        
        $coin = $_POST['coin'];

        cointoss_user($coin);
      
    }

    ?> 

    <br>
    <br>
    <br>














</body>

</html>