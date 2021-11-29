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
        button {
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
        #button {
                font-size:20px; 
                margin: 10px; 
                color: #22487B;
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
        #button{
            font-size:20px; 
            margin: 10px; 
            color: #53682B;
            font-family: futura;
        }
      </style>
    
    </head>
    <body>
        <div><a href = "../index.php"><img src="../images/logo.png" alt="Common Cents Logo" height="125"></a></div><br>
        <div><h1 id="label">You've succesfully sent this message!<h1></div>
        <div><form  id = "form2" action="../user_manager/" method="post">
                <input type="hidden" name="action" value="get_conversations">
                <input type = "hidden" name ="user_name" value="<?php echo $_SESSION["user_name"]; ?>">
                <input id = "button" type="submit" value ="Return to Messages">
         </form><div>
    </body>
</html>
