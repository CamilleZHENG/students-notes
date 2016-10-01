<?php

include 'utilities.php';


$error_message = [];

if(array_key_exists('eleve',$_POST)&&array_key_exists('matiere',$_POST)&&array_key_exists('note',$_POST)){

    if(empty($_POST['eleve'])){
      $error_message['eleve'] = 'Choisir le nom de l\'élève !';
    }
    if(empty($_POST['matiere'])){
      $error_message['matiere'] = 'Choisir le nom de matière !';
    }
    if(empty($_POST['note'])){
      if($_POST['note'] !== '0'){
        $error_message['note'] = 'Saisir la note !';
      }
    }
    if($_POST['note']<0){
      $error_message['miniNote'] = 'La note ne peut pas être négatif !';
    }
    if($_POST['note']>20){
      $error_message['maxNote'] = 'La note ne peut pas dépasser 20 !';
    }

    if (empty($error_message)) {
      $idEleve = intval($_POST['eleve']);
      $idMatiere = intval($_POST['matiere']);
      $note = trim(filter_var($_POST['note'], FILTER_SANITIZE_STRING));
      //var_dump($note);
      $note = number_format(floatval($note),2);
      //var_dump($note);

      $sql = '
            INSERT INTO
                  notes(value, id_eleve, id_matiere)
            VALUES
                  (?, ?, ?)
            ';

      $query = $pdo -> prepare($sql);
      $query -> execute([$note, $idEleve, $idMatiere]);
      $query -> fetchAll(PDO::FETCH_ASSOC);

      //header('Location:index.php');
      //equivalent à//
      header('Location:./');
    }
    /*Si utilisateur a saisi les valeurs dans le champs.
    On les stocker dans le BDD, et puis passer l'action de fichier "index.php" qui nous rédige dans homepage index.phtml
    Sinon, si utilisateur n'ont pas saisie, $error_message n'est pas vide.
    On passe directment au fichier index.phtml en gardant les valeurs gardé dans $error_message.
    */

    include 'index.phtml';


}
