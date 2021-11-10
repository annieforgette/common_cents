<main>
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
        body {
            background-color: #F6F6F6;
        }

	</style>
        <title>Login</title>
        <div><a href="../index.php"><img src="../images/logo.png" alt="Common Cents Logo" height="80"></a></div>
    </head>
    <body>
        <div>
            <form action="../user_manager/" method="post">
            <input type="hidden" name="action" value="login">
            
                <label id="label" style="font-size: 25px">Login</label><br><br>
                <label id="label">Username:</label>
                <input id = "text" type="text" name ="user_name"><br><br>
                
                <label id="label">Password:</label>
                <input id = "text" type="password" name ="password"><br><br>
                
                <input id = "button" type="submit" value ="Login"><br><br>
               
            </form>
             <a href ="../view/signup_form.php" id="label">Click to Sign Up</a>
        </div>
    </body>
</</main>