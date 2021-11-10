 <?php
// update investment information for group members
    function add_investment_action($actualized_gains_losses, $unrealized_gains_losses, $investment_message, $group_id)
    {
        global $db;
        $date = date("Y-m-d  G:i:s");
        $query = $query = 'INSERT INTO investments
                    (group_id, actualized_gains_losses, unrealized_gains_losses, investment_message, date)
               VALUES
                    (:group_id, :actualized_gains_losses, :unrealized_gains_losses, :investment_message, :date)';
        $statement = $db->prepare($query);
        $statement->bindValue(':actualized_gains_losses', $actualized_gains_losses);
        $statement->bindValue(':unrealized_gains_losses', $unrealized_gains_losses);
        $statement->bindValue(':investment_message', $investment_message);
        $statement->bindValue(':group_id', $group_id);
        $statement->bindValue(':date', $date);
        $statement->execute();
        $statement->closeCursor();
    }
    
    function get_investment($group_id)
    {
        global $db;
        $query = 'SELECT * FROM investments
                  WHERE group_id = :group_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':group_id', $group_id); 
        $statement->execute();
        $investment = $statement->fetch();
        $statement->closeCursor();
        return $investment;
    }
?>