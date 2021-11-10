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
      </style>
      
        <title>Common Cents</title>
        <div>
        <ul id = "topNavBar">
            <li><a href="../view/profile.php"><img src="../images/profile.png" height="60px"></a></li>
            <li><a href="../view/home_page_user.php"><img src="../images/logo.png" height="60px"></a></li>
            <li>
                <form action="../user_manager/" method="post">
                <input type="hidden" name="action" value="logout">
                <input id = "button" type="submit" value ="Logout"><br><br></li>
                </form>
        </ul><br><br>
            <form action="../user_manager/" method="post">
                <input type="hidden" name="action" value="generate_reporting">
                
                <input type="hidden" name="user_name" value="<?php echo $_SESSION["user_name"]; ?>">
                <input id = "button" type="submit" value ="Update Reporting"><br><br></li>
            </form>
        <div>
            <label id = "label">Weekly Earnings/Losses: </label>
            <p id = id = "label">$<?php echo $current_week; ?></p><br>
            <label id = "label">All time Earnings/Losses: </label>
            <p>$<?php echo $all_time; ?></p>
        </div>
     
            <ul id = "bottomNavBar">

                <li><a id="button" href="../view/home_page_user.php">Reporting</a></li>
                <li><a id="button" href="../view/messaging.php">Messages</a></li>
            </ul>
        </div>
    </head>
    <body>
   </body>