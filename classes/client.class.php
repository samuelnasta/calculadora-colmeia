<?php
/**	
 * Class that creates and deletes users to begin the order
 */

class Client {
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }



	/**
	 * Create a new client
     * 
     * It uses the $_POST information submitted
	 *
	 * @return string						Display a message that operation was successful
	 */

    public function add() {
        $insert = $this->db->set(
            'clients',
            array(
                'name' => $_POST['name'],
                'zipcode' => $_POST['zipcode'],
                'address' => $_POST['address'],
                'number' => $_POST['number'],
                'neighborhood' => $_POST['neighborhood'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
                'cpf_cnpj' => $_POST['cpf_cnpj'],
            )
        );

        if($insert){
            echo '<div class="message-success">Cliente incluído com sucesso</div>';
        }
    }



	/**
	 * Delete specific client
	 *
	 * @param int $id             			The id of the client
	 * @return string						Display a message that operation was successful
	 */

    public function delete($id) {
        $delete = $this->db->delete("clients", $id);

        if($delete){
            echo '<div class="message-success">Cliente removido com sucesso</div>';
        }
    }



    /**
	 * Gets specific client from database
	 *
	 * @param int $id           			The id of the client
     * 
	 * @return object						The object either empty or with data
     *                                      from that client
	 */

    public function get($id) {
        if(!empty($id)) {
            $client = $this->db->get(
                "SELECT *
                FROM clients
                WHERE id = :id",
                array(':id' => $id),
                1
            );

            return $client;
        }
        else {
            return (object)['id' => NULL, 'name' => NULL, 'zipcode' => NULL, 'address' => NULL, 'number' => NULL, 'neighborhood' => NULL, 'city' => NULL, 'state' => NULL, 'cpf_cnpj' => NULL];
        }
    }



	/**
	 * List every client
	 */

    public function list() {
        $clients = $this->db->get("SELECT * FROM clients");

        if($clients) {
            echo '<ul class="list">';
            foreach ($clients as $client) {
                echo <<<EOF
                <li>
                    <p>
                        <a href="?clients&id={$client->id}">{$client->name}</a>
                        <a href="?clients&delete={$client->id}" class="delete">Apagar</a>
                    </p>
                </li>
                EOF;
            }
            echo '</ul>';
        }
    }
}