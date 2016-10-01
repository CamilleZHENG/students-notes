<?php

  $pdo = new PDO('mysql:host=localhost;dbname=cours','root','');

  $pdo -> exec('SET NAMES UTF8');

  //var_dump($pdo);


  $sql = '
            SELECT
                  id,
                  prenom,
                  nom
            FROM
                  eleves
        ';

  $query = $pdo -> prepare($sql);
  $query -> execute();
  $eleves = $query -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($eleves);

  $sql ='
        SELECT
              id,
              libelle
        FROM
              matieres
        ';
  $query = $pdo -> prepare($sql);
  $query -> execute();
  $matieres = $query -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($matieres);


  function selected($value_in_form, $value_getted){
    if ($value_in_form === $value_getted) {
      return 'selected';
    }
    else {
      return '';
    }
  }

  $sql ='
        SELECT
              id_eleve,
              id_matiere
        FROM
              notes
        ';
  $query = $pdo -> prepare($sql);
  $query -> execute();
  $notes = $query -> fetchAll(PDO::FETCH_ASSOC);
  //var_dump($notes);

  $id_lastEleve = end($notes)['id_eleve'];
  $id_lastMatiere = end($notes)['id_matiere'];
  //var_dump($id_lastEleve,$id_lastMatiere);
