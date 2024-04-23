<?php
$sql = 'SELECT * FROM programmes';
$result = mysqli_query($conn, $sql);
$programmes = mysqli_fetch_all($result, MYSQLI_ASSOC);



