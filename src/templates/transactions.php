<?php
/**
 * Market Trade Processor Home Page
 */
// Set default timezone
date_default_timezone_set('America/Caracas');

include_once 'commons/header.php';

$html = '';

// Get list of users
$users = Processor::getUsers();

$html.= '<h2>Amounts Sold by User</h2>';

$html.= '<ul class="users">';
foreach( $users as $id ) {
	$html.= '<li><a href="#" class="amountSell" data-id="'.$id.'" data-date="'.date('d-Y').'">User '.$id.'</a></li>';
}
$html.= '</ul>';

$html.= '<div id="transactions"></div>';

print $html;

include_once 'commons/footer.php';