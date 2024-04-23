<?php

$titre = isset($_POST['titre']) ? $_POST['titre'] : '';
$duree = isset($_POST['duree']) ? $_POST['duree'] : '';
$date = isset($_POST['Date']) ? $_POST['Date'] : '';
$Ndesupport = isset($_POST['Ndesupport']) ? $_POST['Ndesupport'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$technicien = isset($_POST['technicien']) ? $_POST['technicien'] : '';
$notes = isset($_POST['notes']) ? $_POST['notes'] : '';

$errors = [
    'titreError' => '',
    'dureeError' => '',
    'dateError' => '',
    'NdesupportError' => '',
    'categoryError' => '',
    'technicienError' => '',
    'notesError' => '',
];

if (isset($_POST['submit'])) {
    if (empty($titre)) {
        $errors['titreError'] = 'titre no valide';
    }
    if (empty($duree)) {
        $errors['dureeError'] = 'duree no valide';
    }
    if (empty($date)) {
        $errors['dateError'] = 'date no valide';
    }
    if (empty($Ndesupport)) {
        $errors['NdesupportError'] = 'Ndesupport no valide';
    }
    if (empty($category)) {
        $errors['categoryError'] = "Please select a category.";
    }
    if (empty($technicien)) {
        $errors['technicienError'] = 'technicien no valide';
    }
    if (empty($notes)) {
        $errors['notesError'] = 'notes  no valide';
    } elseif (!preg_match("/^(?:[0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/", $duree)) {
        $errors['dureeError'] = 'duree no correct';
    }

    if (!array_filter($errors)) {
        $titre = mysqli_real_escape_string($conn, $titre);
        $duree = mysqli_real_escape_string($conn, $duree);
        $date = mysqli_real_escape_string($conn, $date);
        $Ndesupport = mysqli_real_escape_string($conn, $Ndesupport);
        $category = mysqli_real_escape_string($conn, $category);
        $technicien = mysqli_real_escape_string($conn, $technicien);
        $notes = mysqli_real_escape_string($conn, $notes);

        // Insert data into programmes table
        $sql = "INSERT INTO programmes (titre, duree, `Date`, Ndesupport, category, technicien, notes)
                VALUES ('$titre', '$duree', '$date', '$Ndesupport', '$category', '$technicien', '$notes')";

        if (mysqli_query($conn, $sql)) {
            // Insert data into chrt table
            $chrtSql = "INSERT INTO chrt (category, percentage) VALUES ('$category', 100)";
            mysqli_query($conn, $chrtSql);

            // Redirect to index.php
            header('Location: index.php');
            exit;
        } else {
            echo 'erreur :' . mysqli_error($conn);
        }
    }
}