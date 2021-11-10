<?php
    // get all the members currently in your group
    function get_group_members($group_id)
    {
        global $db;
        $query = 'SELECT * FROM users
                  WHERE group_id = :group_id
                  ORDER BY last_name';
        $statement = $db->prepare($query);
        $statement->bindValue(':group_id', $group_id); 
        $statement->execute();
        $members = $statement->fetchAll();
        $statement->closeCursor();
        return $members;
    }
    
    function get_user($user_name)
    {
        global $db;
        $query = 'SELECT * FROM users
                  WHERE user_name = :user_name
                  ORDER BY last_name';

        $statement = $db->prepare($query);   
        $statement->bindValue(':user_name', $user_name);  
        $statement->execute();   
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }
    
    function is_valid_user_login($user_name, $password) 
    {
        global $db;
        // select user that matches that username
        $query = 'SELECT password FROM users
                where user_name = :user_name';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        // get encrypted password from hash
        $hash = $row['password'];
        // check if password entered matches the hashed password
        $verify = password_verify($password, $hash);
        return $verify;
    }
    
    function check_if_username_taken($user_name)
    {
        global $db;  
        
        $user_name = 'SELECT * FROM users
                      WHERE user_name = :user_name';
        if ($user_name != NULL) 
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    function add_user($user_name, $user_type, $password, $email, $first_name, $last_name)
    {
        global $db;
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = 'INSERT INTO users
                    (user_name, user_type, password, email, first_name, last_name)
               VALUES
                    (:user_name, :user_type, :password, :email, :first_name, :last_name)';
       $statement = $db->prepare($query);
       
       $statement->bindValue(':user_name', $user_name);
       $statement->bindValue(':user_type', $user_type);
       $statement->bindValue(':password', $hash);        
       $statement->bindValue(':email', $email);
       $statement->bindValue(':first_name', $first_name);
       $statement->bindValue(':last_name', $last_name);
       
       $statement->execute();
       $statement->closeCursor();
    }
    
    function update_member($user_name, $initial_investment) 
    {
        global $db;
        $query = 'UPDATE users
                  SET initial_investment = :initial_investment
                  WHERE user_name = :user_name';
        $statement = $db->prepare($query);
        $statement->bindValue(':initial_investment', $initial_investment);
        $statement->bindValue(':user_name', $user_name);
        $statement->execute();
        $statement->closeCursor();
    }
    
    // add a member to your group
    function add_member($user_name, $group_id, $initial_investment)
    {
        global $db;
        $query = 'UPDATE users
                  SET group_id = :group_id,
                  initial_investment = :initial_investment
                  WHERE user_name = :user_name';
        $statement = $db->prepare($query);
        $statement->bindValue(':group_id', $group_id);
        $statement->bindValue(':initial_investment', $initial_investment);
        $statement->bindValue(':user_name', $user_name);
        $statement->execute();
        $statement->closeCursor();
    }
    
    // delete group member from member list
    function delete_member($user_name)
    {
        // get global database variable
        global $db;
        
        // delete member with user name from the database
        $query = 'DELETE FROM users
                  WHERE user_name = :user_name';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);
        $statement->execute();
        $statement->closeCursor();
    }
    
    function update_user($user_name, $group_id) 
    {
        global $db;

        $query = 'UPDATE users
                  SET group_id = :group_id
                  WHERE user_name = :user_name';
        
        $statement = $db->prepare($query);
        $statement->bindValue(':group_id', $group_id);
        $statement->bindValue(':user_name', $user_name);

        $statement->execute();
        $statement->closeCursor();
    }
    
    function send_email($to_address, $to_name, $from_address, $from_name, $subject, $body, $is_body_html)
    {
        
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPSecure='tls';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'akforgette@gmail.com';
        $mail->Password = 'sockmonkeycatfoot';
        
        $mail->setFrom($from_address, $from_name);
        $mail->addAddress($to_address, $to_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        if ($is_body_html) {
            $mail->isHTML(true);
        }
        if (!$mail->send()){
            throw new Exception('Error sending email ' . htmlspecialchars($mail->ErrorInfo));
        }
    }
?>
