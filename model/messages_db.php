 <?php
    function add_message($sent_by, $sent_to, $message)
    {
       global $db;

       $query = 'INSERT INTO messages
                    (sent_by, sent_to, message)
               VALUES
                    (:sent_by, :sent_to, :message)';

       $statement = $db->prepare($query);
       
       $statement->bindValue(':sent_by', $sent_by);
       $statement->bindValue(':sent_to', $sent_to);
       $statement->bindValue(':message', $message); 
       $statement->execute();
       $statement->closeCursor();
    }
    
    function update_latest_message($user_name, $other_user, $latest_message)
    {
        global $db;

        $query = 'UPDATE conversations
                  SET latest_message = :latest_message
                  WHERE user_name = :user_name 
                  AND other_user = :other_user';
        $statement = $db->prepare($query);
        $statement->bindValue(':latest_message', $latest_message);
        $statement->bindValue(':user_name', $user_name);
        $statement->bindValue(':other_user', $other_user);
        $statement->execute();
        $statement->closeCursor();
    }
    
    function get_messages($user_name)
    {
        global $db;
        $query = 'SELECT * FROM messages
                  WHERE sent_to = :user_name
                  ORDER BY date';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name); 
        $statement->execute();
        $messages = $statement->fetchAll();
        $statement->closeCursor();
        return $messages;
    }
    
    function get_conversation($user_name, $other_user)
    {
        global $db;

        $query = 'SELECT * FROM messages
                  WHERE (sent_to = :user_name AND sent_by = :other_user) OR (sent_to = :other_user AND sent_by = :user_name)
                  ORDER BY date';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name); 
        $statement->bindValue(':other_user', $other_user); 
        $statement->execute();
        $messages = $statement->fetchAll();
        $statement->closeCursor();
        return $messages;
    }
    
    function add_conversation($other_user, $user_name, $latest_message)
    {
       global $db;

       $query = 'INSERT INTO conversations
                    (user_name, other_user, latest_message)
               VALUES
                    (:user_name, :other_user, :latest_message)';

       $statement = $db->prepare($query);
       
       $statement->bindValue(':user_name', $user_name);
       $statement->bindValue(':other_user', $other_user);
       $statement->bindValue(':latest_message', $latest_message);        
       $statement->execute();
       $statement->closeCursor(); 
    }
    
    function get_conversations($user_name)
    {
         global $db;
        // select user that matches that username
        $query = 'SELECT * FROM conversations
                where user_name = :user_name';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_name', $user_name);
        $statement->execute();
        $conversations = $statement->fetchAll();
        $statement->closeCursor();
        return $conversations;
    }
?>