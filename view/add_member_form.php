<?php require('../model/database.php');
       require('../model/user_db.php'); 
       session_start();?>
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
      </style>
      
        <title>Add Group Member</title>
<main>
    <div>
<h1>Add Group Member</h1>

        <form action="../user_manager/" method="post">
            <input type="hidden" name="action" value="add_member">
        
            <label id="label">Username: </label>
        
        <?php
        global $db;

        //Our select statement. This will retrieve the data that we want.
        $query = "SELECT * FROM users";

        //Prepare the select statement.
        $statement = $db->prepare($query);

        //Execute the statement.
        $statement->execute();

        //Retrieve the rows using fetchAll.
        $users = $statement->fetchAll();
        ?>

        <select name = 'user_name'>
            <?php foreach ($users as $user): ?>
            <option value="<?= $user['user_name']; ?>"><?php echo $user['user_name']?></option>
            <?php endforeach; ?>
        </select><br><br>
        
        <label id="label">Initial Investment:</label>
        <input type="text" name="initial_investment"><br>
        
        <input type ='hidden' name='group_id' value="<?php echo $_SESSION["group_id"]; ?>">
        <label>&nbsp;</label>
        
        <input id="button" style="margin: 20;"type="submit" value="Add Member"><br>
    </form>

    <form  id = "form2" action="../user_manager/" method="post">
                <input type="hidden" name="action" value="list_group_members">
                <input type = "hidden" name ="group_id" value="<?php echo $_SESSION["group_id"]; ?>">
                <input id = "button" type="submit" value ="Back"><br><br>
                </form>
    </div>
</main>