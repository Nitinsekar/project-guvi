<?php

    require_once __DIR__ . '/vendor/autoload.php';
    require '.\vendor\autoload.php';

    $redis = new Predis\Client();

    $client = new MongoDB\Client('<mongoURL>');
    $collection = $client->guvi->user;

            
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $redis->get($_POST["auth_token"]);
        if($email == ""){
            echo "Please Login";
        }
        else{
            $data = array("email"=>$email, "name"=>$_POST["name"], "dob"=>$_POST["birthday"], "age"=>$_POST["age"], "address"=>$_POST["address"]);
            $collection->insertOne($data);
            $result["message"] = "Updated";
            echo json_encode($result);
        }
    }
    
?>
