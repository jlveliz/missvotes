<?php

	return [
		'go_site' => 'Ir al sitio web',
		'exit' => 'Salir',
		// nav
		'nav' => [
			'dashboard' => 'Escritorio',
			'participants' => [
				'menu'=>'Participantes',
				'candidates'=>'Candidatas del concurso',
				'register_log' => 'Aplicantes Online',
				'precandidate' => 'Precandidatas',
			],
			'members'=> [
				'menu' => 'Subscriptores',
				'list' => 'Listado',
				'activities'=>'Actividades',
			],
			'config' => [
				'menu' => 'Configuración',
				'countries' => 'Países',
				'membership' => 'Membresías',
				'users' => 'Administradores',
				'config' => 'Casting'
			],
		],

		// dashboard
		'dashboard' => [
			'export' => 'Exportar',
			'ranking_block' => [
				'title' => 'Ranking',
				'th_candidate' => 'Candidata',
				'th_country' => 'País',
				'th_score' => 'Puntuación',
				'td_points' => 'Puntos'
			],

			'membership_block' => [
				'title' => 'Membresías',
				'th_membership' => 'Membresía',
				'th_number_user' => 'Numero de Administradores',

			],

			'tickets_block' => [
				'title' => 'Tickets',
				'th_client' => 'Comprados',
				'th_ticket' => 'Disponibles'
			],
			'casting_resume' => [
				'title_one' => 'Casting #1',
				'title_two' => 'Casting #2',
				'th_country' => 'País',
				'th_num_applies' => 'Num Aplicaciones',
				'th_num_preselected' => 'Preseleccionadas',
				'th_num_no_preselected' => 'No Preseleccionadas',
				'th_num_missing' => 'Faltante',
				'th_social_network' => 'Red Social'
			],
			'resume_country_casting' => [
				'th_country' => 'País',
				'th_social_network'=>'Red Social',
				'panel_heading' => 'Red Social más usada por país'
			]
		],

		'miss' => [
			'states' => [
				'for_evaluate' => 'Por Evaluar',
				'preselected'=>"Preseleccionada",
				'no_preselected'=>"No Preseleccionada",
				'precandiate'=>'Precandidata',
				'noprecandidate'=>"No Precandidata",
				'candidate'=>"Candidata",
				'no_candidate'=>"No Candidata"
			]
		],


		// candidates
		'candidates' => [
			'index' => [
				'panel_title' => 'Candidatas',
				'panel_caption' => 'Lista de Candidatas',
				'th_names' => 'Nombres',
				'th_code' => 'Código',
				'th_state' => 'Estado',
				'th_date'=>'Fecha',
				'th_upgrade'=>'Acualización',
				'th_action' => 'Acción',
				'th_how_you_hear'=>'¿Como escuchó de nosotros?',
				'th_creation_date'=>'Fecha de creación',
				'th_number' => 'Número',
				'td_edit' => 'Editarar',
				'td_delete' =>'Borrar',
				'filter' => [
					'label_title'=> 'Filtros',
					'country_label' => 'País',
					'state_label'=>'Estado',
					'state_date'=>'Fecha',
					'all' => 'Todos',
					'label_from' => 'Desde',
					'label_to' => 'Hasta',
					'btn_search' => 'Buscar',
				]
			],
			'show' => [
				'panel_title' => 'Applicantes',
				'miss_disqualified' => 'La señorita está descalificada',
				'miss_missing' => 'La señorita se encuentra por calificar',
				'miss_preselected' => 'La señorita está Preselecciona',
				'miss_no_preselected' => 'La señorita no está Preselecciona',
				'label_name'=>'Nombre',
				'label_lastname'=>'Apellido',
				'label_country'=>'País',
				'label_state'=>'Estado',
				'label_birthdate'=>'Cumpleañs',
				'label_place_of_birth'=>'Lugar de residencia',
				'label_email'=>'Email',
				'label_phone_number'=>'Número celular',
				'label_address' => 'Dirección',
				'label_city' => 'Ciudad',
				'label_state_province' => 'Estado / Provincia',
				'label_measurements' => 'Medidas',
				'label_height' => 'Altura',
				'label_weight' => 'Peso',
				'label_bust_measure'=>'Busto',
				'label_waist_measure'=>'Cintura',
				'label_hip_measure' => 'Cadera',
				'label_hair_color' => 'Color de cabello',
				'label_eye_color'=>'Color de ojos',
				'label_dairy_philosophy'=>'Filosofía diaria',
				'label_why_would_you_win' => '¿Porque ganaría el certamen',
				'label_no_preselected' => 'No Preseleccionada',
				'label_preselected' => 'Preseleccionada',
				'disqualify' => 'Descalificada',
				'label_qualify_candidate' => 'Calificar como candidata',
				'btn_cancel' => 'Cancelarar',
				'label_photos' => 'Fotos',
				'how_hear_about_us'=>'¿Como escuchó de nosotros?'
			],
			'create-edit' => [
				'panel_title' => 'Candidatas',
				'panel_subtitle' => 'Creación de candidatas',
				'panel_edit_subtitle' => 'Edición de Candidatas',
				'label_name'=>'Nombre',
				'label_lastname'=>'Apellido',
				'label_country'=>'País',
				'label_state'=>'Estado',
				'label_birthdate'=>'Fecha de nacimiento',
				'label_place_of_birth'=>'Lugar de nacimiento',
				'label_email'=>'Email',
				'label_phone_number'=>'Número telefónico',
				'label_address' => 'Dirección',
				'label_city' => 'Ciudad',
				'label_state_province' => 'Estado / Provincia',
				'label_measurements' => 'Medidas',
				'label_height' => 'Algura',
				'label_weight' => 'Peso',
				'label_bust_measure'=>'Busto',
				'label_waist_measure'=>'Cintura',
				'label_hip_measure' => 'Cader',
				'label_hair_color' => 'Color de cabello',
				'label_eye_color'=>'Color de ojos',
				'label_dairy_philosophy'=>'Filosofía diaria',
				'label_why_would_you_win' => '¿Porque ganaría el certamen',
				'label_photos' => 'Fotos',
				'select_default' => '--Seleccionar--',
				'btn_back' => 'Atrás',
				'btn_save' => 'Guardar',
				'disqualify' => 'Descalificar',
				'qualify' => 'Calificar',
				'flag_success_saved' => 'Candidata creada satisfactoriamente',
				'flag_error_saved' => 'Candidata no pudo ser creada, Intente otra vez',
				'flag_success_updated' => 'Candidata actualizada satisfactoriamente',
				'flag_error_updated' => 'Candidata no pudo ser actualizada, Intente otra vez',
				'flag_success_deleted' => 'Candidata eliminada satisfactoriamente',
				'flag_error_deleted' => 'Candidata no puede ser eliminada, Intente otra vez.',
				'flag_disqualited' => 'La señorita ha sido descalificada',
				'flag_qualited' => 'La señorita es un candidata',
				'how_hear_about_us'=>'¿Como escuchó de nosotros?'
			],
		],

		'applicant' => [
			'index' => [
				'tab_title_casting_1' => 'Casting 1',
				'tab_title_casting_2' => 'Casting 2',
				'panel_title' => 'Aplicantes',
				'panel_caption' => 'Listado de aplicantes',
				'th_names' => 'Nombres',
				'th_code' => 'Código',
				'th_state' => 'Estado',
				'th_date'=>'Fecha',
				'th_upgrade'=>'Actualización',
				'th_action' => 'Acción',
				'th_how_you_hear'=>'¿Como escuchó de nosotros?',
				'th_creation_date'=>'Fecha de Creación',
				'th_number' => 'Número',
				'td_show' => 'Ver',
				'td_delete' =>'Eliminar',
				'filter' => [
					'label_title'=> 'Filtros',
					'country_label' => 'País',
					'state_label'=>'Estado',
					'state_date'=>'Fecha',
					'all' => 'Todos',
					'label_from' => 'Desde',
					'label_to' => 'Hasta',
					'btn_search' => 'Buscar',
					'btn_gratitude'=>'Enviar email de agradecimiento',
					'btn_selected'=>'Enviar email a preseleccionadas',
				]
			],
			'show' => [
				'panel_title' => 'Aplicantes',
				'miss_disqualified' => 'La señorita esta descalificada',
				'miss_missing' => 'La señorita falta por calificar',
				'miss_preselected' => 'La señorita está preseleccionada',
				'miss_no_preselected' => 'La señorita no está preseleccionada',
				'label_name'=>'Nombre',
				'label_lastname'=>'Apellido',
				'label_country'=>'País',
				'label_state'=>'Estado',
				'label_birthdate'=>'Fecha de nacimiento',
				'label_place_of_birth'=>'Lugar de nacimiento',
				'label_email'=>'Email',
				'label_phone_number'=>'Número telefónico',
				'label_address' => 'Dirección',
				'label_city' => 'Ciudad',
				'label_state_province' => 'Estado / Provincia',
				'label_measurements' => 'Medidas',
				'label_height' => 'Altura',
				'label_weight' => 'Peso',
				'label_bust_measure'=>'Busto',
				'label_waist_measure'=>'Cintura',
				'label_hip_measure' => 'Cadera',
				'label_hair_color' => 'Color de cabello',
				'label_eye_color'=>'Color de ojos',
				'label_dairy_philosophy'=>'Filosofía diaria',
				'label_why_would_you_win' => '¿Porque ganaría el certamen',
				'label_no_preselected' => 'No Preseleccionada',
				'label_preselected' => 'Preseleccionada',
				'label_precandidate' => 'Calificar como candidate',
				'disqualify' => 'Descalificar',
				'label_qualify_missing' => 'Calificar como como faltante',
				'btn_back' => 'Atrás',
				'label_photos' => 'Fotos',
				'how_hear_about_us'=>'¿Como escuchó de nosotros?'
			],
			'create-edit' => [
				'flag_success_saved' => 'Aplicante creada satisfactoriamente',
				'flag_error_saved' => 'La Aplicante no pudo ser creada, Intente nuevamente',
				'flag_success_updated' => 'Aplicante actualizada satisfactoriamente',
				'flag_error_updated' => 'Aplicante no pudo ser actualizada, Intente nuevamente',
				'flag_success_deleted' => 'Aplicante ha sido eliminado satisfactoriamente',
				'flag_error_deleted' => 'Aplicante no pudo ser eliminada, intente nuevamente',
				'flag_qualited' => 'La señorita ha sido calificada como candidata',
			]
		],
		'precandidate' => [
			'index' => [
				'panel_title' => 'Precandidata',
				'panel_caption' => 'Listado de Precandidatas',
				'th_names' => 'Nombres',
				'th_code' => 'Código',
				'th_state' => 'Estado',
				'th_date'=>'Fecha',
				'th_upgrade'=>'Acualización',
				'th_action' => 'Acción',
				'th_how_you_hear'=>'¿Como escuchó de nosotros?',
				'th_creation_date'=>'Fecha de Creación',
				'th_number' => 'Número',
				'td_show' => 'Ver',
				'filter' => [
					'label_title'=> 'Filtros',
					'country_label' => 'País',
					'state_label'=>'Estado',
					'state_date'=>'Fecha',
					'all' => 'Todos',
					'label_from' => 'Desde',
					'label_to' => 'Hasta',
					'btn_search' => 'Buscar',
				]
			],
			'show' => [
				'panel_title' => 'Precandidatas',
				'miss_disqualified' => 'La señorita está descalificada',
				'miss_missing' => 'La señorita falta por calificar',
				'miss_preselected' => 'La señorita está preseleccionada',
				'miss_no_preselected' => 'La señorita no está preseleccionada',
				'label_name'=>'Nombre',
				'label_lastname'=>'Apellido',
				'label_country'=>'País',
				'label_state'=>'Estado',
				'label_birthdate'=>'Fecha de Nacimiento',
				'label_place_of_birth'=>'Lugar de Nacimiento',
				'label_email'=>'Email',
				'label_phone_number'=>'Número teléfonico',
				'label_address' => 'Dirección',
				'label_city' => 'Ciudad',
				'label_state_province' => 'Estado / Provincia',
				'label_measurements' => 'Medidas',
				'label_height' => 'Altura',
				'label_weight' => 'Peso',
				'label_bust_measure'=>'Busto',
				'label_waist_measure'=>'Cintura',
				'label_hip_measure' => 'Cadera',
				'label_hair_color' => 'Color de Cabello',
				'label_eye_color'=>'Color de Ojos',
				'label_dairy_philosophy'=>'Filosfía Diaria',
				'label_why_would_you_win' => '¿Porque ganaría el certamen',
				'label_no_preselected' => 'No Preseleccionada',
				'label_preselected' => 'Preseleccionada',
				'disqualify' => 'Descalificar',
				'label_qualify_candidate' => 'Calificar como Candidata',
				'btn_back' => 'Atrás',
				'label_photos' => 'Fotos',
				'missing' => 'Faltante',
				'how_hear_about_us'=>'¿Como escuchó de nosotros?',
				'flag_success_updated' => 'Precandidata Actualizado Correctamente',
			]
		],

		'client' => [
			'index' => [
				'panel_title' => 'Clientes',
				'panel_caption' => 'Listado de Clientes',
				'btn_create_client' => 'Crear Clientes',
				'th_account_type' => 'Cuenta',
				'th_name' => 'Nombre',
				'th_email' => 'Email',
				'th_address' => 'Dirección',
				'th_last_access' => 'Último Acceso',
				'th_creation_date'=>'Fecha de Creación',
				'th_upgrade'=>'Acualización',
				'th_action'=>'Acción',
				'td_edit' => 'Editar',
				'td_delete' =>'Eliminar',
				'td_without_confirm' => 'Sin Confirmación',
			],

			'create-edit' => [
				'panel_title' => 'Clientes',
				'panel_subtitle' => 'Creación de Clientes',
				'panel_subtitle_edit' => 'Edición de Clientes',
				'label_email' => 'Email',
				'label_name' => 'Nombre',
				'label_lastname' => 'Apellido',
				'label_country' => 'País',
				'label_city' => 'Ciudad',
				'label_address' => 'Dirección',
				'label_opt_select' => 'Seleccionar',
				'label_password' => 'Contraseña',
				'label_repeat_password' => 'Repetir Contraseña',
				'btn_cancel' => 'Cancelar',
				'btn_save' => 'Guardar',
				'label_membership' => 'Membresía',
				'label_ticket' => 'Tickets',
				'td_price' => 'Precio',
				'td_free' => 'Gratis',
				'td_points_per_vote' => 'Puntos por voto',
				'td_duration' => 'Duración',
				'td_ticket'=>'Ticket',
				'td_pay_type' => 'Tipo de Pago',
				'td_state' => 'Estado',
				'td_action' => 'Acción',
				'td_ticket_active' => 'Activo',
				'td_ticket_used' => 'Usado',
				'flag_success_saved' => 'Cliente Creado Satisfactoriamente',
				'flag_error_saved' => 'Cliente no pudo ser Creado, intente nuevamente',
				'flag_success_updated' => 'Cliente Actualizado Correctamente',
				'flag_error_updated' => 'Cliente no pudo ser Actualizado, intente nuevamente',
				'flag_success_deleted' => 'Cliente eliminado Satisfactoriamente',
				'flag_error_deleted' => 'Cliente no pudo ser eliminado, intente nuevamente',
			],
		],

		'activity' => [
			'index' => [
				'panel_title' => 'Actividades',
				'panel_caption' => 'Listado de Actividades',
				'th_activity' => 'Actividad',
				'th_date' => 'Fecha'
			],
		],

		'user' => [
			'index' => [
				'panel_title' => 'Administradores',
				'panel_caption' => 'Listado de Administradores',
				'th_name' => 'Nombre',
				'th_email' => 'Email',
				'th_address' => 'Dirección',
				'th_last_access' => 'Último Acceso',
				'th_creation_date'=>'Fecha de Creación',
				'th_action'=>'Acción',
				'th_upgrade'=>'Acualización',
				'td_edit' => 'Editar',
				'btn_create' => 'Crear Administrador',
				'td_delete' => 'Eliminar Administrador',
			],

			'create-edit' => [
				'panel_title' => 'Administradores',
				'panel_subtitle' => 'Creación de Administradores',
				'panel_subtitle_edit' => 'Edición de Administradores',
				'label_email' => 'Email',
				'label_name' => 'Nombre',
				'label_lastname' => 'Apellido',
				'label_address' => 'Dirección',
				'label_password' => 'Contraseña',
				'label_repeat_password' => 'Repetir Contraseña',
				'btn_cancel' => 'Cancelar',
				'btn_save' => 'Guardar',
				'flag_success_saved' => 'Administrador Creado Satisfactorily',
				'flag_error_saved' => 'Administrador no pudo ser creado, intente nuevamente',
				'flag_success_updated' => 'Administrador Actualizado Correctamente',
				'flag_error_updated' => 'Administrador no pudo ser actualizado, intente nuevamente',
				'flag_success_deleted' => 'Administrador eliminado Satisfactoriamente',
				'flag_error_deleted' => 'Administrador no pudo ser eliminado, intente nuevamente',
			]
		],


		'membership' => [
			'index' => [
				'panel_title' => 'Membresías',
				'panel_caption' => 'Listado de Membresías',
				'th_name' => 'Nombre',
				'th_duration' => 'Duración',
				'th_price' => 'Precio',
				'th_creation_date'=>'Fecha de Creación',
				'th_upgrade'=>'Acualización',
				'th_action' => 'Acción',
				'td_edit' => 'Editar',
				'td_delete' => 'Eliminar'
			],

			'create-edit' => [
				'panel_title' => 'Membresías',
				'panel_caption_create' => 'Creación de Membresías',
				'panel_caption_edit' => 'Edición de  Membresías',
				'label_name' => 'Nombre',
				'label_description' => 'Descripción',
				'label_duration' => 'Duración',
				'label_select' => 'Seleccionar',
				'label_price' => 'Precio',
				'label_points_per_vote' => 'Puntos por voto',
				'btn_cancel' => 'Cancelar',
				'btn_save' => 'Guardar',
				'label_months' => 'Meses(s)',
				'label_years' => 'Año(s)',
				'flag_success_saved' => 'Membresía Creado Satisfactoriamente',
				'flag_error_saved' => 'Membresía no pudo ser creado, intente nuevamente',
				'flag_success_updated' => 'Membresía Actualizada Correctamente',
				'flag_error_updated' => 'Membresía no pudo ser Actualizada, intente nuevamente',
				'flag_success_deleted' => 'Membresía eliminada Satisfactoriamente',
				'flag_error_deleted' => 'Membresía No pudo ser eliminada, Intente nuevamente',
			]
		],

		'country' => [
			'index' => [
				'panel_title' => 'Paises',
				'panel_caption' => 'Listado de Paises',
				'th_name' => 'Nombre',
				'th_code' => 'Código',
				'th_lang' => 'Lenguaje',
				'th_upgrade'=>'Acualización',
				'th_action' => 'Acción',
				'td_edit' => 'Editar',
				'td_delete' => 'Eliminar',
				'btn_create' => 'Crear País'
			],

			'create-edit' => [
				'panel_title' => 'Paises',
				'panel_caption_create' => 'Creación de Paises',
				'panel_caption_edit' => 'Edición de  Paises',
				'label_name' => 'Nombre',
				'label_code' => 'Código',
				'label_lang' => 'Lenguaje',
				'label_email' => 'Email de contacto',
				'btn_cancel' => 'Cancelar',
				'btn_save' => 'Guardar',
				'btn_change_flag' => 'Cambiar Bandera',
				'flag_success_saved' => 'País Creado Satisfactoriamente',
				'flag_error_saved' => 'País no pudo ser creado, Intente nuevamente',
				'flag_success_updated' => 'País Actualizado Correctamente',
				'flag_error_updated' => 'País no pudo ser actualizado, Intente nuevamente',
				'flag_success_deleted' => 'País eliminado satisfactoriamente',
				'flag_error_deleted' => 'País no pudo ser eliminado, intente nuevamente',
			]
		],

		'config' => [
			'index' => [
				'panel_title' => 'Conf. de Casting',
				'tab_general' => 'General',
				'tab_castings' => 'Casting',
				'tab_email' => 'Email',
				'flag_message_success' => 'Conf. Actualizado Correctamente',
				'flag_message_error' => 'Conf. no pudo ser actualizado, Intente nuevamente.',
				
			],

			'tab_general_content' => [
				'label_casting' => 'Existe Casting',
				'select_casting_yes' => 'Si',
				'select_casting_no' => 'No',
				'btn_save' => 'Guardar'
			],

			'tab_casting_content' => [
				'tab_caption_title' => 'Listado de Castings',
				'btn_create_casting' => 'Crear Casting'
			],
			'modal_create_edit_casting' => [
				'title' => 'Castings',
				'start_date' => 'Fecha de Inicio',
				'end_date' => 'Fecha de Final',
				'action' => 'Acción',
				'lang' => 'Lenguaje',
				'available_countries' => 'Paises disponibles',
				'dont_exist' => 'Sin Datos',
				'btn_action_insert' => 'Insertar',
				'option_language_key_es' => 'es',
				'option_language_label_es' => 'Español',
				'option_language_key_en' => 'en',
				'option_language_label_en' => 'English',
				'btn_save' => 'Guardar',
				'btn_cancel' => 'Cancelar',

			],
			'tab_mail' => [
				'subject' => 'Asunto',
				'body' => 'Cuerpo',
				'list_variables'=> 'Variables Disponibles'
			]

		],




	];