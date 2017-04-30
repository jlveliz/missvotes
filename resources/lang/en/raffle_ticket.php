<?php

	return [
		'tab_name' => "Ticket's Raffle",
		'my_tickets' => 'My Tickets',
		'tickets_not_found' => 'We regret that you do not have tickets to use, buy one to support your favorite candidate',
		'tittle_raffle' => 'GREAT RIFF WINNER!',
		'tickets_not_found_query' =>'Ticket :param not found',
		'search_form' => [
			'label' => 'Search',
			'input' => 'Insert a ticket',
			'button' => 'Go'
		],
		'policies' => [
			'title'=>'Competition policy',
			'policy_1' => 'Each raffle number is worth $ 5 dollars.',
			'policy_2'=>'For each raffle you buy for a 4-day 3-night trip to Los Angeles, California for two people including breakfast, Airport-Hotel, Hotel-Airport transportation, pick-up at the hotel to attend the final night of the election Of the Miss Panamerican International 2018 with VIP entrance. ',
			'policy_3'=>'In case of no American visa, the prize of the draw will be a trip of 4 days 3 nights with breakfast included, transportation Airport-Hotel, Hotel-Airport in the winning country of the Miss Panamerican International 2017, having as host to the Pan American queen Of that year (2018).',
			'policy_4'=>'For each ticket purchased, acquire 5 points to give to your favorite candidate, helping her to climb the ranking of virtual voting position. Remember that the candidate with more virtual voting, will automatically go to the top 12.',
			'policy_5'=>'Last but not least, part of the amount raised will be for the associated foundation, which we will be helping this year.',
			'note'=>'Note: If the winner of the draw does not have an American visa and is from the same country as the new Miss Panamerican Int. 2017, the prize trip will be to the country of our 2017 Pan American viceroy. (2018)
Visa or other procedures, to enter the destination country of the lottery are run by the winners.'
		],
		'add_cart'=>'Add to Cart',
		'delete_cart'=>'Delete from cart',
		'no_ticket_selected' => 'There is no ticket selected. Add tickets to your cart',
		'shopping_cart_title'=>'Shopping Cart',
		'buy_ticket_button'=>'Buy',
		'cant_insert_same_number'=>'You can not enter the same number twice',
		'signals' => [
			'reserved' => 'Reserved',
			'selected' => 'Your Tickets',
			'available' => 'Available',
		],
		'raffle_paypal' => [
			'item_description' => 'Ticket # :numRiffle  for :val points',
			'transaction_description' => 'Buy of Ticket for ' .config('app.name'),
		],

		'validations'=>[
 			'exist' => 'The ticket :ticket belongs to another user',
		],
	];