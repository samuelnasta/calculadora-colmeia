<?php
/**	
 * Class that creates and deletes services providers
 */


class Services_Provider {
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }



	/**
	 * Changes the services provider
     * 
     * It uses the $_POST information submitted
	 *
	 * @return string						Display a message that operation was successful
	 */

    public function change() {
        $delete = $this->db->get('DELETE FROM services_providers');

        $insert = $this->db->set(
            'services_providers',
            array(
                'name' => $_POST['name'],
                'zipcode' => $_POST['zipcode'],
                'address' => $_POST['address'],
                'number' => $_POST['number'],
                'neighborhood' => $_POST['neighborhood'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
            )
        );

        if($insert){
            echo '<div class="message-success">Prestador de serviço incluído com sucesso</div>';
        }
    }



    /**
	 * Gets specific provider from database
     * 
	 * @return object						The object either empty or with data
     *                                      from services providers
	 */

    public function get() {
        $service_provider = $this->db->get("SELECT * FROM services_providers", NULL, 1);

        if(empty($service_provider)) {
            $service_provider = (object)['id' => NULL, 'name' => NULL, 'zipcode' => NULL, 'address' => NULL, 'number' => NULL, 'neighborhood' => NULL, 'city' => NULL, 'state' => NULL];
        }

        return $service_provider;
    }
}