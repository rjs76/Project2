<?php
class UsersDB {
    private function __construct() {}
    public static function getUsers() {
        $users = array();
        $db = Database::getDB();
        $query = 'SELECT * FROM accounts';
        $statement = $db->prepare($query);
        $statement->execute();
        $accts = $statement->fetchAll();
        $statement->closeCursor();
        foreach($accts as $acct) {
            $user = new Users($acct['id'], $acct['email'], $acct['fname'], $acct['lname'], $acct['phone'], $acct['birthday'], $acct['gender'], $acct['password']);
            $users[] = $user;
         }
        return $users;
    }
} //end class
?>