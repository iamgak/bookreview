<div class="container">
<?php require($_SERVER['DOCUMENT_ROOT'].'/temp/header.php');?>

    <h1><?php if (empty($pid)) {
            echo 'Write Your Review';
        } else {
            echo 'Edit Your Review';
        } ?>
        </h1>
    <form id='post-ad' action="#" method="POST" data-id='post_form'>
        <div class="form-group">
            <label for="title">Title of the Review:</label>
            <input type="text" id="title" placeholder='Enter Review Title' name="title" <?php if(!empty($edit_review)){ echo "value='{$edit_review['title']}'";}?>>
        </div>
        <div class="form-group">
            <label for="book_name">Book Name:</label>
            <input type="text" id="book_name" placeholder='Enter Book Name' name="book_name" <?php if(!empty($edit_review)){ echo "value='{$edit_review['book_name']}'";}?>>
        </div>

        <div class="form-group">
            <label for="genre">Genre:</label>
            <select name="genre" <?php if(!empty($edit_review)){ echo "value='{$edit_review['genre']}'";}?> id="">
                <option value="">Select genre</option>
                <?php foreach ($genres as $genre) { ?>
                    <option value="<?php echo $genre['id']; ?>"><?php echo $genre['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="rating">Rating</label>
            <select name="rating" <?php if(!empty($edit_review)){ echo "value='{$edit_review['rating']}'";}?> id="">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" id="author" placeholder='Enter author' name="author" <?php if(!empty($edit_review)){ echo "value='{$edit_review['author']}'";}?>>
        </div>

        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea id="comment" placeholder='Enter your view about book' name="comment" rows="8"><?php if(!empty($edit_review)){ echo "{$edit_review['comment']}";}?></textarea>
        </div>
        <div class="form-group">
            <label for="published_date">Published Date:</label>
            <input type="date" id="published_date" placeholder='Enter value' name="published_date"<?php if(!empty($edit_review)){ echo "value='{$edit_review['published_date']}'";}?>>
            <small>
                Enter date of publish
            </small>
        </div>
        <div class="form-group">
            <button type="submit">Publish Post</button>
        </div>
    </form>
</div>