<main>
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
    <div><a href="../index.php"><img src="../images/logo.png" alt="Common Cents Logo" height="80"></a></div>        
    </head>
    <body>
        <div>
        <form action="../user_manager/" method="post">
        <input type="hidden" name="action" value="register">

        <label id="label" style="font-size:25px; padding-bottom:25px;">Sign Up</label><br><br>
        
        <label id="label">User Type:</label> 
        <label id="label" style="color:#53682B;">Group Admin:</label>
        <input type="checkbox" id="user_type" name ="user_type" value="group_admin">
        <label id="label" style="color:#53682B;">Group Member:</label>               
        <input type="checkbox" id="user_type" name ="user_type" value="group_member"><br><br>

        <label id="label">Username:</label>
        <input id = "text" type="text" name ="user_name"><br><br>
        
        <label id="label">Password:</label>
        <input id = "text" type="text" name ="password"><br><br>
                
        <label id="label">Email:</label>
        <input id = "text" type="text" name ="email"><br><br>
        
        <label id="label">First Name:</label>
        <input id = "text" type="text" name ="first_name"><br><br>
                
        <label id="label">Last Name:</label>        
        <input id = "text" type="text" name ="last_name"><br><br>
        
        <label>&nbsp;</label>
        <input id="button" type="submit" value="Register"><br><br>
       
    </form>
    </div>       
    <a href ="../view/login_form.php" id="label">Click to Log In</a>    
    </body>
</main>
