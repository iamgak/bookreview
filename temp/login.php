<div class="container" id="input">
    <!-- Register Form -->
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/temp/header.php'); ?>
    <form id="main-form" data-id='post_form' method="POST">
            <div class="title">Login</div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <button type="submit">Login ?</button>
            </div>
        </form>

    </div>