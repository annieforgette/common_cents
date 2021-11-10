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
    <!-- display a table of customer information -->
    <h2 id="label">View/Update Member</h2>
    <div> <form action="../user_manager/" method="post">
        <input type="hidden" name="action" value="update_member">
        
        <label id="label">First Name:</label>
        <?php echo $first_name; ?>
        <br>

        <label id="label">Last Name:</label>
        <?php echo $last_name; ?>
        <br>

        <label id="label">Investment:</label>
        <input type="text" name="initial_investment" 
               value="<?php echo $initial_investment; ?>">
        <br>
        
        <input type="hidden" name="user_name" 
               value="<?php echo $user_name; ?>">

        <label>&nbsp;</label>
        <input id='button' type="submit" value="Update Member">
        <br>
        </form> </div>
</main>