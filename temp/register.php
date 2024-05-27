<div class="container" id="input">
    <!-- <div class="container" id=""> -->
    <!-- Register Form -->
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/temp/header.php'); ?>

    <form id="main-form" data-id='post_form' method="POST">
    <div class="title">Register here-</div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="repeat_password">Repeat Password:</label>
            <input type="text" id="repeat_password" name="repeat_password">
        </div>
        <div class="form-group">
            <button type="submit">Register ?</button>
        </div>
    </form>

</div>