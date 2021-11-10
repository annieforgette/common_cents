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
 </head>
<main>
    <ul id = "topNavBar">
        <li><a href="../view/profile.php"><img src="../images/profile.png" height="60px"></a></li>
            <li><a href="../view/home_page_admin.php"><img src="../images/logo.png" height="60px"></a></li>
            <li>
                <form  id = "form1" action="../user_manager/" method="post">
                <input type="hidden" name="action" value="logout">
                <input id = "button" style="background-color: #F6F6F6; color: #22487B" type="submit" value ="Logout"><br><br></li>
                </form>
    </ul>
    <section> <div>
        <!-- display a table of users -->
        <br><br>
        <table style = "margin:40px">
            <tr>
                <th> First Name </th>
                <th> Last Name </th>
                <th> Username </th>
                <th> Email </th>
                <th> Initial Investment </th>
                <th> &nbsp; </th>
                <th> &nbsp; </th>
            </tr>
            <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['last_name']; ?></td>
                <td><?php echo $user['user_name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['initial_investment']; ?></td>
                
                 <!-- Create delete product form -->
                <td><form action="." method="post">
                        <input type = "hidden" name ="action" value ="display_confirm_delete_member">
                        <input type = "hidden" name ="user_name" value="<?php echo $user['user_name']; ?>">
                        <input type ="submit" value="Delete">
                </form></td>
                
                 <!-- Create delete product form -->
                <td><form action="." method="post">
                        <input type = "hidden" name ="action" value ="display_update_member_form">
                        <input type = "hidden" name ="user_name" value="<?php echo $user['user_name']; ?>">
                        <input type ="submit" value="Update">
                </form></td>
                    
            </tr>
            <?php endforeach; ?>
        </table>
        </div>
            <a id='button' style = 'margin-top: 20px; margin-left:40px;' href="../view/add_member_form.php">Add Group Member</a>
    </section>
</main>