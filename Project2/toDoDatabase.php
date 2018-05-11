<?php
class TodosDB {
    private function __construct() {}
    public static function getCompleteTodo($em) {
        $list = array();
        $db = Database::getDB();
        $query = 'SELECT * FROM todos WHERE owneremail = :email AND isdone = :bool';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $em);
        $statement->bindValue(':bool', 1);
        $statement->execute();
        $todos = $statement->fetchAll();
        $statement->closeCursor();
        foreach($todos as $todo) {
            $user = new Todo($todo['id'], $todo['message'], $todo['createddate'], $todo['duedate'], $todo['isdone']);
            $list[] = $user;
         }
        return $list;
    }
    public static function getIncompleteTodo($em) {
        $list = array();
        $db = Database::getDB();
        $query = 'SELECT * FROM todos WHERE owneremail = :email AND isdone = :bool';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $em);
        $statement->bindValue(':bool', 0);
        $statement->execute();
        $todos = $statement->fetchAll();
        $statement->closeCursor();
        foreach($todos as $todo) {
            $user = new Todo($todo['id'], $todo['message'], $todo['createddate'], $todo['duedate'], $todo['isdone']);
            $list[] = $user;
        }
        return $list;
    }
    public static function addTodo ($oid, $em, $mess, $cd, $dd, $done) {
        $db = Database::getDB();
        $query = 'INSERT INTO todos (owneremail, ownerid, createddate, duedate, message, isdone) VALUES (:em, :oid, :cd, :dd, :mess, :done)';
        $statement = $db->prepare($query);
        $statement->bindValue(":mess", $mess);
        $statement->bindValue(":cd", $cd);
        $statement->bindValue(":dd", $dd);
        $statement->bindValue(":em", $em);
        $statement->bindValue(":oid", $oid);
        $statement->bindValue(":done", $done);
        $statement->execute();
        $statement->closeCursor();
    }
    public static function editTodo($id, $mess, $cd, $dd) {
        $db = Database::getDB();
        $query = 'UPDATE todos SET message = :mess, createddate = :cd, duedate = :dd WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":mess", $mess);
        $statement->bindValue(":cd", $cd);
        $statement->bindValue(":dd", $dd);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $statement->closeCursor();
    }
    public static function getTodoById($id) {
        $db = Database::getDB();
        $list = array();
        $query = 'SELECT * FROM todos WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $todo = $statement->fetch();
        $statement->closeCursor();
        $user = new Todo($todo['id'], $todo['message'], $todo['createddate'], $todo['duedate'], $todo['isdone']);
        return $user;
    }
    public static function deleteTodo($id) {
        $db = Database::getDB();
        $query = 'DELETE FROM todos WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $statement->closeCursor();
    }
    public static function setComplete($id) {
        $db = Database::getDB();
        $query = 'UPDATE todos SET isdone = :done WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":done", 1);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $statement->closeCursor();
    }
    public static function setIncomplete($id) {
        $db = Database::getDB();
        $query = 'UPDATE todos SET isdone = :done WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(":done", 0);
        $statement->bindValue(":id", $id);
        $statement->execute();
        $statement->closeCursor();
    }
} //end class
?>