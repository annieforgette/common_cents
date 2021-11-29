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
        <title>Add Investment Action</title>
    </head>
    <body>
        <div><a href="../view/home_page_admin.php"><img src="../images/logo.png" alt="Common Cents Logo" height="80"></a></div>

        <div>
            <form action="../user_manager/" method="post">
                <input type="hidden" name="action" value="add_investment_action">

                <label id="label" style="font-size: 25px">Add Investment Action</label><br><br>
                <label id="label">Actualized Gains/Losses:</label>
                <input id = "text" type="text" name ="actualized_gains_losses"><br><br>

                <label id="label">Unrealized Equity Gains/Losses:</label>
                <input id = "text" type="text" name ="unrealized_gains_losses"><br><br>

                <label id="label">Message to Group:</label>
                <input id = "text" type="text" name ="investment_message"><br><br>
                
                <label id="label">Group ID:</label>
                <input id = "text" type="text" name ="group_id"><br><br>

                <input id = "button" type="submit" value ="Submit"><br><br>

            </form>
            <div><a id="label" href="../view/home_page_admin.php">Back</a></div>
        </div>
    </body>
</main>