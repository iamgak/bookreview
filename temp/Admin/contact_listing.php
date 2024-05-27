<?php require($_SERVER['DOCUMENT_ROOT'] . '/temp/Admin/sidebar.php'); ?>

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
                <th class="title">Email</th>
                <th class="title">Name</th>
                <th class="title">Phone</th>
                <th class="title">Contact At </th>
                <th class="title">Query</th>
                <!-- <th class="title">Delete</th> -->
            </tr>
        </thead>
        <?php
        if (!empty($contact_listing)) {
            $i = 1;
            foreach ($contact_listing as $user) { ?>
                <tbody>
                    <tr>

                        <td class="user_info">
                            <input type="checkbox" name='delete[]' id="<?php echo $user['id']; ?>" form='form' value="<?php echo $user['id']; ?>">
                            <label for="<?php echo $user['id']; ?>"></label>
                        </td>

                        <td class="user_info"><?php echo $i; ?></td>
                        <td class="user_info"><?php echo $user['id']; ?></td>
                        <td class="user_info"><?php echo $user['email']; ?></td>
                        <td class="user_info"><?php echo $user['name'] ?? '-'; ?></td>
                        <td class="user_info"><?php echo $user['phone'] ?? '-'; ?></td>
                        <td class="user_info"><?php echo $user['contact_at'] ?? '-'; ?></td>
                        <td class="user_info"><?php echo $user['query'] ?? '-';
                                                $i++; ?></td>
                        <!-- <td class="user_info"><button>Delete</button></td> -->
                    </tr>
            <?php }
        } ?>
                </tbody>
    </table>
    <ul class="pagination">
        <li>&lt;</li>
        <li>1</li>
        <li>1</li>
        <li>1</li>
        <li>&gt;</li>
    </ul>
</main>