
<?php
include './inc/db.php';

include './inc/select.php';
include './inc/function.php';
include './inc/db_close.php';
?>
<?php 
$pageTitle='chart';
?>

<?php include_once './part/header.php'; ?>


<div class="pages d-flex" >
<div class="sidebar bg-white p-20 p-relative"> <h3 class="p-relative txt-c mt-0 "> Radio </h3>
    <ul>
 <li>
    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="index.php">
    <i class="fa-solid fa-chart-simple fa-fw"></i>
    <span >Dashboard</span>
    </a>
 </li>
 <ul>
 <li>
    <a class="active d-flex align-center fs-14 c-black rad-6 p-10" href="programmes.php">
    <i class="fa-solid fa-table"></i>
    <span>Programmes</span>
    </a>
 </li>
 <li>
    <a class="active d-flex align-center fs-14 c-black rad-6 p-10" href="Chart.php">
    <i class="fa-solid fa-magnifying-glass-chart fa-fw"></i>
    <span>Chart Grphie</span>
    </a>
 </li>

    </ul>

 </div>
    <div class="content w-full">
 <!-- start head-->
 <div class="head bg-white p-15 between-flex">
    <div class="search p-relative">
    <form id="searchForm">
        <div class="form-group">
            <label for="searchKeyword"></label>
            <input type="search" class="form-control p-10" id="searchKeyword" name="searchKeyword" placeholder="Enter keyword">
        </div>
    </form>
    <div id="noResultsMessage" style="display: none; color: red;"></div>
        
    </div>
 <div class="icons d-flex align-center">
    <span class="notification p-relative">
        <i class="fa-regular fa-bell fa-lg"></i>
    </span>
    <img src="images/avatar.png" alt="">
 </div>


 </div>
  <!-- end head-->

  <h1 class="p-relative">Chart Graphie</h1>
<div class="chart-page m-10 d-grid gap-20 between-flex">
<div class="chart bg-white p-10 between-flex">
    <div class="chart-container txt-c p-10">
    <h2 class="chart-heading m-10 c-black">Charts Concepts  </h2>
        <canvas id="myChart"></canvas>
    </div>
</div>
</div>
<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stage";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Execute query to get the total count for each category
$sql_total = "SELECT category, COUNT(*) AS total_count FROM chrt GROUP BY category";
$result_total = mysqli_query($conn, $sql_total);

$total_data = [];
while ($row_total = mysqli_fetch_assoc($result_total)) {
    $total_data[$row_total['category']] = $row_total['total_count'];
}

// Execute query to get the total count for each category
$sql = "SELECT category, COUNT(*) AS total_count FROM chrt GROUP BY category";
$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $category = $row['category'];
    $total_count = $row['total_count'];
    $percentage = round(($total_count / array_sum($total_data)) * 100, 2); // Calculate percentage based on the total count
    $data[$category] = $percentage;
}

// Sort the data array based on percentage values
arsort($data);

$chartLabels = [];
foreach ($data as $category => $percentage) {
    $label = "$category - $percentage%";
    $chartLabels[] = $label;
}

$chartLabels = json_encode($chartLabels); // Encode the labels including percentages
$chartData = json_encode(array_values($data)); // Prepare chart data

// Close connection (optional)
mysqli_close($conn);
?>


<script src="./js/chart.js"></script>


<script>
    new Chart(document.getElementById("myChart"), {
        type: 'doughnut',
        data: {
            labels: <?php echo $chartLabels ?>,
            datasets: [{
                backgroundColor: ["#DC143C", "#A9A9A9", "#DEB887", "#3a86ff", ],
                data: <?php echo $chartData ?>,
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Chart js Doughnut'
            },
            cutout: '40%',
            radius: 160
        }
    });

  
</script>



<?php include_once './part/footer.php'; ?>