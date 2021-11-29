 <head>
     <?php
        function getProperColor($message)
        {
            if ($message['sent_by'] != $_SESSION['user_name'])
                return '#22487B';
            else
                return '#53682B';
        }
        
        function getTextAlign($message)
        {
            if ($message['sent_by'] != $_SESSION['user_name'])
                return 'left';
            else
                return 'right';
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
          text-align: center;
          margin: auto;
          width: 50%;
          padding: 10px;
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
	font-family: sans-serif;
        height: 60px;
        text-align: center;
          margin: auto;
          width: 100%;
          padding: 10px;
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
      <ul id = "topNavBar" >
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
                <input id = "button" style="background-color: #F6F6F6; color: #22487B" type="submit" value ="Logout"><br><br></li>
                </form>
    </ul>
    <section> 
        <br> <br>
        <div><h1>Your Conversation</h1> </div>
            <?php foreach ($messages as $message) : ?>
                
                <?php $color = getProperColor($message)?>
                <?php $align = getTextAlign($message)?>
                <div style='background-color: <?php echo $color;?>; padding:10px; text-align: <?php echo $align;?>; margin-bottom: 30px; border-radius: 0px 40px;'>
                <label id = "label" style='color: white;'><?php echo $message['message']; ?></label>
                <p style='color: white; font-size: 12px; font-family: futura;'><?php echo $message['date']; ?></p>
                </div> 
            <?php endforeach; ?>
        </div>
        <div>
                <form action="." method="post">
                    <input type = "hidden" name ="action" value ="display_start_new_conversation_form">
                    <input type = "hidden" name ="other_user" value="<?php echo $message['sent_by']; ?>">
                    <input type = "hidden" name ="user_name" value="<?php echo $_SESSION["user_name"]; ?>">
                    <input type ="submit" id = "button" value="Reply">
                </form> 
        </div>
        <div><form  id = "form2" action="../user_manager/" method="post">
                <input type="hidden" name="action" value="get_conversations">
                <input type = "hidden" name ="user_name" value="<?php echo $_SESSION["user_name"]; ?>">
                <input id = "button" type="submit" value ="Return to Messages">
         </form></div>

    </section>
 </head>
