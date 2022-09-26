<?php
if(isset($_GET['api'])) {
    
    header('Content-Type: application/json; charset=utf-8');
    $db = new DB();

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $insert = $db->set(
            'services',
            array(
                'name' => $_REQUEST['name'],
                'price' => $_REQUEST['price'],
                'cost' => $_REQUEST['cost'],
            )
        );

        $message = ($insert)
            ? 'Serviço incluído com sucesso'
            : 'Houve um problema ao cadastrar o serviço. Verifique os dados enviados e tente novamente.';

        print_r(json_encode(['retorno' => $message]));
        die();
    }
    else if ($_SERVER['REQUEST_METHOD'] === "GET") {
        $clients = $db->get("SELECT * FROM clients");

        if(!empty($_GET['id'])) {
            $client = $db->get(
                "SELECT *
                FROM clients
                WHERE id = :id",
                array(':id' => $_GET['id']),
                1
            );

            if($client === NULL) {
                print_r(json_encode(['erro' => 'Nenhum resultado encontrado']));
                die();
            }
        }

        $json = (!empty($client)) ? $client : $clients;
        print_r(json_encode($json));
        die();
    }
    else {
        http_response_code(405);
    }
}