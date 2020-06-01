<?php
session_start();
require('functions.php');
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] !== true){
  die("dostep zabroniony");
}

?>

<!doctype html>
<html lang="pl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Dashboard</title>
  </head>
  <body>
    <div class="container mt-5">
  <?php
        echo '<h2 class="text-center font-weight-bold ">PANEL UŻYTKOWNIKA: '.$_SESSION['nick_show'].'</h2>';
        ?>
        </div>
    <div class="col-12">
    <div class="text-center pt-2">
            <a href="../index_logged.php" class="m-2">POWRÓT</a> | <a href="logout.php" class="m-2">WYLOGUJ</a>
        </div>
        <h1 class="text-center font-weight-bold p-5">AKTUALNE REZERWACJE</h1>
        
    </div>

    <div class="container mt-5">
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Samochód</th>
                    <th scope="col">Konto użytkownika</th>
                    <th scope="col">Wypożyczył</th>
                    <th scope="col">Koszt</th>
                    <th scope="col">Zwrot</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <?php
                    $rows = generate_dashboard();

                    for($i=0;$i<count($rows);$i++){
                      echo '<tr>';
                      echo '<th scope="row">'.($i+1).'</th>';
                      echo '<td>'.$rows[$i]['name'].'</td>';
                      echo '<td>'.$rows[$i]['nick_login'].'</td>';
                      echo '<td>'.$rows[$i]['names'].' '.$rows[$i]['surname'].'</td>';
                      echo '<td>'.$rows[$i]['price'].'</td>';
                      echo '<td>'.$rows[$i]['to_date'].'</td>';
                      echo '</tr>';
                    }
                    
                  ?>
                </tbody>
              </table>
            
        </div>
    </div>





    <div class="col-12">
        <h1 class="text-center font-weight-bold p-5">HISTORIA REZERWACJI</h1>
        
    </div>

    <div class="container mt-5">
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Samochód</th>
                    <th scope="col">Konto użytkownika</th>
                    <th scope="col">Wypożyczył</th>
                    <th scope="col">Koszt</th>
                    <th scope="col">Zwrot</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <?php
                    $rows = generate_dashboard_old();

                    for($i=0;$i<count($rows);$i++){
                      echo '<tr>';
                      echo '<th scope="row">'.($i+1).'</th>';
                      echo '<td>'.$rows[$i]['name'].'</td>';
                      echo '<td>'.$rows[$i]['nick_login'].'</td>';
                      echo '<td>'.$rows[$i]['names'].' '.$rows[$i]['surname'].'</td>';
                      echo '<td>'.$rows[$i]['price'].'</td>';
                      echo '<td>'.$rows[$i]['to_date'].'</td>';
                      echo '</tr>';
                    }
                    
                  ?>
                </tbody>
              </table>
            
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>