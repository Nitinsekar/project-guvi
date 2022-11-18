<?php
    $userdata = $_POST;

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_email = '';
    $DATABASE_password = 'guvi';

    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_email, $DATABASE_password);

    if ( mysqli_connect_errno() ) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

    $result = array("message" => "");
    $stmt = $con->prepare('SELECT id, password FROM user WHERE email = ?');
    if ($stmt) {
        $stmt->bind_param('s', $userdata['email']);

        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            echo "User Already Exists";
        }
        else{
            $insertStmt = $con->prepare('INSERT INTO user (email, password) VALUES (?, ?)');
            if ($insertStmt) {
                $insertStmt->bind_param('ss', $userdata['email'], $userdata['password']);
                if($insertStmt->execute())
                {
                    $result['message'] = " Successfully Registerd";
                    echo json_encode($result);
                }
                else{
                    echo "Error";
                }
            }
        }

        $stmt->close();
    }
    else{
        echo "Error";
    }
?>
