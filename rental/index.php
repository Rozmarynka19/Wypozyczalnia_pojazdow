<?php
require('admin/functions.php');
?>
<!doctype html>
<html lang="pl">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
  <link rel="shortcut icon" href="assets/icon.png" type="image/x-icon">
    
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/795f4f2a8f.js" crossorigin="anonymous"></script>
  <title>VRENT</title>
</head>

<body>
  <!-- header -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark pl-4 ">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item pr-3">
            <a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item pr-3">
            <a class="nav-link" onclick="smoothScroll('#available')">DOSTĘPNE AUTA</a>
          </li>
          <li class="nav-item pr-3">
            <a class="nav-link" onclick="smoothScroll('#unavailable')">OBECNIE ZAREZERWOWANE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="smoothScroll('#reservation')">ZAREZERWUJ</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container h-75 d-flex align-items-center">
      <div class="row">
        <div class="col-12">
          <h1 class="text-white font-weight-bold">WYPOŻYCZALNIA SAMOCHODÓW</h1>
        </div>
        <div class="col-12">
          <div class="row mt-5 d-flex">
            <button class="col-lg-3 col-md-6 col-sm-12 m-4 font-weight-bold" onclick="smoothScroll('#available')">OFERTA</button>
            <button class="col-lg-3 col-md-6 col-sm-12 m-4 font-weight-bold" onclick="smoothScroll('#reservation')">REZERWUJ</button>

            </button>
          </div>
        </div>
      </div>

    </div>

  </header>
  <!-- header -->
  <!--available-->

  <section id="available">
    <div class="container-fluid bg-primary p-5">
      <div class="row">
        <div class="col-12">
          <h1 class="text-center pt-4 pb-4">DOSTĘPNE SAMOCHODY</h1>
        </div>
      </div>
      <div class="row d-flex justify-content-center">

        

        <?php
          $rows = get_cars('available');
          foreach($rows as $r){
            echo '<div class="col-lg-3 col-md-6 col-sm-12 mt-3">';
            echo '<div class="card">';
            echo '<img src="assets/'.$r['photo_url'].'"class="card-img-top" alt="car">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title text-center">'.$r['name'].'</h5>';
            echo '<p class="text-center">'.$r['type'].'</p>';
            echo '<p class="text-center font-weight-bold">'.$r['price'].' zł / h</p>';
            echo '<button class="btn btn-primary col-12" onclick="reserve('.$r['id'].');calculate_price('.$r['price'].');">REZERWUJ</button>';
            echo'</div>';
            echo'</div>';
            echo'</div>';
          }
        ?>
        
      </div>
    </div>
  </section>

  <!--available-->
  <!--unavailable-->
  <section id="unavailable">
    <div class="container-fluid bg-primary pt-4 pb-4">
      <div class="row">
        <div class="col-12">
          <h1 class="text-center pt-4 pb-4">OBECNIE ZAREZERWOWANE</h1>
        </div>
      </div>
      <div class="row d-flex justify-content-center">

       
        <?php
          $rows = get_cars('unavailable');
          foreach($rows as $r){
            echo '<div class="col-lg-3 col-md-6 col-sm-12 mt-3">';
              echo '<div class="card">';
                echo '<img src="assets/'.$r['photo_url'].'"class="card-img-top img-fluid img-thumbnail" alt="car">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-center">'.$r['name'].'</h5>';
                echo '<p class="text-center">'.$r['type'].'</p>';
                echo '<p class="text-center font-weight-bold">'.$r['price'].' zł / h</p>';
                echo '<button class="btn btn-danger col-12" disabled onclick="reserve('.$r['id'].')">DOSTĘPNY OD '.substr($r['to_date'],0,-3).'</button>';
                echo'</div>';
              echo'</div>';
            echo'</div>';
          }
        ?>  


      </div>
    </div>
  </section>
  <!--unavailable-->

  <!--reservation form-->
  <section id="reservation">
    <div class="container-fluid">
      <h1 class="text-center p-5 m-0 font-weight-bold">ZAREZERWUJ</h1>
      <div class="row">
        <div class="col-12 text-center text-danger">
          <h2><span id="amount">0</span> zł</h2>
        </div>
        <div class="col-12 d-flex justify-content-center p-5 text-white">
          <form action="admin/reserve.php" method="POST">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="name">Imię</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Podaj imie" Required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="surname">Nazwisko</label>
                  <input type="text" class="form-control" name="surname" id="surname" placeholder="Podaj nazwisko" Required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="phone">Telefon</label>
              <input type="tel" class="form-control" name="phone" placeholder="Podaj numer telefonu" Required>
            </div>
            <div class="form-group">
              <label for="car"Samochód>Pojazd</label>
              <select name="car" class="form-control" id="car" Required >
                <?php
                  $rows = get_cars('select');

                  foreach($rows as $r){
                    echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
                  }
                ?>

              </select>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="date">Termin</label>
                  <input type="datetime-local" class="form-control" name="date" id="date"  Required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="days"> Dni </label>
                      <input type="number" class="form-control" name="days" id="days" min="0" max="13">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="hours"> Godziny </label>
                      <input type="number" class="form-control" name="hours" id="hours" min="0" max="23">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
                <div class="row">
                  <input type="submit" value="REZERWUJ" class="btn btn-danger col-12">
                </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </section>
  <button id="up-button" onclick="smoothScroll('header')"></button>

  <!--reservation form-->

  <!--<footer class="page-footer font-small p-0">
    <div class="container">
      <div class="row">
        <div class="col-12">
           <div class="d-flex justify-content-center p-2">
              
                  <a href="#">
                  <i class="fab fa-facebook p-2 fa-3x text-primary"></i>
                  </a>
              
              
                  <a href="#">
                  <i class="fab fa-twitter p-2 fa-3x text-primary"></i>
                  </a>
              
              
                  <a href="#">
                  <i class="fab fa-instagram p-2 fa-3x text-primary"></i>
                  </a>
             
              
                  <a href="#">
                  <i class="fab fa-linkedin p-2 fa-3x text-primary"></i>
                  </a>
             
           </div>
        </div>
      </div>
      <div class="footer-copyright text-center font-weight-bold p-2">
             Copyright: ZUT PROJECT
      </div>

    </div>
  </footer>



  <!-- Optional JavaScript -->
  <script src="js/myScript.js"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src=" https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>