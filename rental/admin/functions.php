<?php
    require("sql_connect.php");
    
    
    function sort_cars($type,$type_car){
        global $mysqli;

        if($type=="available" && $type_car == NULL)
        {
            $sql = "SELECT id,name,photo_url,type,price FROM cars WHERE available=1";     
        }
        elseif($type=="available" && $type_car=='Wszystkie'){
            $sql = "SELECT id,name,photo_url,type,price FROM cars WHERE available=1";
        }
        elseif($type=="available" && $type_car=='Samochod'){
            $sql = "SELECT id,name,photo_url,type,price FROM cars WHERE available=1 AND type_cars='$type_car'";
        }
        elseif($type=="available" && $type_car=='Motocykl'){
            $sql = "SELECT id,name,photo_url,type,price FROM cars WHERE available=1 AND type_cars='$type_car'";
        }
       
       $result = $mysqli->query($sql);
       
       $rows = $result->fetch_all(MYSQLI_ASSOC);

       return $rows;
    }


    function get_cars($type){
        global $mysqli;

        if($type=="available"){
            $sql = "SELECT id,name,photo_url,type,price FROM cars WHERE available=1";
        } elseif($type == "unavailable"){
            $sql = "SELECT cars.id, cars.name,cars.photo_url,cars.price,cars.type,reservations.to_date FROM cars INNER JOIN reservations ON cars.id=reservations.car_id WHERE cars.available=0 AND reservations.to_date > NOW()"; 
        }
        elseif($type == "select"){
            $sql = "SELECT id,name,photo_url,type,price FROM cars WHERE available=1";
        }
       $result = $mysqli->query($sql);
       
       $rows = $result->fetch_all(MYSQLI_ASSOC);

       return $rows;
    }

    function generate_dashboard(){
        global $mysqli;
        $login_dash = $_SESSION['nick_show'];
        
        if($login_dash=="Admin")
        {
            $sql= "SELECT cars.name, clients.surname, reservations.price, reservations.to_date FROM reservations INNER JOIN cars ON reservations.car_id=cars.id INNER JOIN clients ON clients.id=reservations.client_id";
             
        }
        else{
        $sql= "SELECT cars.name, clients.surname, reservations.price, reservations.to_date FROM reservations INNER JOIN cars ON reservations.car_id=cars.id INNER JOIN clients ON clients.id=reservations.client_id AND reservations.login='".$login_dash."'";
        }
        $result = $mysqli->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }

    function generate_dashboard_old(){
        
        global $mysqli;
        $login_dash = $_SESSION['nick_show'];
        if($login_dash=="Admin")
        {
            $sql= "SELECT cars.name, clients.surname, reservations.price, reservations.to_date FROM reservations INNER JOIN cars ON reservations.car_id=cars.id INNER JOIN clients ON clients.id=reservations.client_id";
             
        }
        $sql= "SELECT cars.name, clients.surname, reservations_history.price, reservations_history.to_date FROM reservations_history INNER JOIN cars ON reservations_history.car_id=cars.id INNER JOIN clients ON clients.id=reservations_history.client_id AND reservations_history.login='".$login_dash."'";
        
        $result = $mysqli->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }


    function reserve($name,$surname,$phone_number,$car_id,$termin,$days,$hours,$login){

        global $mysqli;
        
        $from_date=$termin;

        $to_date = date('Y-m-d H:i',strtotime($from_date.'+ '.$days.' days + '.$hours.'hours'));

        $sql = "SELECT price, name, available FROM cars WHERE id= $car_id";

        $result = $mysqli->query($sql);
        $row = $result->fetch_row();
        
        $price = $row[0];
        $available =$row[2];

        if($available !=1){
            die('Samochód zajęty!');
        }

        $cost = ($days * 24 + $hours) *$price;

        $sql_2="INSERT INTO clients (`name`,`surname`,`phone_number`) VALUES (?,?,?)";

        if($statement = $mysqli->prepare($sql_2)){
            if($statement->bind_param('sss',$name,$surname,$phone_number))
                $statement->execute();
                $client_id=$mysqli->insert_id;
                
                $sql_3 = "INSERT INTO reservations (`client_id`,`car_id`,`from_date`,`to_date`,`price`,`login`) VALUES (?,?,?,?,?,?)";

                    if($statement_2 = $mysqli->prepare($sql_3)){
                        
                        if($statement_2->bind_param('iissis',$client_id,$car_id,$from_date,$to_date,$cost,$login)){
                            $statement_2 -> execute();
                            $mysqli->query("UPDATE cars SET available='0' WHERE id=$car_id");
                            echo 'good';
                            header("Location: ../index_logged.php");
                        }
                    }

        }
        else{
            die('Niepoprawne zapytanie');
        }
    }
?>  