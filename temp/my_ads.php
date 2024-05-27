<div class="container">
    <div class="search">
    <?php require($_SERVER['DOCUMENT_ROOT'].'/temp/header.php');?>

        <form data-id="listing_page">
            <input type="text" name="blog" placeholder="Search blog">
            <button type="button">Search</button>
        </form>
    </div>
    <div class="posts">
        <!-- Sample Post -->
        <?php if (!empty($blogs)) {
            foreach ($blogs as $blog) { ?>
                <div class="post">
                    <h2 class="title">~<?php echo $blog['title']; ?></h2>
                    <p>Author: <?php echo $blog['author']; ?></p>
                    <p>Genre: <?php echo $blog['genre']; ?></p>
                    <p>Rating: <?php echo $blog['rating']; ?></p>
                    <p>Book Name: <?php echo $blog['book_name']; ?></p>
                    <p>Published Date: <?php echo $blog['published_date']; ?></p>
                    <p>Comment:</p>
                    <p class="content expanded"> <?php echo $blog['comment']; ?>.</p>
                    <div class="more">
                        <span class="read_more" onclick="readmore(this)">
                            Read more
                        </span>
                        <span>Like/Dislike</span>
                    </div>
                </div>
                <?php if (!empty($blog['comments'])) { ?>
                    <div class="latest_comment">
                        <span>Latest reply ...</span>
                        <?php for ($i = 0; $i < count($blog['comments']); $i++) {
                            echo '<p>....   ' . $blog['comments'][$i]['comment'] . '</p>';
                        } ?>
                    </div>
                <?php } ?>
                <form action="">
                    <div class="comment">

                        <textarea name="comment" required></textarea>
                        <button type="button" name="Reply" min-length=20 onclick="add_comment(this,<?php echo $blog['id']; ?>)">Comment</button>
                    </div>
                </form>
            <?php }
        } else { ?>
            <p>No result Found</p>
        <?php } ?>
        <!-- End Sample Post -->
        <!-- You can add more posts dynamically using PHP -->
    </div>
</div>