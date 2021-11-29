 <head>
     <?php
        function getUserType()
        {
            if ($_SESSION['user_type'] == 'group_member')
                return '../view/home_page_user.php';
            else
                return '../view/home_page_admin.php';
        }

    ?>
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
        #bottomNavBar a {
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
        table {
            border: 1px solid #001963;
            border-collapse: collapse;
        }
        td, th {
            font-family: futura;
            color: #53682B;
            border: 1px dashed #001963;
            padding: .2em .5em .2em .5em;
            text-align: left;
        }
        #no_border {
            border: 0px;
        }
        #no_border td {
            border: 0px;
        }
      </style>
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
                <form  id = "form1" action="../user_manager/" method="post">
                <input type="hidden" name="action" value="logout">
                <input id = "button" style="background-color: #F6F6F6; color: #22487B" type="submit" value ="Logout"><br><br>
                </form>
        </li>
    </ul>
 </div>
 <section>
        <div>
         <form  id = "form1" action="../user_manager/" method="post"><br>
                <input type="hidden" name="action" value="display_start_new_conversation_form">
                <input type = "hidden" name ="user_name" value="<?php echo $_SESSION["user_name"]; ?>">
                <input id = "button" type="submit" value ="Start New Conversation"><br>
         </form></div>
         <div>
        <h1>Your Conversations</h1>
        <table style = "margin-left:auto;margin-right:auto;">
            <tr>
                <th> With: </th>
                <th> Latest Message: </th>
                <th> &nbsp; </th>
            </tr>
            <?php foreach ($conversations as $conversation) : ?>
            <tr>
                <td><?php echo $conversation['other_user']; ?></td>
                <td><?php echo $conversation['latest_message']; ?></td>
           
                 <!-- Create delete product form -->
                <td><form action="." method="post">
                        <input type = "hidden" name ="action" value ="show_conversation">
                        <input type = "hidden" name ="other_user" value="<?php echo $conversation['other_user']; ?>">
                        <input type = "hidden" name ="user_name" value="<?php echo $conversation["user_name"]; ?>">
                        <input style ="padding: 10px;  border-radius: 15px;" type ="submit" id = "button" value="View Conversation">
                </form></td>   
            </tr>
            <?php endforeach; ?>
        </table>
        </div>
    </section>
 </head>
