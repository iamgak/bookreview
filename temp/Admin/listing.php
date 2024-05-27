<?php require($_SERVER['DOCUMENT_ROOT'] . '/my_blog/temp/Admin/sidebar.php'); ?>

<main class="main-container">
    <div class="charts-card">


        <form id="form" data-id='post_form' method="POST">

            <div class="form-group">
                <label for="search">Search-filter:</label>
                <input type="text" id="search" placeholder="search name/active " name="search">
            </div>
            <div class="form-group">
                <label for="order_by">Order by:</label>
                <select name="order_by" id="order_by">
                    <option value="">Select filter</option>
                    <option value="1">Latest</option>
                    <option value="2">Oldest</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <select name="date" id="date">
                    <option value="">Any Date</option>
                    <option value="7">1 Week</option>
                    <option value="30">1 Month</option>
                    <option value="60">6 Month</option>
                    <option value="375">1 Year</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit">Search</button>
            </div>
        </form>

    </div>
    <table class="list">
        <thead>
            <tr>

            <th class="title"> <input type="submit" name="submit" value='Delete' form="form"></th>
                <th class="title">S.No.</th>
                <th class="title">Id</th>
                <th class="title">Title</th>
                <th class="title">Author</th>
                <th class="title">Category</th>
                <th class="title">Created At</th>
                <th class="title">Publish Date</th>
                <th class="title">Content</th>
                <th class="title">Rating</th>
                <th class="title">Active</th>
                <th class="title">Is Deleted </th>
            </tr>
        </thead>
        <?php $i= 1; foreach ($blogs as $blog) { ?>
            <tbody>
                <tr>
                <td class="user_info">
                <input type="checkbox" name='delete[]' id="<?php echo $blog['id'];?>" form='form' value="<?php echo $blog['id']; ?>">    
                <label for="<?php echo $blog['id']; ?>"></label>
            </td>
                    <td class="user_info"><?php echo $i; ?></td>
                    <td class="user_info"><?php echo $blog['id']; ?></td>
                    <td class="user_info"><?php echo $blog['title'] ?? '-'; ?></td>
                    <td class="user_info"><?php echo $blog['author'] ?? '-'; ?></td>
                    <td class="user_info"><?php echo $blog['book_name'] ?? '-'; ?></td>
                    <td class="user_info"><?php echo $blog['created_at'] ?? '-'; ?></td>
                    <td class="user_info"><?php echo $blog['published_date'] ?? '-'; ?></td>
                    <td class="user_info"><?php echo $blog['comment'] ?? '-'; ?></td>
                    <td class="user_info"><?php echo $blog['rating'] ?? '-'; ?></td>
                    <td class="user_info"><?php echo $blog['active'] ?? '-'; ?></td>
                    <?php if (!empty($blog['is_deleted'])) { ?>
                        <td class="user_info">DELETED</td>
                    <?php } else { ?>
                        <td class="user_info">ACTIVE</td>
                    <?php } $i++; ?>
                </tr>
            <?php } ?>
            </tbody>
    </table>
        <ul class="pagination">
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
</main>