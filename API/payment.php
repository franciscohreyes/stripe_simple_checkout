<?php
include 'config.php';
include 'utilities.php';

if(count($_POST)>0){
    switch($_POST['type']){
        case "charge":
            try {
                /* get card token */
                $get_token = generateToken($_POST['number'], $_POST['exp_month'], $_POST['exp_year'], $_POST['cvv']);
                
                if($get_token){
                    /* Create a charge */
                    $charge = $stripe->charges->create([
                        'amount' => (($_POST['amount'])*100),
                        'currency' => 'mxn',
                        'source' => $get_token,
                        'description' => 'My First Test Charge (created for API docs)',
                    ]);

                    if($charge){
                        echo json_encode(array("success" => true, "msg" => "Payment successfully"), 201);
                    } else {
                        echo json_encode(array("success" => false, "msg" => $charge, "token" => ""), 200);
                    }
                } else {
                    echo json_encode(array("success" => false, "token" => "Token required"), 200);
                }
        } catch (Exception $e) {
            echo json_encode(array("success" => false, "msg" => $e->getMessage()), 200);
        }
        break;
    }
} else {
    echo "Param required";
}

?>