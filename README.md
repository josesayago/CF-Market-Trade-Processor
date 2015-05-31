Market Trade Processor
======================

This application consumes trade messages via an endpoint, processes those messages and delivers a frontend of processed information based on the consumed messages.

Message Consumption
-------------------

Expose an endpoint which can consume trade messages. Trade messages will be POST’d (assume by CurrencyFair during review) to this endpoint and will take the JSON form of:

```json
{
	"userId": "134256", 
	"currencyFrom": "EUR", 
	"currencyTo": "GBP", 
	"amountSell": 1000, 
	"amountBuy": 747.10, 
	"rate": 0.7471, 
	"timePlaced" : "24-JAN-15 10:27:44", 
	"originatingCountry" : "FR"
}
```

Message Processor
-----------------

Process messages received via the message consumption endpoint. Depending on what you wish to do, these messages can be processed in different ways.

Message Frontend
----------------

Render the data from the output of the other two components.

Technology
----------
- Charts using [C3.js](http://c3js.org/)
- PHP +5.4 OOP
- CSS3
- HTML5
- jQuery 1.11.2
- [Slim Framework](http://www.slimframework.com/)
- [Composer](https://getcomposer.org/)