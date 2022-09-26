<?php
/**	
 * Class that creates, deletes and display services
 */

class Service {
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }



	/**
	 * Create a new service
     * 
     * It uses the $_POST information submitted
	 *
	 * @return string						Display a message that operation was successful
	 */

    public function add() {
        $insert = $this->db->set(
            'services',
            array(
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'cost' => $_POST['cost'],
            )
        );

        if($insert){
            echo '<div class="message-success">Serviço incluído com sucesso</div>';
        }
    }



	/**
	 * Delete specific service
	 *
	 * @param int $id             			The id of the service
	 * @return string						Display a message that operation was successful
	 */

    public function delete($id) {
        $delete = $this->db->delete("services", $_GET['delete']);

        if($delete){
            echo '<div class="message-success">Serviço removido com sucesso</div>';
        }
    }



    /**
	 * Gets specific service from database
	 *
	 * @param int $id           			The id of the service
     * 
	 * @return object						The object either empty or with data
     *                                      from that service
	 */

    public function get($id) {
        if(!empty($id)) {
            $service = $this->db->get(
                "SELECT *
                FROM services
                WHERE id = :id",
                array(':id' => $_GET['id']),
                1
            );

            return $service;

        } else {
            return (object)['id' => NULL, 'name' => NULL, 'price' => NULL, 'cost' => NULL];
        }
    }



	/**
	 * List every service
	 */

    public function list() {
        $services = $this->db->get("SELECT * FROM services");

        if($services) {
            echo '<ul class="list">';
            foreach ($services as $service) {
                $trip_cost = Helper::trip_cost(10);
                $profit = Helper::profit_margin($service->id, $trip_cost);
                echo <<<EOF
                <li>
                    <p>
                        <a href="?services&id={$service->id}">{$service->name} - R$ {$service->price} ({$profit})</a>
                        <a href="?services&delete={$service->id}">Apagar</a>
                    </p>
                </li>
                EOF;
            }
            echo '</ul>';
        }
    }
}