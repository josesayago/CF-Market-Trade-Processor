<?php
/**
 * Processor
 */
// Set default timezone
date_default_timezone_set('America/Caracas');
class Processor
{
	/**
	 * Store
	 *
	 * Stores JSON data in database (file in this case)
	 *
	 * @return string true/false
	 */ 
	public function store()
	{
		// Get Key (basic authentication for testing purposes)
		$key = htmlspecialchars($_SERVER['HTTP_X_REQUESTED_WITH']);
		if (empty($key)) return 'false';
		// Check if key is within valid keys
		if (static::validKey($key)) {
			// Set filename
			$filename = 'data/transactions-'.date('d-H-m-s').'.json';
			// Get posted JSON data
			$data = file_get_contents('php://input');
			// Check if data is a valid JSON object
			if( static::isJSON($data) ) {
				// Write data
				$file = file_put_contents($filename, $data);
				if ($file !== false) {
					echo 'true';
				} else {
					echo 'false';
				}
			}
		} else {
			echo 'false';
		}
	}

	/**
	 * Amount Sell
	 *
	 * Get amounts sold by user ID
	 *
	 * @var $userId Post'ed user ID
	 * @return $tmp JSON object
	 */
	public function amountSell()
	{
		// Get user ID
		$userId = (int)$_POST['id'];
		$el = array();
		$tmp = array();
		// Browse JSON files
		foreach(array_filter( glob('data/*.json'), 'is_file') as $filename) {
			// Get data
			$data = file_get_contents($filename);
			if ($data !== false) {
				// Decode JSON objects
				$json = json_decode($data);
				// Set user ID
				$el[] = 'User ID: '.$userId;
				// Loop through object
				foreach( $json as $obj ) {
					// If user ID matches object's user ID
					if ($obj->userId == $userId) {
						if (!empty($obj->amountSell)) {
							// Keep amount
							$el[] = $obj->amountSell;
						}
					}
				}
			} else {
				echo 'false';
			}
		}
		// Remove duplicate User ID from array, formatting proper JSON object for C3 library
		foreach($el as $val){
			// Remove element if matches "User ID:" string
			if( preg_match('/User ID:/', $val) ) {
				if( !in_array($val, $tmp) ) {
					$tmp[] = $val;
				}
			} else {
				$tmp[] = $val;
			}
		}
		// Print JSON encoded object
		echo json_encode($tmp);
	}

	/**
	 * Get Users
	 *
	 * Get User IDs from JSON files
	 * @return $el array users IDs
	 */
	public function getUsers()
	{
		$el = array();
		// Get all JSON files in data directory
		foreach(array_filter( glob('data/*.json'), 'is_file') as $filename) {
			// Read content
			$data = file_get_contents($filename);
			if ($data !== false) {
				// Decode JSON objects
				$json = json_decode($data);
				foreach( $json as $obj ) {
					// Get users' ID only
					if ( !in_array($obj->userId, $el) ) {
						$el[] = $obj->userId;
					}
				}
			} else {
				return false;
			}
		}
		// Return non-duplicated users' ID
		return array_unique($el);
	}

	/**
	 * isJSON
	 *
	 * Verifies if sent data is a valid JSON object
	 *
	 * @param $object JSON Object
	 * @return bool
	 */
	private function isJSON($object)
	{
		if (is_string($object) &&
			is_object(json_decode($object)) ||
			is_array(json_decode($object))
		) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Valid Key
	 *
	 * Check API key validity
	 * 
	 * This is just for testing purposes,
	 * it is recommended to set oAuth or more robust
	 * API authentication.
	 *
	 * @param $key string
	 * @return bool
	 */
	private function validKey($key)
	{
		$validKeys = array('61A255AA315334996F346F8C9CE64', 'DEBF4B91133BAEBAFFC52714EF3F6', 'C1AEA99F573E7DD54F7871B218E58', 'C5E87BF13FBC3B199E766E35AA592');
		if (in_array($key, $validKeys)) {
			return true;
		} else {
			return false;
		}
	}
}