<?php
$conn = mysqli_connect('localhost', 'root', '', 'stage');
if (!$conn) {
    echo 'erreur: ' . mysqli_connect_error();
}