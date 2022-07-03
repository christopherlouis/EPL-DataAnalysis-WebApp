<html>
    
    <head>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
        <title>English Premier League</title>

        <style>
            html {
                 scroll-behavior: smooth;
            }
            * {
            box-sizing: border-box;
            }
          
            body {
            font-family: Arial, Helvetica, sans-serif;
            }

            /* Style the header */
            header {
            background-color: #666;
            padding: 30px;
            text-align: center;
            font-size: 35px;
            color: white;
            }

            /* Create two columns/boxes that floats next to each other */
            nav {
            width: 100%;
            height:46px; /* only for demonstration, should be removed */
            background: #ccc;
            position: sticky;
            top: 0;
            }

            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
            }

            li {
                float: left;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover:not(.active) {
                background-color: #111;
            }

            .active {
                background-color:  #009879;
            }
            
            .styled-table {
                border-collapse: collapse;
                margin: 25px 15px;
                font-size: 0.9em;
                font-family: sans-serif;
                min-width: 400px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
                float:left;
            }

            .styled-table thead tr {
                background-color: #009879;
                color: #ffffff;
                text-align: left;
            }

            .styled-table th,
            .styled-table td {
                padding: 12px 15px;
            }

            .styled-table tbody tr {
                border-bottom: 1px solid #dddddd;
            }

            .styled-table tbody tr:nth-of-type(even) {
                background-color: #f3f3f3;
            }

            .styled-table tbody tr:last-of-type {
                border-bottom: 2px solid #009879;
            }

            .styled-table tbody tr.active-row {
                font-weight: bold;
                color: #009879;
            }

            /* Clear floats after the columns */
            section::after {
            content: "";
            display: table;
            clear: both;
            }

            

            /* Style the footer */
            footer {
            background-color: #333;
            padding: 10px;
            text-align: center;
            color: white;
            }

            /* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
            @media (max-width: 600px) {
            nav, article {
                width: 100%;
                height: auto;
            }
            }
            </style>
    </head>

    <body>

    <?php
    require './vendor/autoload.php';

    $client = new MongoDB\Client(
        'mongodb://127.0.0.1:27017'
    );

    ////////// Leadrboard
    // data players
    $collection = $client->EPL->data;
    $data = $collection->find();

    // topscorer
    $datats = $collection->find(
        [],
        ['limit' => 10,
        'sort' => ['Goals' => -1]]
    );

    // topassist
    $datata = $collection->find(
        [],
        ['limit' => 10,
        'sort' => ['Assists' => -1]]
    );

    // mostpasses
    $datamp = $collection->find(
        [],
        ['limit' => 10,
        'sort' => ['Passes_Attempted' => -1]]
    );

    // minutesplayed
    $datamin = $collection->find(
        [],
        ['limit' => 10,
        'sort' => ['Mins' => -1]]
    );

    // topyellowcard
    $datayc = $collection->find(
        [],
        ['limit' => 10,
        'sort' => ['Yellow_Cards' => -1]]
    );
    
    // topredcard
    $datarc = $collection->find(
        [],
        ['limit' => 10,
        'sort' => ['Red_Cards' => -1]]
    );
    
    /////////////////// Player
    /////////////////// MYSQL 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "datascience";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT nama_club FROM club";
        $klub = $conn->query($sql);

        $klublist = "";
        //collect clubs list
        while($row = $klub->fetch_assoc()) {
            $klublist .= '<option value="'.$row["nama_club"].'">'.$row["nama_club"].'</option>';
        }

        $sql2 = "SELECT code,nation FROM nationality ORDER BY nation ASC";
        $nat = $conn->query($sql2);

        $natlist = "";
        //collect clubs list
        while($row = $nat->fetch_assoc()) {
            $natlist .= '<option value="'.$row["code"].'">'.$row["nation"].'</option>';
        }

        $sql3 = "SELECT position FROM position";
        $pos = $conn->query($sql3);

        $poslist = "";
        //collect clubs list
        while($row = $pos->fetch_assoc()) {
            $poslist .= '<option value="'.$row["position"].'">'.$row["position"].'</option>';
        }
        
        $conn->close();

        $input_club="";
        $input_nat="";
        $input_pos="";

        if(isset($_POST['enter'])){
            $input_club=$_POST['input-club'];
            $input_nat=$_POST['input-nat'];
            $input_pos=$_POST['input-pos'];

            if($input_club != "Club"){
                if($input_nat != "Nationality"){
                    if($input_pos != "Position"){
                        $data = $collection->find([
                            'Club' => $input_club,
                            'Nationality' => $input_nat,
                            'Position' => new \MongoDB\BSON\Regex($input_pos)
                        ]);
                    }
                    else{
                        $data = $collection->find([
                            'Club' => $input_club,
                            'Nationality' => $input_nat
                        ]);
                    }
                }
                elseif($input_pos != "Position"){
                    $data = $collection->find([
                        'Club' => $input_club,
                        'Position' => new \MongoDB\BSON\Regex($input_pos)
                    ]);
                }
                else{
                    $data = $collection->find([
                        'Club' => $input_club
                    ]);
                }
            }
            elseif($input_nat != "Nationality"){
                if($input_pos != "Position"){
                    $data = $collection->find([
                        'Nationality' => $input_user,
                        'Position' => new \MongoDB\BSON\Regex($input_pos)
                    ]);
                }
                else{
                    $data = $collection->find([
                        'Nationality' => $input_nat
                    ]);
                }
            }
            elseif($input_pos != "Position"){
                $data = $collection->find([
                    'Position' => new \MongoDB\BSON\Regex($input_pos)
                ]);
            }
            else{
               $data = $collection->find();
            }
        }

        //data matches
        $collection2 = $client->EPL->data2;
        $data2 = $collection2->find();

        $input_match="";

        if(isset($_POST['enter2'])){
            $input_match=$_POST['input-match'];
            if($input_match != "Club"){
                $data2 = $collection2->find([
                    'Team' => new \MongoDB\BSON\Regex($input_match)
                ]);
            }
            else{
                $data2 = $collection2->find();
            }
        }

        //Arsenal Home Wins
        $AHW = $collection2->count(
            ['Team' => 'Arsenal', 'Result' => 'HW']
        );
        //Arsenal Away Wins
        $AAW = $collection2->count(
            ['Team' => 'Arsenal', 'Result' => 'AW']
        );
        //United Home Wins
        $UHW = $collection2->count(
            ['Team' => 'Manchester United', 'Result' => 'HW']
        );
        //United Away Wins
        $UAW = $collection2->count(
            ['Team' => 'Manchester United', 'Result' => 'AW']
        );
        //City Home Wins
        $MHW =$collection2->count(
            ['Team' => 'Manchester City', 'Result' => 'HW']
        );
        //City Away Wins
        $MAW =$collection2->count(
            ['Team' => 'Manchester City', 'Result' => 'AW']
        );
        //Chelsea Home Wins
        $CHW = $collection2->count(
            ['Team' => 'Chelsea', 'Result' => 'HW']
        );
        //Chelsea Away Wins
        $CAW = $collection2->count(
            ['Team' => 'Chelsea', 'Result' => 'AW']
        );
        //Tottenham Home Wins
        $THW = $collection2->count(
            ['Team' => 'Tottenham Hotspur', 'Result' => 'HW']
        );
        //Tottenham Away Wins
        $TAW =$collection2->count(
            ['Team' => 'Tottenham Hotspur', 'Result' => 'AW']
        );
        //Liverpool Home Wins
        $LHW = $collection2->count(
            ['Team' => 'Liverpool FC', 'Result' => 'HW']
        );
        //Liverpool Away Wins
        $LAW = $collection2->count(
            ['Team' => 'Liverpool FC', 'Result' => 'AW']
        );
        
        //Age Arsenal >= 30
        $ageAR = $collection->count(
            ['Age'=>['$lte'=>23], 'Club' => 'Arsenal']
        );

        //Age MU >= 30
        $ageMU = $collection->count(
            ['Age'=>['$lte'=>23], 'Club' => 'Manchester United']
        );

        //Age MC >= 30
        $ageMC = $collection->count(
            ['Age'=>['$lte'=>23], 'Club' => 'Manchester City']
        );

        //Age Chelsea >= 30
        $ageCH = $collection->count(
            ['Age'=>['$lte'=>23], 'Club' => 'Chelsea']
        );

        //Age Spurs >= 30
        $ageTH = $collection->count(
            ['Age'=>['$lte'=>23], 'Club' => 'Tottenham Hotspur']
        );

        //Age Liverpool >= 30
        $ageLI = $collection->count(
            ['Age'=>['$lte'=>23], 'Club' => 'Liverpool FC']
        );
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    
    <body>

    <header style="background-image: url('header2.jpg');">
    <h2>English Premiere League 20/21 Statistics</h2>
    </header>

    <section>
    <nav>
        <ul>
            <li><a href="#content1">Leaderboard</a></li>
            <li><a href="#content2">Players</a></li>
            <li><a href="#content3">Match</a></li>
            <li><a href="#content4">Statistics</a></li>
            <li style="float:right"><a class="active" href="#top">Home</a></li>
        </ul>
    </nav>
    <!-- update -->
    <div id="content1" style="height: 50px"></div>
    <div style="width: 100%; height: auto; text-align: center;">
        <div class="row ">
            <div class="col">
                <table class="styled-table">
                <caption style="text-align:center; caption-side:top"><h3>Top Scorer</h3></caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Goals</th>
                            <th>Matches</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php       
                        foreach ($datats as $cursor){
                            echo "<tr class='active-row'>
                                    <td>" .$cursor["Name"]. "</td>
                                    <td>" .$cursor["Goals"]. "</td>
                                    <td>" .$cursor["Matches"]. "</td>
                                </tr>";
                        }
                        ?>
                        <!-- and so on... -->
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table class="styled-table">
                <caption style="text-align:center; caption-side:top"><h3>Top Assists</h3></caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Assists</th>
                            <th>Matches</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php       
                            foreach ($datata as $cursor){
                                echo "<tr class='active-row'>
                                        <td>" .$cursor["Name"]. "</td>
                                        <td>" .$cursor["Assists"]. "</td>
                                        <td>" .$cursor["Matches"]. "</td>
                                    </tr>";
                            }
                        ?>
                        <!-- and so on... -->
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table class="styled-table">
                <caption style="text-align:center; caption-side:top"><h3>Most Passes</h3></caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Passes</th>
                            <th>Matches</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php       
                            foreach ($datamp as $cursor){
                                echo "<tr class='active-row'>
                                        <td>" .$cursor["Name"]. "</td>
                                        <td>" .$cursor["Passes_Attempted"]. "</td>
                                        <td>" .$cursor["Matches"]. "</td>
                                    </tr>";
                            }
                        ?>
                        <!-- and so on... -->
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table class="styled-table">   
                <caption style="text-align:center; caption-side:top"><h3>Most Minutes Played</h3></caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Minutes Played</th>
                            <th>Matches</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php       
                            foreach ($datamin as $cursor){
                                echo "<tr class='active-row'>
                                        <td>" .$cursor["Name"]. "</td>
                                        <td>" .$cursor["Mins"]. "</td>
                                        <td>" .$cursor["Matches"]. "</td>
                                    </tr>";
                            }
                        ?>
                        <!-- and so on... -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">  
            <div class="col-sm">
            </div>
            <div class="col-sm">
                <table class="styled-table">
                <caption style="text-align:center; caption-side:top"><h3>Most Yellow Cards</h3></caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Yellow Cards</th>
                            <th>Matches</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php       
                            foreach ($datayc as $cursor){
                                echo "<tr class='active-row'>
                                        <td>" .$cursor["Name"]. "</td>
                                        <td>" .$cursor["Yellow_Cards"]. "</td>
                                        <td>" .$cursor["Matches"]. "</td>
                                    </tr>";
                            }
                        ?>
                        <!-- and so on... -->
                    </tbody>
                </table>
            </div>
            <div class="col-sm">
                <table class="styled-table">
                <caption style="text-align:center; caption-side:top"><h3>Most Red Cards</h3></caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Red Cards</th>
                            <th>Matches</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php       
                            foreach ($datarc as $cursor){
                                echo "<tr class='active-row'>
                                        <td>" .$cursor["Name"]. "</td>
                                        <td>" .$cursor["Red_Cards"]. "</td>
                                        <td>" .$cursor["Matches"]. "</td>
                                    </tr>";
                            }
                        ?>
                        <!-- and so on... -->
                    </tbody>
                </table>
            </div>
            <div class="col-sm">
            </div>
        </div>
        <div style="clear:both"></div>
    </div>
    <div id="content2" style="height: 50px"></div>
    <div class = "container-fluid mx-auto" style="width: 75%; height:auto; background-color:light-grey">
        <form action="#content2" method="POST">
            <div class="row" id="container" style="padding: 10px">
                <select class="form-select col" aria-label="Default select example" name = 'input-club' style="width: 20%">
                    <option>Club</option>
                    <?php echo $klublist?>
                </select>
                <select class="form-select col" aria-label="Default select example" name = 'input-nat' style="width: 20%">
                    <option>Nationality</option>
                    <?php echo $natlist?>
                </select>
                <select class="form-select col" aria-label="Default select example" name = 'input-pos' style="width: 20%">
                    <option>Position</option>
                    <?php echo $poslist?>
                </select>
                <button name="enter" id="enter" style="width: 9%">Search</button>
            </div>
        </form>
        <table class="styled-table">
        <caption style="text-align:center; caption-side:top"><h3>Result</h3></caption>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Club</th>
                    <th>Nationality</th>
                    <th>Position</th>
                    <th>Age</th>
                    <th>Matches</th>
                    <th>Starts</th>
                    <th>Goals</th>
                    <th>Assists</th>
                    <th>Pass Completed %</th>
                    <th>Penalty Goals</th>
                    <th>Penalty Attempted</th>
                    <th>Yellow Cards</th>
                    <th>Red Cards</th>
                </tr>
            </thead>
            <tbody>
                <?php       
                    foreach ($data as $cursor){
                        echo "<tr class='active-row'>
                                <td>" .$cursor["Name"]. "</td>
                                <td>" .$cursor["Club"]. "</td>
                                <td>" .$cursor["Nationality"]. "</td>
                                <td>" .$cursor["Position"]. "</td>
                                <td>" .$cursor["Age"]. "</td>
                                <td>" .$cursor["Matches"]. "</td>
                                <td>" .$cursor["Starts"]. "</td>
                                <td>" .$cursor["Goals"]. "</td>
                                <td>" .$cursor["Assists"]. "</td>
                                <td>" .$cursor["Perc_Passes_Completed"]. "</td>
                                <td>" .$cursor["Penalty_Goals"]. "</td>
                                <td>" .$cursor["Penalty_Attempted"]. "</td>
                                <td>" .$cursor["Yellow_Cards"]. "</td>
                                <td>" .$cursor["Red_Cards"]. "</td>
                            </tr>";
                    }
                ?>
                <!-- and so on... -->
            </tbody>
        </table>
        <div style="clear:both"></div>
    </div>
    <div id="content3" style="height: 50px"></div>
    <div class = "container-fluid mx-auto" style="width: 80%; height:auto; background-color:light-grey">
        <form action="#content3" method="POST">
            <div class= row id="container" style="padding:10px">
                <select class="form-select col" aria-label="Default select example" name = 'input-match' style="width: 40%">
                    <option>Club</option>
                    <?php echo $klublist?>
                </select>
                <button name="enter2" id="enter2" style="width: 20%">Search</button>
            </div>
        </form>
        <div class= row id="container" style="padding:10px">
            <table class="styled-table">
            <caption style="text-align:center; caption-side:top"><h2></h2></caption>
            <caption style="text-align:center; caption-side:top"><h3>Match History</h3></caption>
                <thead>
                    <tr>
                        <th>Game Date</th>
                        <th>Home Team</th>
                        <th>Home Score</th>
                        <th>Away Score</th>
                        <th>Away Team</th>
                        <th>Stadium</th>
                    </tr>
                </thead>
                <tbody>
                    <?php       
                        foreach ($data2 as $cursor){
                            $datetime = $cursor["Date"]->toDateTime();
                            
                            echo "<tr class='active-row'>
                                    <td>" .$datetime->format("d-M-Y"). "</td>
                                    <td>" .$cursor["Home Team"]. "</td>
                                    <td>" .$cursor["Home Score"]. "</td>
                                    <td>" .$cursor["Away Score"]. "</td>
                                    <td>" .$cursor["Away Team"]. "</td>
                                    <td>" .$cursor["Grounds"]. "</td>
                                </tr>";
                        }
                    ?>
                    <!-- and so on... -->
                </tbody>
            </table>
        </div>
        <div style="clear:both"></div>
    </div>
    <div id="content4" style="height: 50px"></div>
        <div style="width: 100%; height: auto;">
            <div id="home" style="width: 50%; height: auto; float: left;">
                <script type="text/javascript">
                    //Arsenal
                    var ahw = <?php echo $AHW ?>;
                    var aaw = <?php echo $AAW ?>;
                    //Manchester United
                    var uhw = <?php echo $UHW ?>;
                    var uaw = <?php echo $UAW ?>;
                    //Manchester City
                    var mhw = <?php echo $MHW ?>;
                    var maw = <?php echo $MAW ?>;
                    //Chelsea
                    var chw = <?php echo $CHW ?>;
                    var caw = <?php echo $CAW ?>;
                    //Tottenham
                    var thw = <?php echo $THW ?>;
                    var taw = <?php echo $TAW ?>;
                    //Liverpool
                    var lhw = <?php echo $LHW ?>;
                    var law = <?php echo $LAW ?>;
                </script>
            </div>
            <div id="away" style="width: 50%; height: auto; float: right;margin:auto">
                <canvas id="AwayChart" style="width: 90%; "></canvas>
                <script type="text/javascript">
                    new Chart("AwayChart", {
                        type: 'bar',
                    data: {
                    labels: ["Arsenal", "Manchester United", "Manchester City", "Chelsea", "Tottenham Hotspurs", "Liverpool"],
                    datasets: [{
                        label: "Home",
                        backgroundColor: "#03c03c",
                        data: [ahw, uhw, mhw, chw, thw, lhw]
                        }, {
                        label: "Away",
                        backgroundColor: "#c23b22",
                        data: [aaw, uaw, maw, caw, taw, law]
                        }]
                    },
                    options: {
                        title: {
                        display: true,
                        text: "Big Six Home and Away Wins EPL 20/21"
                        },
                        scales: {
                        yAxes: [{ticks: {min: 0, max:19}}]
                        }
                    }
                    });
                </script>
            </div>
        </div>
        <div style="width: 100%; height: auto;">
            <div id="age" style="width: 50%; height: auto; float: left;margin:auto">
                <canvas id="AgeChart" style="width: 90%;"></canvas>
                <script type="text/javascript">
                    //Arsenal
                    var agear = <?php echo $ageAR ?>;
                    //Manchester United
                    var agemu = <?php echo $ageMU ?>;
                    //Manchester City
                    var agemc = <?php echo $ageMC ?>;
                    //Chelsea
                    var agech = <?php echo $ageCH ?>;
                    //Tottenham
                    var ageth = <?php echo $ageTH ?>;
                    //Liverpool
                    var ageli = <?php echo $ageLI?>;
                    //bar chart age 
                    var xValues = ["Arsenal", "Manchester United", "Manchester City", "Chelsea", "Tottenham Hotspurs", "Liverpool"];
                    var yValues = [agear, agemu, agemc, agech, ageth, ageli];
                    var barColors = ["orangered", "red","lightblue","blue","lightgrey","darkred"];

                    new Chart("AgeChart", {
                    type: "horizontalBar",
                    data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                    },
                    options: {
                        legend: {display: false},
                        title: {
                        display: true,
                        text: "Youngsters Age <= 23"
                        },
                        scales: {
                        xAxes: [{ticks: {min: 0, max:25}}]
                        }
                    }
                    });
                </script>
            </div>
            
        </div>
        <div style="clear:both"></div>
    </section>

    <footer>
    <p>Created By: Daniel Marthin - C14190086 | Christopher Louis - C14190092 | Arnol Hadi Wijaya - C14190092</p>
    </footer>
    </body>
</html>