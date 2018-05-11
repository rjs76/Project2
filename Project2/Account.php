<?php
class AccountDB
{
    public static function authorize($em, $pass) {
        $db = Database::getDB();
        $isInDatabase = false;
        $query = 'SELECT * FROM accounts WHERE email = :email AND password = :password';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $em);
        $statement->bindValue(':password', $pass);
        $statement->execute();
        if ($info = $statement->fetchAll()) { //a result is found
            $isInDatabase = true;
        }
        $statement->closeCursor();
        return $isInDatabase;
    }
    public static function addAccount( $fname, $lname,$email, $ph, $bd, $g, $pass) {
        $db = Database::getDB();
        $query = 'INSERT INTO accounts (email, fname, lname, phone, birthday, gender, password) VALUES (:em, :fn, :ln, :p, :bd, :g, :pass)';
        $statement = $db->prepare($query);
        $statement->bindValue(":fn", $fname);
        $statement->bindValue(":ln", $lname);
        $statement->bindValue(":em", $email);
        $statement->bindValue(":p", $ph);
        $statement->bindValue(":bd", $bd);
        $statement->bindValue(":g", $g);
        $statement->bindValue(":pass", $pass);
        $statement->execute();
        $statement->closeCursor();
}
    public static function getNameByEmail($email){
        $db = Database::getDB();
        $query = 'SELECT fname, lname FROM accounts WHERE email = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $n = $statement->fetch();
        $statement->closeCursor();
        $name = $n['fname'] . " " . $n['lname'];
        return $name;
    }
    public static function getIDByEmail($email){
        $db = Database::getDB();
        $query = 'SELECT id FROM accounts WHERE email = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $i = $statement->fetch();
        $statement->closeCursor();
        $id = $i['id'];
        return $id;
    }
}