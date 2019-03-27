<?php
require_once 'dbconfig.php';

// Get IDs
$boxer_id = filter_input(INPUT_POST, 'boxer_id', FILTER_VALIDATE_INT);

// Delete the boxer from the database
if ($boxer_id != false && $boxer_id != false) {
    $query = "DELETE FROM boxers
              WHERE boxerID = :boxer_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':boxer_id', $boxer_id);
    $statement->execute();
    $statement->closeCursor();
}

// display the Product List page
include('index.php');
?>