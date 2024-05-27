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
                    <option value="3">Active</option>
                    <option value="4">In active</option>
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
                <th class="title">Email</th>
                <th class="title">Name</th>
                <th class="title">Active</th>
                <th class="title">Created At </th>
                <th class="title">Last Login</th>
            </tr>
        </thead>
        <?php foreach ($user_listing as $user) { ?>
            <tbody>

                <tr>
                    <td class="user_info"><?php echo $user['email']; ?></td>
                    <td class="user_info"><?php echo $user['username'] ?? '-'; ?></td>
                    <?php if (!empty($user['active'])) { ?>
                        <td class="user_info btn">Active</td>
                    <?php } else { ?>
                        <td class="user_info btn">In-active</td>
                    <?php } ?>
                    <td class="user_info"><?php echo $user['created_at'] ?? '-'; ?></td>
                    <td class="user_info"><?php echo $user['last_login'] ?? '-'; ?></td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
    <ul class="pagination">
        <li>
            &lt;
        </li>
        <li>
            1
        </li>
        <li>
            1
        </li>
        <li>
            1
        </li>
        <li>
            &gt;
        </li>
    </ul>
</main>