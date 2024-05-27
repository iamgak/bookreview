<div class="container">

    <?php require($_SERVER['DOCUMENT_ROOT'] . '/temp/header.php'); ?>
    <div class="search">

        <form action="#" method="POST">
            <input type="text" name="search" placeholder="Search by name/title/anything">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="listing">
        <!-- Sample Post -->
        <?php foreach ($blogs as $blog) { ?>
            <div class="list">
                <div class="title"><?php echo $blog['title']; ?></div>


                <p>Category: <?php echo $blog['category']; ?></p>
                <p>Sub-category: <?php echo $blog['sub_category']; ?></p>
                <p>Subject: <?php echo $blog['subject']; ?></p>
                <p>Published Date: <?php echo $blog['publish_date']; ?></p>
                <p class="content expanded">Content: <?php echo $blog['content']; ?>.</p>
                <?php if (strlen($blog['content']) > 100) { ?>
                    <span class="read_more" onclick="readmore(this)">
                        Read more
                    </span>
                <?php } ?>

                <div class="author">Author: <?php echo $blog['username']; ?></div>
            </div>
        <?php } ?>
    </div>
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