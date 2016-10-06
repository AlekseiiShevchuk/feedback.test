<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Пожалуйста, веедите логин и пароль!</h4>
            </div>
            <div class="modal-body">
                <form action="/auth.php" method="post">
                    <div class="form-group">
                        <label for="login">Логин:</label>
                        <input type="login" class="form-control" name="login" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Пароль:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>