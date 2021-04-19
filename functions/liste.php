<?php
require_once("classes.php");
session_start();
require_once("variables.php");

if (isset($_GET['term'])) {
    $return_arr = array();
    try {
        $stmt = $pdo->prepare('SELECT * FROM produits WHERE titre LIKE :term ORDER BY titre ASC LIMIT 15');
        $stmt->execute(array(
            'term' => '%' . $_GET['term'] . '%'
        ));

        while ($row = $stmt->fetch()) {
            $return_arr[] = array(
                'value' => $row['reference'],
                'label' => $row['titre']
            );
        }
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    echo json_encode($return_arr);
}
