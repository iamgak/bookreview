<div class="container">
    <?php require($_SERVER['DOCUMENT_ROOT'].'/temp/header.php');?>

    <form id="main-form" action="#" method="post" data-id='post_form'>
        <h2>Change password</h2>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" id="password" name="password" required value="">
        </div>
        <div class="form-group">
            <label for="repeat_password">Repeat password:</label>
            <input type="text" id="repeat_password" name="repeat_password" required value="">
        </div>
        <div class="form-group">
            <button type="submit">Save password</button>
        </div>
    </form>

</div>