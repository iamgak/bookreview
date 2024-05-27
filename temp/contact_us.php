<div class="container">
    <!-- Register Form -->
<?php require($_SERVER['DOCUMENT_ROOT'].'/temp/header.php');?>

    <form id="main-form" data-id='post_form'>
    <div class="title">Contact us</div>
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Phone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="query">Query:</label>
            <textarea name="query" id="query" cols="30" rows="10" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>

</div>