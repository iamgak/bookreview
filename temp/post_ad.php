<div class="container post_form">
    

        <?php require($_SERVER['DOCUMENT_ROOT'] . '/temp/header.php'); ?>

        <p>Create a New Post</p>
        <form id='main-form' action="#" method="POST" data-id='post_form'>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" placeholder='Enter Title' name="title">
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" placeholder='Enter Subject' name="subject">
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" value='' id="">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['category']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sub_category">Sub Category:</label>
                <select name="sub_category" value='' id="">
                    <option value="">Select sub category</option>

                    <?php foreach ($sub_categories as $sub) { ?>
                        <option value="<?php echo $sub['id']; ?>"><?php echo $sub['sub_category']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags:</label>
                <input type="text" id="tags" placeholder='Enter Tags' name="tags">
                <small>Separate tags with commas (e.g., technology, programming)</small>
            </div>
            <!-- <div class="form-group">
            <label for="featured_image">Featured Image URL:</label>
            <input type="text" id="featured_image" placeholder = 'Enter value' name="featured_image">
        </div> -->

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" placeholder='Enter detail description about your post' name="content" rows="8"></textarea>
            </div>
            <div class="form-group">
                <label for="published_date">Published Date:</label>
                <input type="date" id="published_date" placeholder='Enter value' name="published_date">
                <small>
                    Enter date to publish the post
                </small>
            </div>
            <div class="form-group">
                <button type="submit">Publish Post</button>
            </div>
        </form>
    