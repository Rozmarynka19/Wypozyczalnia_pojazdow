<?php

   if(!empty($_POST)) {
        session_start();
       $name = trim($_POST['name']);   //trim - obcina biale znaki
       $surname = trim($_POST['surname']);  
       $phone_number = trim($_POST['phone']);  
       $car_id=$_POST['car'];
       $termin = $_POST['date'];
       $days = $_POST['days'];
       $hours = $_POST['hours'];
       $login = $_SESSION['nick_show'];

       foreach($_POST as $p){
           if($p == ''){
               die('uzupelnij pole!');
           }
       }
       $today = date('Y-m-d');
       $end_date = date('Y-m-d', strtotime($today.' + 13 days'));
       if($termin < $today || $termin > $end_date){
           die("Niepoprawna data");
       }

       require('functions.php');
       reserve($name,$surname,$phone_number,$car_id,$termin,$days,$hours,$login);

    }
?>