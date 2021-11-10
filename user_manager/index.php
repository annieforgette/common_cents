<?php

// Start session management and include necessary functions
session_start();
$_SESSION['newSession']['access'] = true;

require('../model/database.php');
require('../model/user_db.php');
require('../model/investment_db.php');
set_include_path('/Applications/XAMPP/xamppfiles/htdocs/book_apps/PHPMailer'); 
require_once 'PHPMailerAutoload.php';

$action = filter_input(INPUT_POST, 'action');

if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'login';
    }
}

// if the user isn't logged in, force the user to login
// if (!isset($_SESSION['is_valid_user'])) {
//    $action = 'login';
// }

if ($action == 'list_group_members') {
        // Get the user data
        $group_id = filter_input(INPUT_POST, 'group_id');
        $users = get_group_members($group_id);

        // Display the group members list
        include('../view/manage_members.php');
}

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
    // something was posted
    $user_name = filter_input(INPUT_POST, 'user_name');
    $user_type = filter_input(INPUT_POST, 'user_type');
    $password = filter_input(INPUT_POST, 'password');
    $email = filter_input(INPUT_POST, 'email');
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    
    // if a field is not filled out
    if ($user_name == NULL || $user_type == NULL || $password == NULL || $email == NULL || $first_name == NULL || $last_name == NULL) {
        // display error
        echo "Please fill out all fields and try again.";
    }

    // if this username is already taken
    $username_taken = check_if_username_taken($user_name);
    if ($username_taken) {
        // display error
        echo 'Username taken!';
    }

    // if all fields are filled in and this username is unique
    else {
        // add user to database         
        add_user($user_name, $user_type, $password, $email, $first_name, $last_name);
        
         // if this user is a group admin
        if ($user_type == 'group_admin') {
            // prompt them to add a group id
            include('../view/add_group_id_form.php');
        }

        // if this user is a group member
        else {
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
            send_email($to_address, $to_name, $from_address, $from_name, $subject, $body, $is_body_html);
        } catch (Exception $ex) {
             $error = $ex->getMessage();
        }   
    }
}

// if the user clicked submit on the login form
else if ($action == 'login') {
    $user_name = filter_input(INPUT_POST, 'user_name');
    $password = filter_input(INPUT_POST, 'password');
    
    if (is_valid_user_login($user_name, $password)) 
    {
        $_SESSION['is_valid_user'] = true;
        $_SESSION["user_name"] = $user_name;
        $_SESSION["password"] = $password;
        // get information regarding this usr
        $user = get_user($user_name);
        
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
        
    } else {
        $login_message = 'Username or Password is Incorrect.';
        echo $login_message;
        include('../view/login_form.php');
    }
}

// if the user registered as an admin
else if ($action == 'add_group_id')
{
    $user_name = filter_input(INPUT_POST, 'user_name');
    $group_id = filter_input(INPUT_POST, 'group_id');

    update_user($user_name, $group_id);
    include('../view/login_form.php');
}

// if the user clicked to log out
else if ($action == 'logout') {
    $_SESSION = array(); //clear all session data from memory
    session_destroy(); // clean up the session ID
    $login_message = 'You have been logged out';
    include('../view/logout_message.php');
}
// if an admin clicked the add investment action
else if ($action == 'add_investment_action'){
    
    $actualized_gains_losses = filter_input(INPUT_POST, 'actualized_gains_losses');
    $unrealized_gains_losses = filter_input(INPUT_POST, 'unrealized_gains_losses');
    $investment_message = filter_input(INPUT_POST, 'investment_message');
    $group_id = filter_input(INPUT_POST, 'group_id');
     
    // add information to database for each group member
    add_investment_action($actualized_gains_losses, $unrealized_gains_losses, $investment_message, $group_id);
    // go back to home page
    include('../view/investment_action_confirmation.php');
}
 
else if ($action == 'add_member')
{
   $user_name = filter_input(INPUT_POST,'user_name');
   $group_id = filter_input(INPUT_POST, 'group_id');
   $initial_investment = filter_input(INPUT_POST, 'initial_investment');

   add_member($user_name, $group_id, $initial_investment);  
   
   include('../view/home_page_admin.php');
}

else if ($action == 'display_confirm_delete_member')
{
   $user_name = filter_input(INPUT_POST,'user_name');
      
   include('../view/confirm_delete_member.php');
}

else if ($action == 'delete_member')
{
   $user_name = filter_input(INPUT_POST,'user_name');
   
   delete_member($user_name);
   
   include('../view/home_page_admin.php');
}

else if ($action == 'display_update_member_form')
{

    $user_name = filter_input(INPUT_POST, 'user_name');
    $user = get_user($user_name);
    
    $first_name = $user['first_name'];
    $last_name = $user['last_name'];
    $initial_investment = $user['initial_investment'];  

   include('../view/update_member_form.php');
}

else if ($action == 'update_member')
{
    $user_name = filter_input(INPUT_POST, 'user_name');
    $initial_investment = filter_input(INPUT_POST, 'initial_investment');
    update_member($user_name, $initial_investment) ;
    
    include('../view/home_page_admin.php');
}

else if ($action == 'generate_reporting'){
    $user_name = filter_input(INPUT_POST, 'user_name');
    $user = get_user($user_name);

    $investment = get_investment($user['group_id']);

    $actualized_gains_losses = $investment['actualized_gains_losses'];
    
    $group_members = get_group_members($user['group_id']);
    $group_total = 0;
    foreach ($group_members as $group_member){
        $group_total = $group_total + $group_member['initial_investment'];
    }
        
    if ($group_total == 0){
        $perc_profit_basis = 1.0;
    }
    else {
        $perc_profit_basis = $user['initial_investment']/$group_total;
    }
    
    $investment = $user['current_investment'];
    
    if ($investment == NULL)
    {
        $investment = $user['initial_investment'];
    }

    $current_week = number_format($perc_profit_basis * $actualized_gains_losses, 2); 
    $all_time = number_format($investment + $current_week, 2);
     
    include('../view/member_reporting.php');
}
?>
