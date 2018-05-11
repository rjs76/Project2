<?php
require('../model/toDosDatabase.php');
require('../model/Account.php');
require('../model/ToDo.php');
require('../model/Database1.php');
//$cookieName = 'cookieid';
//setcookie($cookieName, $id, time() + (86400 * 30), "/"); // 86400 = 1 day
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'auth';
    }
}
if ($action == "auth") {
    $email = filter_input(INPUT_POST, 'signInEmail');
    $pass = filter_input(INPUT_POST, 'signInPassword');
    $name = AccountDB::getNameByEmail($email);
    $id = AccountDB::getIDByEmail($email);
    $inDatabase = AccountDB::authorize($email, $pass);
    $_SESSION['auth'] = $inDatabase;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_pass'] = $pass;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_id'] = $id;
    $_SESSION['incomplete'] = TodosDB::getIncompleteTodo($email);
    $_SESSION['complete'] = TodosDB::getCompleteTodo($email);
    header('Location: .?action=list_todo');
}
else if ($action == "new_user") {
    $first = filter_input(INPUT_POST, 'firstname');
    $last = filter_input(INPUT_POST, 'lastname');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $phone = filter_input(INPUT_POST, 'phone');
    $birthday = filter_input(INPUT_POST, 'bday');
    $gender = filter_input(INPUT_POST, 'gender');
    if ($first == NULL || $last == NULL || $email == NULL || $password == NULL || $phone == NULL || $birthday == NULL || $gender == NULL){
        echo 'Not found in database';
        echo '<br>';
        echo '<a href="../index.php">Refresh';
        echo '</a>';
    }
    else {
        $result='Success';
        AccountDB::addAccount($first, $last,$email, $phone, $birthday, $gender, $password);
        header("Location: ../index.php?r=$result");
    }
}
if ((!empty($_SESSION['auth']) || $_SESSION['auth'] == 'true')) {
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'list_todo';
        }
    }
    if ($action == 'list_todo') {
        $name = $_SESSION['user_name'];
        $todosInc = $_SESSION['incomplete'];
        $todosCom = $_SESSION['complete'];
        include('todolist.php');
    }
    else if ($action == "show_add_form") {
        include('todoadd.php');
    }
    else if ($action == "show_edit_form") {
        include('todoedit.php');
    }
    else if ($action == "edit_todo") {
        $tid = filter_input(INPUT_POST, 'itemid');
        $todo = TodosDB::getTodoById($tid);
        //pasing variables along
        $message = filter_input(INPUT_POST, "message");
        $created = filter_input(INPUT_POST, "created");
        $due = filter_input(INPUT_POST, "due");
        if ($tid == NULL ||$message == NULL || $message == FALSE ||$due == NULL || $created == NULL) {
            echo 'Invalid';
            echo '<br>';
            echo '<a href=".?action=list_todo">Refresh';
            echo '</a>';
        }
        else {
            TodosDB::editTodo($tid, $message, $created, $due);
            //reset todos
            $_SESSION['incomplete'] = TodosDB::getIncompleteTodo($_SESSION['user_email']);
            $_SESSION['complete'] = TodosDB::getCompleteTodo($_SESSION['user_email']);
            header('Location: .?action=list_todo');
        }
    }
    else if ($action == "add_todo") {
        $message = filter_input(INPUT_POST, "message");
        $created = filter_input(INPUT_POST, "created");
        $due = filter_input(INPUT_POST, "due");
        $em = $_SESSION['user_email'];
        $oid = $_SESSION['user_id'];
        if ($oid == NULL || $em == NULL || $message == NULL || $message == FALSE ||$due == NULL || $created == NULL) {
            echo 'Invalid';
            echo '<br>';
            echo '<a href=".?action=list_todo">Refresh';
            echo '</a>';
        }
        else {
            TodosDB::addTodo($oid, $em, $message, $created, $due, 0);
            $_SESSION['incomplete'] = TodosDB::getIncompleteTodo($em);
            $_SESSION['complete'] = TodosDB::getCompleteTodo($em);
            header('Location: .?action=list_todo');
        }
    }
    else if ($action == "delete_todo") {
        $tid = filter_input(INPUT_POST, "itemid");
        $todo = TodosDB::getTodoById($tid);
        $em = $_SESSION['user_email'];
        if ($em == NULL || $tid == NULL || $tid == "") {
            echo 'Invalid';
            echo '<br>';
            echo '<a href=".?action=list_todo">Refresh';
            echo '</a>';
        }
        else {
            TodosDB::deleteTodo($tid);
            $_SESSION['incomplete'] = TodosDB::getIncompleteTodo($em);
            $_SESSION['complete'] = TodosDB::getCompleteTodo($em);
            header('Location: .?action=list_todo');
        }
    }
    else if ($action == "set_complete") {
        $tid = filter_input(INPUT_POST, "itemid");
        $todo = TodosDB::getTodoById($tid);
        $em = $_SESSION['user_email'];
        if ($em == NULL || $tid == NULL || $tid == "") {
            echo 'Invalid';
            echo '<br>';
            echo '<a href=".?action=list_todo">Refresh';
            echo '</a>';
        }
        else {
            TodosDB::setComplete($tid);
            $_SESSION['incomplete'] = TodosDB::getIncompleteTodo($em);
            $_SESSION['complete'] = TodosDB::getCompleteTodo($em);
            header('Location: .?action=list_todo');
        }
    }
    else if ($action == "set_incomplete") {
        $tid = filter_input(INPUT_POST, "itemid");
        $todo = TodosDB::getTodoById($tid);
        $em = $_SESSION['user_email'];
        if ($tid == NULL || $tid == "") {
            echo 'Invalid';
            echo '<br>';
            echo '<a href=".?action=list_todo">Refresh';
            echo '</a>';
        }
        else {
            TodosDB::setIncomplete($tid);
            $_SESSION['incomplete'] = TodosDB::getIncompleteTodo($em);
            $_SESSION['complete'] = TodosDB::getCompleteTodo($em);
            header('Location: .?action=list_todo');
        }
    }
    else if ($action == "logout") {
        session_destroy();
        header('Location: ../index.php');
    }
}
else {
    echo 'Not found in database';
    echo '<br>';
    echo '<a href="../index.php">Refresh';
    echo '</a>';
}
?>