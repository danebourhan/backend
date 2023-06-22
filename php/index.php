<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">

<?php

include './includes/head.inc.html';
include './includes/header.inc.html';

?>


<body>

  <div class="container-fluid">
    <div class="row">

      <nav class="col-md-3">
        <a href="index.php"><button role="button" class="btn btn-outline-secondary">Home</button></a>

        <!-- Si la session est défini alors j'include ma liste -->
        <?php
        if (isset($_SESSION['data'])) {
          include_once './includes/ul.inc.php';
        }
        ?>
      </nav>

      <section class="col-md-9">


        <?php
        // Si l'url add est défini alors j'include le form
        if (isset($_GET['add'])) {
          include_once './includes/form.inc.html';
        } 


        // si la données submit est défini alors je traite les données de mon formulaire
        elseif (isset($_POST['submit'])) {

        //   Création d'un tableau ou je stock les données de mon formulaire
          $table = [
            // 
            'first-name' => $_POST['first-name'],
            'last-name' => $_POST['last-name'],
            'age' => $_POST['age'],
            'size' => $_POST['size'],
            'gender' => $_POST['gender']
          ];

        //   Je stock ma variable table dans la session data
          $_SESSION['data'] = $table;

          
          echo '<h2>Vos données ont été enregistrées</h2>';
        }


        if (isset($_SESSION['data'])) {

          //DEBUGGING
          // SI L'url est debug alors j'affiche le titre, et ma balise <pre>
          if (isset($_GET['debug'])) {
            echo '<h2>Débogage</h2>';
            echo '<pre>';
            print_r($_SESSION['data']);
            echo '</pre>';

            //CONCATENATION

          } elseif (isset($_GET['concat'])) {
            echo '<h2>Concaténation</h2>';
            echo '<h4> ===> Construction d\'une phrase avec le contenu du tableau </h4>';
            echo '<p> Mlle ' . $_SESSION['data']['first-name'] . ' ' .$_SESSION['data']['last-name'] . '</p>';
            echo '<p> J\'ai ' . $_SESSION['data']['age'] . ' ' . 'ans et je mesure ' . ' ' . $_SESSION['data']['size'] . 'm.' . '</p>';
            // et je suis une $session...[gender] pour le genre

            $ucfirst = ucfirst($table['first-name']);
            $stroupper = strtoupper($table['last-name']);
            echo '<h4> ===> Construction d\'une phrase après MAJ du tableau </h4>';
            echo '<p> Mlle ' . $ucfirst . ' ' . $stroupper . '</h4>';
            echo '<p> J\'ai ' . $table['age'] . ' ' . 'ans et je mesure ' . ' ' . $table['size'] . 'm.' . '</p>';

            $size = str_replace('.', ',', $table['size']);
            echo '<h4> ===> Affichage d\'une virgule à la place d\'un point pour la taille </h4>';
            echo '<p> Mlle ' . $table['first-name'] . ' ' . $table['last-name'] . '</p>';
            echo '<p> J\'ai ' . $table['age'] . ' ' . 'ans et je mesure ' . ' ' . $size . 'm.' . '</p>';
          } elseif (isset($_GET['bouc'])) {
            echo '<h2>Boucle</h2>';
            echo '<h3> ===> Lecture du tableau à l\'aide d\'une boucle foreach </h3>';
            //var_dump($table); pour le débogage, affiche le contenu de 'data'
            $n = 0;
            foreach ($_SESSION['data'] as $key => $value)
              echo '<p> à la ligne n° ' . $n++ . ' correspond la clé ' . $key . ' et contient : ' . $value . '</p>';

            //FUNCTION

          } elseif (isset($_GET['fonc'])) {
            echo '<h2>Fonction</h2>';
            echo '<h3> ===> J\'utilise ma fonction readTable()</h3>';
            function readTable()
            {
              
              $n = 0;
              foreach ($_SESSION['data'] as $key => $value) {
                echo '<p> à la ligne n°' . $n++ . ' correspond la clé ' . ' ' . $key . ' ' . ' et contient ' . ' ' . $value . ' ' . '</p>';
              }
            }
            readTable();
          } elseif (isset($_GET['supp'])) {
            session_destroy();
            echo 'destroy';
          } else {
            echo '<a href="index.php?add"><button role="button" class="btn btn-primary">Ajouter des données</button></a>';
          }
        } else {
          echo '<a href="index.php?add"><button role="button" class="btn btn-primary">Ajouter des données</button></a>';
        }
        ?>


        <?php include './includes/footer.inc.html'; ?>
      </section>
    </div>
  </div>

</body>

</html>