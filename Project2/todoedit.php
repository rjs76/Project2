<?php include '../view/header.php'; ?>

<div class="galaxy">
    <main class="text-center opac">
        <h1>Edit A To-Do Item</h1>

        <form action="index.php" method="post" id="todo_form">


            <?php
            $id = filter_input(INPUT_GET, 'id');
            $todo = TodosDB::getTodoById($id);
            $cdOriginal = $todo->getCreateDate();
            $ddOriginal = $todo->getDueDate();
            $pattern = '/ [0-9]{2}:[0-9]{2}:[0-9]{2}/';
            $cdDateOnly = preg_replace($pattern, "", $cdOriginal);
            $ddDateOnly = preg_replace($pattern, "", $ddOriginal);
            ?>
            <input type="hidden" name="action" value="edit_todo">
            <input type="hidden" name="itemid" value="<?php echo $id; ?>">

            <br>
            <label>Message:</label>
            <input type="text" class="my-2" name="message" value="<?php echo $todo->getDescription(); ?>">
            <br>
            <label>Created Date:</label>
            <input type="date" class="my-2" name="created" value="<?php echo $cdDateOnly ?>">
            <br>
            <label>Due Date:</label>
            <input type="date" class="my-2" name="due" value="<?php echo $ddDateOnly ?>">
            <br>

            <input type="submit" class="my-2"value="Submit">
        </form>

        <p class="mt-1"><a class="btn btn-dark" href="?action=list_todo">Back</a></p>

    </main>
</div>

<?php include '../view/footer.php'; ?>