<?php
    require '.\vendor\autoload.php';

    $redis = new Predis\Client();
    
    $userdata = $_POST;

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'guvi';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if ( mysqli_connect_errno() ) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    $result = array("message" => "");
    $stmt = $con->prepare('SELECT id, password FROM user WHERE email = ? and password = ?');
    if ($stmt) {
        $stmt->bind_param('ss', $userdata['email'], $userdata['password']);

        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $token = base64_encode( $userdata["email"] );
            $value = $userdata["email"];

            $redis->set($token, $value);
            $redis->expire($token, (60 * 60));
            
            $result['message'] = "Logged In Successfully" ;
            $result['token'] = $token;

            echo json_encode($result);
        }
        else{
            echo "Incorrect Email or Password" ;
        }

        $stmt->close();
    }
?>