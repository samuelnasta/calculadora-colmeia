<?php
/**	
 * Class to control the settings:
 * 
 * - Profit margin
 * - Fuel consumption
 * - Fuel price
 * - Cost per acquisition (CPA ads)
 * 
 * The calculations methods are in helper abstract class
 */


class Settings {
    private $db;
    
    public function __construct() {
        $this->db = new DB();
    }



	/**
	 * Changes the settings
     * 
     * It uses the $_POST information submitted
	 *
	 * @return string						Display a message that operation was successful
	 */

    public function change() {
        $delete = $this->db->get('DELETE FROM settings');

        $insert = $this->db->set(
            'settings',
            array(
                'profit_margin' => $_POST['profit-margin'],
                'fuel_consumption' => $_POST['fuel-consumption'],
                'fuel_price' => $_POST['fuel-price'],
                'cost_per_acquisition' => $_POST['cost-per-acquisition'],
            )
        );

        if($insert){
            echo '<div class="message-success">Configurações salvas</div>';
        }
    }



    /**
	 * Gets specific settings from database
     * 
	 * @return object						The object either empty or with data
     *                                      from settings
	 */

    public function get() {
        $settings = $this->db->get("SELECT * FROM settings", NULL, 1);

        if(empty($settings)) {
            $settings = (object)['id' => NULL, 'name' => NULL, 'price' => NULL, 'cost' => NULL];
        }

        return $settings;
    }
}