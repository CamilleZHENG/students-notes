<?php


include 'utilities.php';

if(array_key_exists('idEleve',$_GET)){

  $idEleve = intval($_GET['idEleve']);
  //var_dump($idEleve);

  $sql = '
        SELECT
              nom,
              prenom
        FROM
              eleves
        WHERE
              id = ?
        ';
  $query = $pdo -> prepare($sql);
  $query -> execute([$idEleve]);
  $eleve = $query -> fetch(PDO::FETCH_ASSOC);
  //var_dump($eleve);


  $sql = '
        SELECT
              value,
              libelle
        FROM
              notes
        INNER JOIN
              matieres
        ON
              matieres.id = notes.id_matiere
        WHERE
              id_eleve = ?
        ';
  $query = $pdo -> prepare($sql);
  $query -> execute([$idEleve]);
  $all_notes = $query -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($all_notes);


  $sql = '
        SELECT
              libelle,
              AVG(value) AS moyenne
        FROM
              notes
        INNER JOIN
              matieres
        ON
              matieres.id = notes.id_matiere
        INNER JOIN
              eleves
        ON
              eleves.id = notes.id_eleve
        WHERE
              id_eleve = ?
        GROUP BY
              id_matiere
        ';
  $query = $pdo -> prepare($sql);
  $query -> execute([$idEleve]);
  $all_moyennes = $query -> fetchAll(PDO::FETCH_ASSOC);

  $sum = 0;
  $error_message;
  foreach ($all_moyennes as $value) {
      $sum += $value['moyenne'];
  }
  if(count($all_moyennes) === 0){
    $error_message = 'Aucune note enregistrée.';
  }
  else {
    $general_moyen = $sum / count($all_moyennes);
  }


  //var_dump($all_moyennes, $sum, $general_moyen);

}


include 'eleve.phtml';
