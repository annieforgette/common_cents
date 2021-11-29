<?php

// Start session management and include necessary functions
session_start();

require('../model/database.php');
require('../model/user_db.php');
require('../model/investment_db.php');
require('../model/messages_db.php');

// get the action that the user submitted (usually by clicking a button)
$action = filter_input(INPUT_POST, 'action');

// if the actoin is null
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        // set action to log in (user should not be able to do anything until they login)
        $action = 'login';
    }
}

// if the admin moves to the members tab
if ($action == 'list_group_members') {
        // Get the user data
        $group_id = filter_input(INPUT_POST, 'group_id');
        $users = get_group_members($group_id);

        // Display the group members list
        include('../view/manage_members.php');
}

// if the admin moves to the members tab
if ($action == 'list_group_members_by_username') {
        // Get the user data
        $user_name = filter_input(INPUT_POST, 'user_name');
        $user = get_user($user_name);
        $group_id = $user['group_id'];
        $users = get_group_members($group_id);

        // Display the group members list
        include('../view/manage_members.php');
}

// if the user clicked submit on the sign up form
if ($action == 'register') {
    // get information from form filled in by user
    $user_name = filter_input(INPUT_POST, 'user_name');
    $user_type = filter_input(INPUT_POST, 'user_type');
    $password = filter_input(INPUT_POST, 'password');
    $email = filter_input(INPUT_POST, 'email');
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    
    // check if any of the fields were null
    $any_null = $user_name == NULL || $user_type == NULL || $password == NULL || $email == NULL || $first_name == NULL || $last_name == NULL;
    
    // if a field is not filled out
    if ($any_null) {
        // display error
        echo "Please fill out all fields and try again.";
        include('../view/signup_form.php');
    }

    // if this username is already taken
    $username_taken = check_if_username_taken($user_name);
    if ($username_taken) {
        // display error
        echo 'Username taken!';
        include('../view/signup_form.php');
    }
    
    // if the email is invalid (not properly formatted)
    $email_valid = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email_valid) {
        // display error
        echo 'Please enter a valid email!';
        include('../view/signup_form.php');
    }

    // if all fields are filled in and this username is unique and the email is valid
    if ($email_valid && !$username_taken && !$any_null) 
    {
        // add user to database         
        add_user($user_name, $user_type, $password, $email, $first_name, $last_name);
        
         // if this user is a group admin
        if ($user_type == 'group_admin') 
        {
            // prompt them to add a group id
            include('../view/add_group_id_form.php');
        }

        // if this user is a group member
        else 
        {
            // allow them to login
            include('../view/login_form.php');
        }
        
        // set up email variables
        $to_address = $email;
        $to_name = $first_name . ' ' . $last_name;
        $from_address = 'akforgette@gmail.com';
        $from_name = 'Common Cents Group Contract Trading';
        $subject = 'Common Cents Registration Complete';
        $body = '<p> Thanks for registering with our site. </p>' .
                '<p> You can now log in to your account. <p> ' .
                '<p> Enjoy the app! <p>' .
                '<p> - The Common Cents Team <p>';
        $is_body_html = true;

        try {
            // send conformation email to new user
            // send_email($to_address, $to_name, $from_address, $from_name, $subject, $body, $is_body_html);
        } catch (Exception $ex) {
             $error = $ex->getMessage();
        }   
    }
}

// if the user clicked submit on the login form
else if ($action == 'login') {
    $user_name = filter_input(INPUT_POST, 'user_name');
    $password = filter_input(INPUT_POST, 'password');
    
    // make sure that this is a valid user
    if (is_valid_user_login($user_name, $password)) 
    {
        $_SESSION['is_valid_user'] = true;
        $_SESSION["user_name"] = $user_name;
        $_SESSION["password"] = $password;
        
        // get information regarding this usr
        $user = get_user($user_name);
        
        // get this user's type
        $user_type = $user['user_type'];
        
        // if this is a group admin
        if ($user_type == 'group_admin')
        {
            // get the group id
            $group_id = $user['group_id'];
            $_SESSION["user_type"] = 'group_admin';
            $_SESSION["group_id"] = $group_id;

            // move to admin home page, pass the group id
            include('../view/home_page_admin.php');  
        }
        // if this is a group member
        else if ($user_type == 'group_member')
        {
            $_SESSION["user_type"] = 'group_member';
            // move to member home page
            include('../view/home_page_user.php');  
        }
        
    } 
    // if this is not a valid user
    else 
    {
        // display error
        $login_message = 'Username or Password is Incorrect.';
        echo $login_message;
        include('../view/login_form.php');
    }
}

// if the user registered as an admin
else if ($action == 'add_group_id')
{
    // get information regarding group id
    $user_name = filter_input(INPUT_POST, 'user_name');
    $group_id = filter_input(INPUT_POST, 'group_id');

    // set this user's group id to match the one entered
    update_user($user_name, $group_id);
    include('../view/login_form.php');
}

// if the user clicked to log out
else if ($action == 'logout') {
    //clear all session data from memory
    $_SESSION = array(); 
    // clean up the session ID
    session_destroy(); 
    // display message and appropriate page
    $login_message = 'You have been logged out';
    include('../view/logout_message.php');
}
// if an admin clicked the add investment action
else if ($action == 'add_investment_action'){
    
    // get the data inputted by the admin
    $actualized_gains_losses = filter_input(INPUT_POST, 'actualized_gains_losses');
    $unrealized_gains_losses = filter_input(INPUT_POST, 'unrealized_gains_losses');
    $investment_message = filter_input(INPUT_POST, 'investment_message');
    $group_id = filter_input(INPUT_POST, 'group_id');
     
    // add information to database for each group member
    add_investment_action($actualized_gains_losses, $unrealized_gains_losses, $investment_message, $group_id);
    // go back to home page
    include('../view/investment_action_confirmation.php');
}
 
// if the group admin is trying to add a new member to their group
else if ($action == 'add_member')
{
    // get data entered by the admin
   $user_name = filter_input(INPUT_POST,'user_name');
   $group_id = filter_input(INPUT_POST, 'group_id');
   $initial_investment = filter_input(INPUT_POST, 'initial_investment');

   // add this member to their group
   add_member($user_name, $group_id, $initial_investment);  
   
   // return admin to home page
   include('../view/home_page_admin.php');
}

// if the group admin tries to delete a group member
else if ($action == 'display_confirm_delete_member')
{
   $user_name = filter_input(INPUT_POST,'user_name');
      
   // display the confirm delete page
   include('../view/confirm_delete_member.php');
}

// if the group admin confirms that they want to delete a group member
else if ($action == 'delete_member')
{
   $user_name = filter_input(INPUT_POST,'user_name');
   
   // delete this user from their group
   delete_member($user_name);
   
   include('../view/home_page_admin.php');
}

// if the group admin wants to update a member's investment amount
else if ($action == 'display_update_member_form')
{
    // get information regarding that group member
    $user_name = filter_input(INPUT_POST, 'user_name');
    $user = get_user($user_name);
    
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $initial_investment = $user['initial_investment'];  

    // display form with this information filled in
   include('../view/update_member_form.php');
}

// if the group admin has updated a member's investment amount
else if ($action == 'update_member')
{
    // make this change in the database
    $user_name = filter_input(INPUT_POST, 'user_name');
    $initial_investment = filter_input(INPUT_POST, 'initial_investment');
    update_member($user_name, $initial_investment) ;
    
    include('../view/home_page_admin.php');
}

// if a group member is attempting to add reporting
else if ($action == 'generate_reporting')
{
    // get user name
    $user_name = filter_input(INPUT_POST, 'user_name');
    
    // get user associated with this username
    $user = get_user($user_name);

    // get the latest investment update associated with this user's group
    $investment = get_investment($user['group_id']);
    
    // get lastest investment message from latest admin update
    $latest_investment_message = $investment['investment_message'];
        
    // get actualized gains/losses from latest admin update
    $actualized_gains_losses = $investment['actualized_gains_losses'];
    $unrealized_gains_losses = $investment['unrealized_gains_losses'];

    // get this user's group members to calculate the number of total group members
    $group_members = get_group_members($user['group_id']);
    $group_total = 0;
    foreach ($group_members as $group_member){
        $group_total = $group_total + $group_member['initial_investment'];
    }
        
    // calculate this user's percent profit basis
    if ($group_total == 0){
        $perc_profit_basis = 1.0;
    }
    else {
        $perc_profit_basis = $user['initial_investment']/$group_total;
    }
    
    $perc_profit_basis_formatted = number_format($perc_profit_basis * 100,2);
    // get this uer's current investment (if it has not changed, use initial investment)
    $investment = $user['current_investment'];
    if ($investment == NULL)
    {
        $investment = $user['initial_investment'];
    }
    
    // calculate this user's total earnings/losses for the current week
    $current_week = number_format($perc_profit_basis * $actualized_gains_losses, 2); 
    $current_week_unrealized = number_format($perc_profit_basis * $unrealized_gains_losses, 2); 
    
    // and all time
    $all_time = number_format($investment + $current_week, 2);
    
    // building array of data points for data visualization
    $investment_updates = get_all_investment_updates($user['group_id']);
    $dataPoints = array();
    // move through each investment update that this group's admin has enetered
    foreach($investment_updates as $investment_update)
    {
        // get the actualized gains and losses for this investment update
        $this_update_actualized_gains_losses = $investment_update['actualized_gains_losses'];
        // get this user's total earnings/losses after this investment update
        $this_update = number_format($perc_profit_basis * $this_update_actualized_gains_losses, 2);
        // add the earnings/losses as well as the date of this invetsment update to the array
        // this array will be used to plot data on the x and y axis of a line graph
        array_push($dataPoints, ["y"=> $this_update, "label"=> $investment_update['date'],]);
    }
    
    $dataPoints2 = array();
    // move through each investment update that this group's admin has enetered
    foreach($investment_updates as $investment_update)
    {
        // get the actualized gains and losses for this investment update
        $this_update_unrealized_gains_losses = $investment_update['unrealized_gains_losses'];
        // get this user's total earnings/losses after this investment update
        $this_update = number_format($perc_profit_basis * $this_update_unrealized_gains_losses, 2);
        // add the earnings/losses as well as the date of this invetsment update to the array
        // this array will be used to plot data on the x and y axis of a line graph
        array_push($dataPoints2, ["y"=> $this_update, "label"=> $investment_update['date'],]);
    }
  
  
    // move user to the reporting page
    include('../view/member_reporting.php');
}

else if ($action == 'generate_reporting_admin')
{
    // get user name
    $user_name = filter_input(INPUT_POST, 'user_name');
    
    // get user associated with this username
    $user = get_user($user_name);

    // get the latest investment update associated with this user's group
    $investment = get_investment($user['group_id']);
    
    // get lastest investment message from latest admin update
    $latest_investment_message = $investment['investment_message'];
        
    // get actualized gains/losses from latest admin update
    $actualized_gains_losses = $investment['actualized_gains_losses'];
    $unrealized_gains_losses = $investment['unrealized_gains_losses'];

    // get this user's group members to calculate the number of total group members
    $group_members = get_group_members($user['group_id']);
    $group_total = 0;
    foreach ($group_members as $group_member){
        $group_total = $group_total + $group_member['initial_investment'];
    }
        
    // calculate this user's percent profit basis
    if ($group_total == 0){
        $perc_profit_basis = 1.0;
    }
    else {
        $perc_profit_basis = $user['initial_investment']/$group_total;
    }
    
    $perc_profit_basis_formatted = number_format($perc_profit_basis * 100,2);
    // get this uer's current investment (if it has not changed, use initial investment)
    $investment = $user['current_investment'];
    if ($investment == NULL)
    {
        $investment = $user['initial_investment'];
    }
    
    // calculate this user's total earnings/losses for the current week
    $current_week = number_format($perc_profit_basis * $actualized_gains_losses, 2); 
    $current_week_unrealized = number_format($perc_profit_basis * $unrealized_gains_losses, 2); 
    
    // and all time
    $all_time = number_format($investment + $current_week, 2);
    
    // building array of data points for data visualization
    $investment_updates = get_all_investment_updates($user['group_id']);
    $dataPoints = array();
    // move through each investment update that this group's admin has enetered
    foreach($investment_updates as $investment_update)
    {
        // get the actualized gains and losses for this investment update
        $this_update_actualized_gains_losses = $investment_update['actualized_gains_losses'];
        // get this user's total earnings/losses after this investment update
        $this_update = number_format($perc_profit_basis * $this_update_actualized_gains_losses, 2);
        // add the earnings/losses as well as the date of this invetsment update to the array
        // this array will be used to plot data on the x and y axis of a line graph
        array_push($dataPoints, ["y"=> $this_update, "label"=> $investment_update['date'],]);
    }
    
    $dataPoints2 = array();
    // move through each investment update that this group's admin has enetered
    foreach($investment_updates as $investment_update)
    {
        // get the actualized gains and losses for this investment update
        $this_update_unrealized_gains_losses = $investment_update['unrealized_gains_losses'];
        // get this user's total earnings/losses after this investment update
        $this_update = number_format($perc_profit_basis * $this_update_unrealized_gains_losses, 2);
        // add the earnings/losses as well as the date of this invetsment update to the array
        // this array will be used to plot data on the x and y axis of a line graph
        array_push($dataPoints2, ["y"=> $this_update, "label"=> $investment_update['date'],]);
    }
  
  
    // move user to the reporting page
    include('../view/member_reporting_admin.php');
}
   
// if the user clicks to start a new conversation
else if ($action == 'display_start_new_conversation_form')
 {
    // show the proper form
    $user_name = filter_input(INPUT_POST, 'user_name');
    $user = get_user($user_name);
    $members = get_users();

    include('../view/start_new_conversation.php');
} 

// if the user clicks to send message
else if ($action == 'send_message')
{
    $sent_to = filter_input(INPUT_POST, 'to');
    $sent_by = filter_input(INPUT_POST, 'from');
    $message = filter_input(INPUT_POST, 'message');
    $date = date("M,d,Y h:i:s A");

    // add this message to the database
    add_message($sent_by, $sent_to, $message, $date);
    update_latest_message($sent_by, $sent_to, $message);
            
    // show confirmation message
    include('../view/message_confirmation.php');
} 

else if ($action == 'start_new_conversation')
 {
    $other_user = filter_input(INPUT_POST, 'other_user');
    $user_name = filter_input(INPUT_POST, 'user_name');
    $latest_message = filter_input(INPUT_POST, 'message');
    $conversations = get_conversations($user_name);

    // make suer that this user has not already started a conversation with the other user
    $exists = false;
    foreach ($conversations as $conversation) {
        if ($conversation['other_user'] == $other_user) {
            $exists = true;
        }
    }
    if (!$exists) {
        // if they have not started a conversation already
        // add this new conversation
        add_conversation($other_user, $user_name, $latest_message);
    }
    // if they already have a conversation with this user
    // add this message to that conversation
    add_message($user_name, $other_user, $latest_message);
    update_latest_message($user_name, $other_user, $latest_message);

    // display message confirmation
    include('../view/message_confirmation.php');
} 

// get all the conversations this user is a part of 
else if ($action == 'get_conversations'){
        $user_name = filter_input(INPUT_POST, 'user_name');
        $conversations = get_conversations($user_name);
        
        // display them in the messaging tab
        include('../view/messaging.php');
}

// get messages associated with the conversation that the user clicked on
 else if ($action == 'get_messages') {
    $user_name = filter_input(INPUT_POST, 'user_name');
    $messages = get_messages($user_name);

    // display them to the user
    include('../view/messaging.php');
} 

else if ($action == 'show_conversation')
    {
    $user_name = filter_input(INPUT_POST, 'user_name');
    $other_user = filter_input(INPUT_POST, 'other_user');
    $messages = get_conversation($user_name, $other_user);

    include('../view/conversation.php');
} 

// if the user clicks on the logo in the top nav bar
else if ($action == 'go_home'){
        // find the user's type
    $user_name = filter_input(INPUT_POST, 'user_name');
    $user = get_user($user_name);
    $user_type = $user['user_type'];

    // direct them to the proper home pae
    if ($user_type == 'group_member') {
        include('../view/home_page_user.php');
    } else if ($user_type == 'group_admin') {
        include('../view/home_page_admin.php');
    }
}

?>
