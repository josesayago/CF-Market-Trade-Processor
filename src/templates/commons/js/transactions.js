jQuery(document).ready(function() {
	/**
	 * Plot amounts sold
	 */
	jQuery('.amountSell').on('click', function(){
		/**
		 * Send an AJAX request on click
		 * 
		 * This basically sends users' IDs to the processor
		 * to extract transactions made, then pass it
		 * to C3 in order to generate a chart from JSON data.
		 */
		jQuery.ajax({
			url: 'amountSell',
			type: 'POST',
			dataType: 'html',
			data: 'id='+jQuery(this).attr('data-id'),
			success: function(response) {
				var chart = c3.generate({
				    bindto: '#transactions',
				    data: {
				    	type: 'area-spline',
						columns: [
							JSON.parse(response)
						]
				    }
				});
			}
		});
	});
	/**
	 * Run Simulation Data
	 */
	jQuery('.sim').on('click', function(e) {
		// Prevent default link behavior
		e.preventDefault();
		/**
		 * Simulation Data
		 */
		transactions = [];
		sell = [1000,2000,4000,8000,3000,5000];
		rates = [0.7471,0.8410,1.420,0.6589];
		month = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
		// Create 50 users
		for(i=1; i<=50; i++) {
			for(x=1; x<=2; x++) {
				// Set random amount
				amountSell = sell[Math.floor(sell.length * Math.random())];
				rate = 0.7471;
				// Calculated amount in a different currency
				amountBuy = amountSell * rate;
				transactions.push({
					"userId": i, 
					"currencyFrom": "EUR", 
					"currencyTo": "GBP", 
					"amountSell": amountSell, 
					"amountBuy": amountBuy,
					"rate": rate,
					"timePlaced" : x+"-"+month[Math.floor(month.length * Math.random())]+"-15 10:27:44", 
					"originatingCountry" : "FR"
				});
			}
		}
		/**
		 * Store Data
		 */
		jQuery.ajax({
			url: 'new',
			type: 'POST',
			dataType: 'json',
			data: JSON.stringify(transactions),
			beforeSend: function(jqXHR, settings) {
				/**
				 * When running simulation data
				 * send one of the allowed API keys
				 */
				jqXHR.setRequestHeader('X-Requested-With', '61A255AA315334996F346F8C9CE64');
			},
			success: function(response){
				if (response === true) {
					// Write a message
					jQuery('#message').html('<h1>Data Saved.</h1><p>See <a href="transactions">Transactions</a></p>');
				}
			}
		});
	});
});