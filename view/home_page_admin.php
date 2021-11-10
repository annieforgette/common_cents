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
        
        #currentButton 
        {
            background-color: #22487B; /* Green */
            border: none;
            color: white;
            padding: 15px 50px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            font-family: futura;
        }
        #currentButton:hover
        {
           background-color: #53682B; 
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
	margin:10px;
        }
        #bottomNavBar a:hover
        {
        background-color: #22487B;
        }
        #bottomNavBar {
        display:block;
	padding:3px;
	text-decoration:none;  
        }
        h1 {
            font-size:20px; 
            margin: 20px; 
            color: #22487B;
            font-family: futura;
            padding: 30px;
           
        }
      </style>
      
        <title>Common Cents</title>
        <div>
        
        <ul id = "topNavBar">
            <li><a href="../view/profile.php"><img src="../images/profile.png" height="60px"></a></li>
            <li><a href="../view/home_page_admin.php"><img src="../images/logo.png" height="60px"></a></li>
            <li>
                <form  id = "form1" action="../user_manager/" method="post">
                <input type="hidden" name="action" value="logout">
                <input id = "button" style="background-color: #F6F6F6; color: #22487B" type="submit" value ="Logout"><br><br>
                </form>
            </li>   
        </ul>
            
            <h1>Hello, welcome to Common Cents!</h1>
        <form id = "form2" action="../user_manager/" method="post">
        <input type="hidden" name="action2" value="add_investment_action">
        <a id="button" style="padding: 60px; margin-bottom: 20px" href="../view/add_investment_action_form.php">Add Investment Action</a>
        <ul id = "bottomNavBar">
            <li><a id="button" href="../view/home_page_admin.php">Investments</a></li>
            
            <li><form  id = "form2" action="../user_manager/" method="post">
                <input type="hidden" name="action" value="list_group_members">
                <input type = "hidden" name ="group_id" value="<?php echo $_SESSION["group_id"]; ?>">
                <input id = "button" type="submit" value ="Members"><br><br>
                </form>
             </li>
                
            <li><a id="button" href="../view/messaging.php">Messages</a></li>
        </ul>
        </div>
    </head>
    <body>
   </body>