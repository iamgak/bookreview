<div class="container">
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/temp/header.php'); ?>
    <div class="search">

        <form data-id="listing_page" method="POST">
            <input type="text" name="search" placeholder="Search review" value="<?php echo $search_uri ?? ''; ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="listing">
        <!-- Sample Post -->
        <?php if (!empty($blogs)) {
            foreach ($blogs as $blog) { ?>
                <div class="list">
                    <h2 class="title"><?php echo $blog['title']; ?></h2>
                    <p>Author: <?php echo $blog['author']; ?></p>
                    <p>Genre: <?php echo $blog['genre']; ?></p>
                    <p>Rating: <?php echo $blog['rating']; ?></p>
                    <p>Book Name: <?php echo $blog['book_name']; ?></p>
                    <p>Published Date: <?php echo $blog['published_date']; ?></p>

                    <p class="content expanded"> <?php echo $blog['comment']; ?>.</p>

                    <div class="read_more" onclick="readmore(this)">
                        Read more
                    </div>
                    <div class="author">Author: <?php echo $blog['username']; ?></div>

                </div>
            <?php }
        } else { ?>
            <p>No result Found</p>
        <?php } ?>
        
    <div class="pagination">
        <ul>
            <li> <a href="<?PHP echo create_anchor(); ?>">
                    &lt;&lt;
                </a>
            </li>
            <?php for ($i = 1; $i <  5; $i++) { ?>
                <li><a href="<?PHP echo create_anchor($i); ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li <?PHP echo create_anchor(); ?>>
                <a href="<?PHP echo create_anchor($i); ?>">
                    &gt;&gt;
                </a>

            </li>
        </ul>
    </div>
    </div>
</div>