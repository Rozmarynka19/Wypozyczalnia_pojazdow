<?php
    require("sql_connect.php");

    function get_cars($type){
        global $mysqli;

        if($type=="available"){
            $sql = "SELECT id,name,photo_url,type,price FROM cars WHERE available=1";
        } elseif($type == "unavailable"){
            $sql = "SELECT cars.id, cars.name,cars.photo_url,cars.price,cars.type,reservations.to_date FROM cars INNER JOIN reservations ON cars.id=reservations.car_id WHERE cars.available=0"; 
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
        $sql= "SELECT cars.name, clients.surname, reservations.price, reservations.to_date FROM reservations INNER JOIN cars ON reservations.car_id=cars.id INNER JOIN clients ON clients.id=reservations.client_id";
        
        $result = $mysqli->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }

    function reserve($name,$surname,$phone_number,$car_id,$termin,$days,$hours){

        global $mysqli;
        
        $from_date=$termin;

        $to_date = date('Y-m-d H:i',strtotime($from_date.'+ '.$days.' days + '.$hours.'hours'));

        $sql = "SELECT price FROM cars WHERE id= $car_id";

        $result = $mysqli->query($sql);
        $row = $result->fetch_row();

        $price = $row[0];

        $cost = ($days * 24 + $hours) *$price;

        $sql_2="INSERT INTO clients (`name`,`surname`,`phone_number`) VALUES (?,?,?)";

        if($statement = $mysqli->prepare($sql_2)){
            if($statement->bind_param('sss',$name,$surname,$phone_number))
                $statement->execute();
                $client_id=$mysqli->insert_id;
                
                $sql_3 = "INSERT INTO reservations (`client_id`,`car_id`,`from_date`,`to_date`,`price`) VALUES (?,?,?,?,?)";

                    if($statement_2 = $mysqli->prepare($sql_3)){
                        
                        if($statement_2->bind_param('iissi',$client_id,$car_id,$from_date,$to_date,$cost)){
                            $statement_2 -> execute();
                            $mysqli->query("UPDATE cars SET available='0' WHERE id=$car_id");
                            header("Location: ../index.php");
                        }
                    }

        }
        else{
            die('Niepoprawne zapytanie');
        }
    }
?>  