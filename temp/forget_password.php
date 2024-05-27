<div class="container" id="input">
    <!-- Register Form -->
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/my_blog/temp/header.php'); ?>
    <form id="main-form" data-id='post_form' method="POST">
            <div class="title">Forget Password</div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>

    </div>