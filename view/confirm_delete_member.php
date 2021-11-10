<?php
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Common Cents</title>
    <style>
        div {
          margin-top: 30px;
          text-align: center;
        }
        img {
            padding-top:100px;
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
        body {
            background-color: #F6F6F6;
        }
        #label{
            font-size:20px; 
            margin: 10px; 
            color: #53682B;
            font-family: futura;
        }
      </style>
    
    </head>
    <body>
        <div><a href = "../index.php"><img src="../images/logo.png" alt="Common Cents Logo" height="125"></a></div><br>
        <div>
            <form action="../user_manager/" method="post">
                <label id="label" style="font-size: 25px">Are you sure you want to delete <?php echo $user_name; ?> from group?</label><br><br>
                <input type="hidden" name="action" value="delete_member">
                <input type = "hidden" name ="user_name" value="<?php echo $user_name; ?>">
                <input id = "button" type="submit" value ="Yes">
            </form>
            <form action="../user_manager/" method="post">
               <input type="hidden" name="action" value="list_group_members_by_username">
                <input type = "hidden" name ="user_name" value="<?php echo $user_name; ?>">
                <input id = "button" type="submit" value ="No"><br><br>
            </form>
        </div>
    </body>
</html>