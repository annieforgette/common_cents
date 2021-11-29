<head>
        <style>
        #text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 25%;
	}

        div {
          margin-top: 30px;
          text-align: center;
        }
        img {
            padding-top:10px;
        }
        #label{
            font-size:20px; 
            margin: 10px; 
            color: #22487B;
            font-family: futura;
        }
        #button {
            background-color: #53682B; /* Green */
            border: none;
            color: white;
            padding: 15px 50px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            font-family: futura;
        }
        #button:hover
        {
            background-color: #22487B;
        }
        body {
            background-color: #F6F6F6;
        }
        ul{
            list-style-type: none;
        }
        #label{
            font-size:20px; 
            margin: 10px; 
            color: #22487B;
            font-family: futura;
        }
        
        #topNavBar {
	margin: 10px;
	width: 100%;
	font-family: sans-serif;
        height: 60px;
        }
        
        #topNavBar li {
        width: 30%;
        height: 20px;
	display:block;
	float:left;
	margin-left:2px;
        }
        
        #topNavBar a {
	display:block;
	padding:3px;
	text-decoration:none;
        }   
        #bottomNavBar{
        margin: 10px;
	width: 100%;
	font-family: sans-serif;
        height: 60px;
        }
        #bottomNavBar li {
        width: 30%;
        height: 20px;
	display:block;
	float:left;
	margin:100px;
        }
        #bottomNavBar a:hover
        {
        background-color: #22487B;
        }
        #bottomNavBar a {
        display:block;
	padding:3px;
	text-decoration:none;  
        }
        table {
            border-collapse: collapse;
        }
        td, th {
            font-family: futura;
            color: #53682B;
            padding: .2em .5em .2em .5em;
            text-align: left;
        }
        p{
          font-family: futura;
          color: #53682B;
          padding: .2em .5em .2em .5em;
          text-align: center;  
        }
        #no_border {
            border: 0px;
        }
        #no_border td {
            border: 0px;
        }
      </style>
      <script>
        window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                        text: "Actualized Gains/Losses over Time"
                },
                axisY: {
                        title: "Actualized Gains/Losses"
                },
                data: [{
                        markerColor: "#53682B",
                        markerSize: 10,
                        type: "line",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
        });
        chart.render();
        
        var chart = new CanvasJS.Chart("chartContainer2", {
                title: {
                        text: "Unrealized Gains/Losses over Time"
                },
                axisY: {
                        title: "Unrealized Gains/Losses"
                },
                data: [{
                        markerColor: "#53682B",
                        markerSize: 10,
                        type:"line",
                        dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
        });
        chart.render();

        }
        </script>
</head>
        <title>Common Cents</title>
        <body>
        <div>
        <ul id = "topNavBar">
            <li><a href="../view/profile.php"><img src="../images/profile.png" height="60px"></a></li>
            <li>
                <form  id = "form1" action="../user_manager/" method="post">
                <input type="hidden" name="action" value="go_home">
                <input type="hidden" name="user_name" value="<?php echo $_SESSION["user_name"]; ?>">
                <input type="image" src="../images/logo.png" height="60px"alt="Submit Form" /><br><br>
                </form>
            </li>
            <li>
                <form action="../user_manager/" method="post">
                <input type="hidden" name="action" value="logout">
                <input id = "button" type="submit" value ="Logout"><br><br></li>
                </form>
        </ul><br><br>
        <div>
            <label id = "label">Percent of Group Earnings: </label>
            <p id = id = "label"><?php echo $perc_profit_basis_formatted; ?>%</p><br>
            
            <label id = "label">Latest Realized Earnings/Losses: </label>
            <p id = id = "label">$<?php echo $current_week; ?></p><br>
            <label id = "label">Latest Unrealized Earnings/Losses: </label>
            <p id = id = "label">$<?php echo $current_week_unrealized; ?></p><br>
            
            <label id = "label">All time Realized Earnings/Losses: </label>
            <p>$<?php echo $all_time; ?></p>
            
            <div id="chartContainer" style="height: 370px; width: 50%; margin-left:auto; margin-right:auto;"></div>
             <div id="chartContainer2" style="height: 370px; width: 50%; margin-left:auto; margin-right:auto;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>
        <div><form  id = "form2" action="../user_manager/" method="post">
                <input type="hidden" name="action" value="list_group_members_by_username">
                <input type = "hidden" name ="user_name" value="<?php echo $_SESSION["user_name"]; ?>">
                <input id = "button" type="submit" value ="Return to Members">
         </form><div>
        </div>
   </body>