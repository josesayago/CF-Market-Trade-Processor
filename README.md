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

Additional Notes
---------------
*Data* directory must have written access by system user to successfuly run this test.

Authentication must be improved, however I decided to implement a simplified (non production) version for testing purposes.

How to send the API key
-----------------------

Set a *X-Requested-With* request header with one of the following API keys:

```
61A255AA315334996F346F8C9CE64 

DEBF4B91133BAEBAFFC52714EF3F6

C1AEA99F573E7DD54F7871B218E58

C5E87BF13FBC3B199E766E35AA592
```

Posting JSON Objects
--------------------
I recommend using [Postman](https://www.getpostman.com/) to send JSON objects and passing the request header with the API key.