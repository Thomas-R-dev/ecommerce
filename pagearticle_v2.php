<?php

// On affiche l'article par rapport à l'ID (reference) de la table produits
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($id) and is_numeric($id)) {
        $req1 = $pdo->prepare("SELECT * FROM produits WHERE reference = :id") or die(print_r($pdo->errorInfo()));
        $req1->bindValue(':id', $id, PDO::PARAM_STR);
        $req1->execute();

        while ($data = $req1->fetch()) {
            $titlepage = $data['titre'];
            var_dump($data);
        }
    }
} else {
?>
    <script>
        window.location.href = "index.php";
    </script>
<?php
}
