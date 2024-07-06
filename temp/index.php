

<div class="container">
    <?php require($_SERVER['DOCUMENT_ROOT'] . '/temp/header.php'); ?>
    <section class="main-content">
        <h2>About Us</h2>
        <p>This is a Book Review Website.</p>
        <p>Where User can post review or comment on other review.</p>

        <?php if(!empty($blogs)){?>
        <section class="latest-blog">
            <h2>Latest Blogs</h2>
            <ul class="blogs">
                <?php foreach($blogs as $blog){?>
                <li class="blog">
                    <div class="blog-heading"><?php echo $blog['title']; ?></div>
                    <div class="blog-heading"><?php echo $blog['book_name']; ?></div>
                    <div class="blog-content expanded">
                        <p><?php echo $blog['content']; ?>.</p>
                    </div>
                </li>
                <?php } ?>
                    
            </ul>
        </section>
        <?php } ?>

        <section class="latest-news">
            <h2>See Review</h2>
            <ul class="article">
                <?php foreach($genre as $sub){?>
                    <li onclick = 'go_to("<?Php echo'/my_blog/review_listing/'. $sub['name'].'/'; ?>")'><?php echo $sub['name'];?></li>
                    <?php } ?>
            </ul>
        </section>
       <section>

           <div>
               <p>
                   Write Review
                </p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet eum laudantium molestias id sequi ullam? Commodi tempora, quod quibusdam est deleniti culpa necessitatibus optio quis corrupti. Impedit, ratione eaque corrupti aspernatur quis accusantium illum tenetur.</p>
            </div>
    </section> 
    </section>
    
</div>