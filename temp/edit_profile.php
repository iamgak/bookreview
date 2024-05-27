<div class="container">
    <?php require($_SERVER['DOCUMENT_ROOT'].'/my_blog/temp/header.php');?>

    <form id="main-form" action="#" method="post" data-id='post_form'>
        <h2>User Info</h2>
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php if (!empty($user_detail)) {
                                                                            echo $user_detail['first_name'];
                                                                        } ?>" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required value="<?php if (!empty($user_detail)) {
                                                                                    echo $user_detail['last_name'];
                                                                                } ?>">
        </div>
        <div class="form-group">
            <label for="Phone">Phone:</label>
            <input type="text" id="phone" name="phone" required value="<?php if (!empty($user_detail)) {
                                                                            echo $user_detail['phone'];
                                                                        } ?>">
        </div>
        <div class="form-group">
            <button type="submit">Save Changes</button>
        </div>
    </form>

</div>