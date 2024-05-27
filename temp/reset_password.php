<div class="container" id="input">
    <!-- Register Form -->
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/temp/header.php'); ?>
    <form id="main-form" data-id='post_form' method="POST">
            <div class="title">Reset Password</div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="repeat_password">Repeat Password:</label>
                <input type="text" id="repeat_password" name="repeat_password">
            </div>
            <div class="form-group">
                <button type="submit">Click to reset ?</button>
            </div>
        </form>

    </div>