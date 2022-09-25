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
}