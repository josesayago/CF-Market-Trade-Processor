<?php
/**
 * Market Trade Processor Home Page
 */
// Set default timezone
date_default_timezone_set('America/Caracas');

include_once 'commons/header.php';


$html = '<a href="#" class="sim">Simulation</a>';

$html.= '<div id="message"></div>';

print $html;

include_once 'commons/footer.php';