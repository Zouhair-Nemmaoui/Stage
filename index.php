<?php
include './inc/db.php';

include './inc/select.php';
include './inc/function.php';
include './inc/db_close.php';
?>
<?php 
$pageTitle='Dashboard';
?>
<?php include_once './part/header.php'; ?>

<div class="pages d-flex" >
<div class="sidebar bg-white p-20 p-relative"> <h3 class="p-relative txt-c mt-0 "> Radio </h3>
    <ul>
 <li>
    <a class="active d-flex align-center fs-14 c-black rad-6 p-10" href="index.php">
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
    <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="Chart.php">
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
  <h1 class="p-relative">Dashboard</h1>
<div class="wrapper d-grid gap-20">
    <div class="welcome bg-white rad-10 txt-c-mobile block-mobile ">
 <div class="intro p-20 d-flex space-between bg-eee">
<div>
<h2 class="m-0">Welcome</h2>
<p class="c-grey mt-5">Radio</p>
</div>
<img class="hide-mobile" src="images/welcome.png" alt="">
 </div>
 <img src="images/avatar.png" alt="" class="avatar">
 <div class="body txt-c d-flex p-20 mb-20 block-mobile">
    <div>Zouhair<span class="d-block c-grey fs-14 mt-10"> Stagair developer</span></div>
    <div>01<span class="d-block c-grey fs-14 mt-10"> Project</span></div>
    <div>04<span class="d-block c-grey fs-14 mt-10">  Concept programmes radio</span></div>
 </div>
 <a href="profil.php" class="visit fs-14 rad-6 bg-blue c-white w-full btn-shape ">Profile</a>

    </div>
      <!-- end welcome-->
        <!-- start top search items-->
<div class="search-items p-20 bg-white rad-10">
    <h2 class="mt-0 mb-20">Top search items</h2>
<div class="items-head d-flex space-between c-grey mb-10">
    <div>keyword</div>
</div>
<div class="items d-flex space-between pt-15 pb-15">
    <span>Concepts</span>
</div>
<div class="items d-flex space-between pt-15 pb-15">
    <span>Emission relegiuese </span>
</div>
<div class="items d-flex space-between pt-15 pb-15">
    <span>Emission culturelle</span>
</div>
<div class="items d-flex space-between pt-15 pb-15">
    <span>musique trafits</span>
</div>
<div class="items d-flex space-between pt-15 pb-15">
    <span>Serie</span>
</div>
</div>
    <!-- end top search items-->
</div>
 <!-- Start Projects table -->

 <div class="projects p-20 bg-white rad-10 m-20">
    <h2 class="mt-0 mb-20">Table programmes</h2>
    <div class="responsive-table">
    <table id='myTable' class="fs-15 w-full">
        <thead>
            <tr>
                <th>titre</th>
                <th>duree</th>
                <th>date</th>
                <th> Numero de support </th>
                <th> category</th>
                <th>technicien </th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>


            <?php
            // Establish database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "stage"; // Assuming "projetStage" is your database name

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch data from both tables
            $sql = "SELECT p.*, c.percentage 
        FROM programmes p
        LEFT JOIN chrt c ON p.id = c.id
        ORDER BY p.Date ASC"; // Assuming 'Date' is the column name for the date field

            $result = mysqli_query($conn, $sql);

            // Check for errors
            if (!$result) {
                die("Error executing query: " . mysqli_error($conn));
            }

            // Check if there are any results
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['titre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['duree']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Ndesupport']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['technicien']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['notes']) . "</td>";
                    echo "</tr>";
                }
            };

            // Close database connection
            mysqli_close($conn);
            ?> </tbody>
        <tfoot style="display: table-header-group;">
            <tr>
            <th>titre</th>
                <th>duree</th>
                <th>date</th>
                <th> Numero de support </th>
                <th> category</th>
                <th>technicien </th>
                <th>Notes</th>
            </tr>
        </tfoot>
    </table>
    </div>
 </div>
 <!-- End Projects table -->

</div>
</div>
<br>
<br>



<?php include_once './part/footer.php'; ?>