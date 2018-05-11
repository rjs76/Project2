<?php include '../view/header.php'; ?>

<?php
//$name = filter_input(INPUT_COOKIE, 'cookieName');
//$em = $_COOKIE['cookieEm'];
?>



<main>
    <h1>Welcome, <?php echo $name ?></h1>

    <div class="container-fluid">
        <div class="card text-center border-0 mt-5 inc">
            <h2 class="py-2">Incomplete To-Do List</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Created Date</th>
                        <th>Due Date</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <?php foreach ($todosInc as $tdi) : ?>
                    <tr>
                        <?php echo $tdi->printRow(); ?>
                        <td title="edit">
                            <span><a class="btn btn-warning" href="?action=show_edit_form&id=<?php echo $tdi->getId(); ?>"><i class="fa fa-pencil"></i></a></span>
                        </td>
                        <td title="delete">
                            <form action="." method="post">
                                <input type="hidden" name="action"
                                       value="delete_todo">
                                <input type="hidden" name="itemid" value="<?php echo $tdi->getId(); ?>">
                                <button class="btn btn-warning" type="submit" value="Delete"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                        <td title="set as complete">
                            <form action="." method="post">
                                <input type="hidden" name="action"
                                       value="set_complete">
                                <input type="hidden" name="itemid" value="<?php echo $tdi->getId(); ?>">
                                <button class="btn btn-warning" type="submit" value="Complete"><i class="fa fa-check"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>


            <p><a class="btn btn-warning mt-2" href="?action=show_add_form"><i class="fa fa-plus"></i></a></p>
        </div>


        <div class="card text-center border-0 mt-4 comp">
            <h2 class="py-2">Complete To-Do List</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Due Date</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <?php foreach ($todosCom as $tdc) : ?>
                    <tr>
                        <?php echo $tdc->printRow(); ?>
                        <td title="edit">
                            <span><a class="btn btn-primary" href="?action=show_edit_form&id=<?php echo $tdc->getId(); ?>"><i class="fa fa-pencil"></i></a></span>
                        </td>
                        <td title="delete">
                            <form action="." method="post">
                                <input type="hidden" name="action"
                                       value="delete_todo">
                                <input type="hidden" name="itemid" value="<?php echo $tdc->getId(); ?>">
                            <button class="btn btn-primary" type="submit" value="Delete"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                    <td title="set as incomplete">
                        <form action="." method="post">
                            <input type="hidden" name="action"
                                       value="set_incomplete">
                            <input type="hidden" name="itemid" value="<?php echo $tdc->getId(); ?>">
                            <button class="btn btn-primary" type="submit" value="Incomplete"><i class="fa fa-close"></i></button>
                      </form>
                    </td>
                </tr>
            <?php endforeach; ?>

            </table>

        </div>



    </div>
</main>




<?php include '../view/footer.php'; ?>