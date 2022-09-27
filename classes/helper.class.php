<?php
/**	
 * Abstract class with useful functions to use
 * throughout the app
 */

class Helper {

	/**
	 * Prints dates friendly to the user
	 *
	 * Instead of displaying only numbers, it shows how long ago the item was created
	 *
	 * @param string $date_to_compare        The date string that will be transformed
	 * @return string Friendly formatted date
	 */

	public static function friendly_date(String $date_to_compare) {
		$new_date = new DateTime($date_to_compare, new DateTimeZone('America/Sao_Paulo'));
		$now = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
		$diff = $now->getTimestamp() - $new_date->getTimestamp();

		$formatted_date = $new_date->format('d/m/Y - H:i:s');
		$timestamp = strtotime($date_to_compare);
		$currentTime = time();

		$time_label_singular = array("segundo", "minuto", "hora", "dia", "mês", "ano");
		$time_label_plural = array("segundos", "minutos", "horas", "dias", "meses", "anos");
		$length = array("60","60","24","30","12","10");

		
		if($currentTime >= $timestamp) {
			// If item was created less than 5 minutes ago
			if($diff < 300) {
				$friendly_date = "Agora mesmo";
			} else {
				for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
					$diff = $diff / $length[$i];
				}
				$diff = round($diff);

				// Selects if it'll use the labels from plural or singular arrays
				$time_label = ($diff >= 2) ? $time_label_plural : $time_label_singular;

				$friendly_date = $diff . " " . $time_label[$i] . " atrás";
			}
		}

		return $friendly_date;
	}


	/**
	 * Calculates the profit margin
	 *
	 * @param int $id        				The id of the service to be calculated
	 * @param float $id        				The cost of trip
	 * @return string 						The result <span> element
	 */

	public static function profit_margin($id, $trip_cost = null) {
		$db = new DB();
		$settings = $db->get("SELECT * FROM settings", NULL, 1);
		$service = $db->get(
			"SELECT *
			FROM services
			WHERE id = :id",
			array(':id' => $id),
			1
		);

		$total_cost = $service->cost + $settings->cost_per_acquisition + $trip_cost;
		$profit_margin = ($total_cost / $service->price - 1) * -100;
		$profit_margin = round($profit_margin, 2);

		if($profit_margin < $settings->profit_margin) {
			return '<span class="loss">' . $profit_margin . '%</span>';
		} else {
			return '<span class="profit">' . $profit_margin . '%</span>';
		}
	}


	/**
	 * Calculates the cost of the trip to the client's house
	 *
	 * @param float $distance      			The distance in km between service provider
	 * 										and the client house
	 * @return string 						The final price of the trip
	 */

	public static function trip_cost($distance) {
		$db = new DB();
		$settings = $db->get("SELECT * FROM settings", NULL, 1);
		
		$trip_cost = $distance / $settings->fuel_consumption * $settings->fuel_price;
		$trip_cost = $trip_cost * 2; // Round trip
		$trip_cost = round($trip_cost, 2);

		return $trip_cost;
	}


	/**
	 * Calculates the discount for companies
	 *
	 * @param float $price      			The full price
	 * @return string						The final price with discount
	 */

	public static function pj_discount($price) {
		$discount = 10; // 10%
		$discount = 1 - $discount / 100;		
		$final_price = $price * $discount;

		return $final_price;
	}
}