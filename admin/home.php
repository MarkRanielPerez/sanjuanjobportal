<?php

class Dashboard{
  public function getjob(){
    $link = mysqli_connect("localhost", "root", "", "jobjuan");

      /* check connection */
      if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

      $query = "SELECT count(*) FROM `tbljob` WHERE 1";
      $result = mysqli_query($link, $query);
      if ($result) {
        $row = mysqli_fetch_row($result); // Fetch the result as an indexed array
        $count = $row[0]; // The count is in the first (and only) column
        echo $count;
      } else {
        echo "Query failed: " . mysqli_error($link);
      }

      /* close connection */
      mysqli_close($link);
  }
  public function getuser() {
    $link = mysqli_connect("localhost", "root", "", "jobjuan");

      /* check connection */
      if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

      $query = "SELECT count(*) FROM `tblusers` WHERE 1";
      $result = mysqli_query($link, $query);
      if ($result) {
        $row = mysqli_fetch_row($result); // Fetch the result as an indexed array
        $count = $row[0]; // The count is in the first (and only) column
        echo $count;
      } else {
        echo "Query failed: " . mysqli_error($link);
      }

      /* close connection */
      mysqli_close($link);
  }
  public function getApplicants(){
    $link = mysqli_connect("localhost", "root", "", "jobjuan");

      /* check connection */
      if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

      $query = "SELECT COUNT(*) FROM `tblapplicants` WHERE 1;";
      $result = mysqli_query($link, $query);
      if ($result) {
        $row = mysqli_fetch_row($result); // Fetch the result as an indexed array
        $count = $row[0]; // The count is in the first (and only) column
        echo $count;
      } else {
        echo "Query failed: " . mysqli_error($link);
      }

      /* close connection */
      mysqli_close($link);
  }
  public function getallCompanies(){
    $link = mysqli_connect("localhost", "root", "", "jobjuan");

      /* check connection */
      if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
      }

      $query = "SELECT count(*) FROM `tblcompany` WHERE 1;";
      $result = mysqli_query($link, $query);
      if ($result) {
        $row = mysqli_fetch_row($result); // Fetch the result as an indexed array
        $count = $row[0]; // The count is in the first (and only) column
        echo $count;
      } else {
        echo "Query failed: " . mysqli_error($link);
      }

      /* close connection */
      mysqli_close($link);
  }
}
$dash = new Dashboard()
?>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <?php $dash->getuser()?>
              </h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <?php
                  $dash->getjob()
                  ?>
              </h3> 
              <p>Total Jobs</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
                <?php $dash->getApplicants() ?>
              </h3>

              <p>Applicants</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                <?php $dash->getallCompanies() ?>
              </h3> 
              <p>Companies</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
      </div>
  </section>
  <section class="content">
    <canvas id="myChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </section>
  <?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=u429667672_jobjuan', 'u429667672_root', 'JobJuan123');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $categories = array(
        'Technology', 'Engineer', 'IT', 'Civil Engineer', 'HR',
        'Sales', 'Banking', 'Finance', 'BPO', 'Digital Marketing', 'Forklift Operator'
    );

    // Prepare the SQL query
    $sql = "SELECT category, COUNT(*) AS category_count FROM tbljob WHERE category IN (";
    $placeholders = implode(',', array_fill(0, count($categories), '?'));
    $sql .= $placeholders . ") GROUP BY category";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($categories);

    // Initialize arrays to store labels and data
    $labels = array();
    $data = array();

    // Fetch and add data to the arrays
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $labels[] = $row['category']; // Use category as labels
        $data[] = (int) $row['category_count']; // Use category_count as data
    }

    // Combine SQL data with your sample data
    $chartData = [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => 'Number of Jobs per sector',
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'borderWidth' => 1,
                'data' => $data, // Use the data array from SQL
            ],
        ],
    ];

    // Convert the chartData array to JSON format
    $chartDataJSON = json_encode($chartData);

    // Pass the JSON data to your JavaScript code
    
    echo "<script>var chartData = $chartDataJSON;</script>";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>



<script data-chart-data="<?php echo htmlentities($chartDataJSON); ?>">
    // JavaScript code to render the chart
    var ctx = document.getElementById('myChart').getContext('2d');
    var chartData = JSON.parse(document.currentScript.getAttribute('data-chart-data'));
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

