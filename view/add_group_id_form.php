<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 25%;
	}

        div {
          margin-top: 20px;
          text-align: center;
        }
        img {
            margin-bottom:10px;
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
            margin-top:20px;
        }
        body {
            background-color: #F6F6F6;    
            text-align: center;
   
        }
        

	</style>
        <title>Sign Up</title>
    <div><a href="../landing_page.php"><img src="../images/logo.png" alt="Common Cents Logo" height="80"></a></div>
    </head>
    <body>
        <div>
            <div>
            <form action="../user_manager/" method="post">
            <input type="hidden" name="action" value="add_group_id">
            
                <label id="label" style="font-size: 25px">Add Group ID</label><br><br>
                
                <label id="label">Create an ID for your Group :</label>
                <input id = "text" type="text" name ="group_id"><br><br>
                
                <input type="hidden" name="user_name" 
               value="<?php echo $user_name; ?>">
                <input id = "button" type="submit" value ="Finish Signing Up"><br><br>

            </form>
        </div>
    </body>
</html>

