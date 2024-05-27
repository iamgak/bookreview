      <!-- Main -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
      </script>
      <?php require($_SERVER['DOCUMENT_ROOT'] . '/my_blog/temp/Admin/sidebar.php'); ?>
      <?php if (!empty($user)) { ?>
        <script>
          let user = <?php echo  json_encode($user); ?>;
          console.log(user)
        </script>

      <?php } ?>
      <main class="main-container">
        <div class="main-title">
          <p class="font-weight-bold">DASHBOARD</p>
        </div>

        <div class="main-cards">
          <div class="card">
            <div class="card-inner">
              <p class="text-primary">PRODUCTS</p>
              <span class="material-icons-outlined text-blue">inventory_2</span>
            </div>
            <span class="text-primary font-weight-bold">249</span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">PURCHASE ORDERS</p>
              <span class="material-icons-outlined text-orange">add_shopping_cart</span>
            </div>
            <span class="text-primary font-weight-bold">83</span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">SALES ORDERS</p>
              <span class="material-icons-outlined text-green">shopping_cart</span>
            </div>
            <span class="text-primary font-weight-bold">79</span>
          </div>

          <div class="card">
            <div class="card-inner">
              <p class="text-primary">INVENTORY ALERTS</p>
              <span class="material-icons-outlined text-red">notification_important</span>
            </div>
            <span class="text-primary font-weight-bold">56</span>
          </div>

        </div>

        <div class="charts">

          <div class="charts-card">
            <p class="chart-title">comment</p>
            <div id="bar-chart"></div>
          </div>

          <div class="charts-card">
            <p class="chart-title">Logged In and Out </p>
            <div id="area-chart">

            </div>
          </div>

          <div class="charts-card">
            <p class="chart-title">Comment </p>
            <div id="area-chart">
              <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
            </div>
          </div>
          <div class="charts-card">
            <p class="chart-title">Contact Us </p>
            <div id="area-chart">
              <canvas id="contact_us" style="width:100%;max-width:700px"></canvas>

            </div>
          </div>
          
          <div class="charts-card">
            <p class="chart-title">Contact Us </p>
            <div id="area-chart">
              <canvas id="myChart12" style="width:100%;max-width:700px"></canvas>

            </div>
          </div>
          
          <div class="charts-card">
            <p class="chart-title">Contact Us </p>
            <div id="area-chart">
              <canvas id="myChart13" style="width:100%;max-width:700px"></canvas>

            </div>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Users
          </div>
          <div class="card-body">
            <table id="datatablesSimple">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Active</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Phone</th>
                  <th>Created at</th>
                  <th>Last Login</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user['users'] as $user) { ?>
                  <tr>
                    <td><?php echo $user['uid'] ?? ' NA'; ?></td>
                    <td><?php echo $user['active'] ?? ' NA'; ?></td>
                    <td><?php echo $user['first_name'] ?? ' NA'; ?></td>
                    <td><?php echo $user['last_name'] ?? ' NA'; ?></td>
                    <td><?php echo $user['phone'] ?? ' NA'; ?></td>
                    <td><?php echo $user['created_at'] ?? ' NA'; ?></td>
                    <td><?php echo $user['created_at'] ??  'NA'; ?></td>
                   
                  </tr>
                <?php } ?>
                
              </tbody>
            </table>
          </div>
        </div>
      </main>
<script src="/my_blog/assets/js/admin.js"></script>
