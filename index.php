<?php
/**
 * Market Trade Processor
 *
 * Description: This application consumes trade messages via an endpoint, processes those messages and delivers a frontend of processed information based on the consumed messages.
 * Version: 0.1
 * Author: Jose SAYAGO
 */
require_once 'vendor/autoload.php';
require_once 'src/processor.php';

$mtp = new \Slim\Slim(array(
	'templates.path' => './src/templates'
));

$mtp->get('/', function() use ($mtp) {
	$mtp->render('home.php');
});

$mtp->get('/transactions', function() use ($mtp) {
	$mtp->render('transactions.php');
});

$mtp->post('/amountSell', function() use ($mtp) {
	Processor::amountSell();
});

$mtp->get('/get/:customer', function ($customer) {
	Processor::dashboard($customer);
});

$mtp->post('/new', function() {
	Processor::store();
});

$mtp->run();