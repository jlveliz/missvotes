<?php

	return [
		'tab_name' => "Tickets de Rifa",
		'my_tickets' => 'Mis Tickets',
		'tickets_not_found' => 'Lamentamos que no tenga tickets para usar, compre uno para poder apoyar a su candidata favorita',
		'tittle_raffle' => '¡GRAN RIFA GANADORA!',
		'tickets_not_found_query' =>'Ticket :param no encontrado',
		'search_form' => [
			'label' => 'Buscar',
			'input' => 'Inserte un ticket',
			'button' => 'Ir'
		],
		'policies' => [
			'title'=>'Politicas del concurso',
			'policy_1' => 'Cada número de rifa vale $5 dólares.',
			'policy_2'=>'Por cada rifa comprada participas para el sorteo de un viaje de 4 días 3 noches a Los Ángeles, California para dos personas con desayuno incluido, transporte Aeropuerto-Hotel, Hotel-Aeropuerto, recogida en el hotel para asistir a la noche final de la elección de la Miss Panamerican International 2018 con entrada VIP. ',
			'policy_3'=>'En caso de no poseer visa americana, el premio del sorteo será un viaje de 4 días 3 noches con desayuno incluido, transporte Aeropuerto-Hotel, Hotel-Aeropuerto en el país ganador de la Miss Panamerican International 2017, teniendo como Host a la reina panamericana de ese año (2018).',
			'policy_4'=>'Por cada ticket adquirido, adquiere 5 puntos para dárselos a tu candidata favorita, ayudándola a subir en el ranking de posición de votación virtual. Recordemos que la candidata con más votación virtual, pasará automáticamente al top 12.',
			'policy_5'=>'Por ultimo y no siendo el menos importante, una parte del valor recaudado será para la fundación asociada, la cual estaremos ayudando este año.',
			'note'=>'Nota: Si el/la ganador(a) del sorteo, no posee visa americana y es del mismo país que la nueva Miss Panamerican Int. 2017, el viaje de premio será al país de nuestra virreina panamericana 2017.  (2018) 
			Los trámites de visa u otros,  para ingresar al país destino del sorteo corren por cuenta de los ganadores.'
		],
		'add_cart'=>'Añadir al carrito',
		'delete_cart'=>'Eliminar del carrito',
		'no_ticket_selected' => 'No existe un ticket Seleccionado. Añada tickets a su carrito',
		'shopping_cart_title'=>'Carrito de compras',
		'buy_ticket_button'=>'Comprar',
		'cant_insert_same_number'=>'No puede ingresar dos veces el mismo número',
		'signals' => [
			'reserved' => 'Reservado',
			'selected' => 'Sus Tickets',
			'available' => 'Disponible',
		],
		'raffle_paypal' => [
			'item_description' => 'Ticket # :numRiffle  por :val puntos',
			'transaction_description' => 'Compra de tickets para ' .config('app.name'),
		],
		'validations'=>[
 			'exist' => 'The ticket :ticket le pertenece a otro usuario',
		],
	];