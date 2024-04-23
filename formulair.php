<?php
include './inc/db.php';
include './inc/form.php';
include './inc/select.php';
include './inc/function.php';
include './inc/db_close.php';



?>
<?php 
$pageTitle='formulair';
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
<div class="position-relative  text-center">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
    <form  action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
  <div class="mb-3">
    <label for="titre" class="form-label">Titre</label>
    <input type="text"  name="titre" class="form-control" id="titre" value="<?php echo 
$titre ?>" >
    <div  class="form-text error"> <?php echo 
$errors['titreError'] ?> </div>
  </div>
  <div class="mb-3">
    <label for="duree" class="form-label">Duree </label>
    <input type="text" name="duree" class="form-control" id="duree" value="<?php echo 
$duree ?>"  placeholder="hh:mm:ss">
    <div  class="form-text error"> <?php echo 
$errors['dureeError'] ?> </div>
  </div>
  <div class="mb-3">
    <label for="Date" class="form-label">Date</label>
    <input type="Date" name="Date" class="form-control" id="Date" value="<?php echo 
$date ?>" >
    <div  class="form-text error"> <?php echo 
$errors['dateError'] ?></div>
  </div>
  <div class="mb-3">
    <label for="Ndesupport" class="form-label">Numero de support</label>
    <input type="text" name="Ndesupport" class="form-control" id="Ndesupport" value="<?php echo 
$Ndesupport ?>" >
    <div  class="form-text error"><?php echo 
$errors['NdesupportError'] ?></div>
  </div>
  <select class="form-select" name="category" aria-label="Default select example">
    <option value="">Category</option>
    <option>Musique tarifit </option>
    <option>Emission culturelle</option>
    <option>Emission RELIGIEUSE</option>
    <option> SERIE</option>
</select>
<div  class="form-text error"><?php echo $errors['categoryError']; ?></div>
<br>
<div class="mb-3">
    <label for="technicien" class="form-label">Technicien</label>
    <input type="text"  name="technicien" class="form-control" id="technicien" value="<?php echo 
$technicien ?>" >
    <div  class="form-text error"><?php echo 
$errors['technicienError'] ?></div>
  </div>
  <div class="mb-3">
  <label for="notes" class="form-label">Notes</label>
  <textarea class="form-control" name="notes" id="notes" value="<?php echo 
$notes ?>" rows="3"></textarea>
  <div  class="form-text error"><?php echo 
$errors['notesError'] ?></div>
</div>



  <button type="submit" name="submit"  class="btn btn-primary">envoye</button>
</form>
</div>
    </div>
</div>