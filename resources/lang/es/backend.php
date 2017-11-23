<?php

	return [

		// nav
		'nav' => [
			'dashboard' => 'Dashboard',
			'participants' => [
				'menu'=>'Participants',
				'candidates'=>'Candidates of the contest',
				'register_log' => 'Aplication log'
			],
			'members'=> [
				'menu' => 'Members',
				'list' => 'List',
				'activities'=>'Activities',
			],
			'config' => [
				'menu' => 'Configuration',
				'users' => 'Users',
				'membership' => 'Memberships',
				'countries' => 'Countries',
			],
		],

		// dashboard
		'dashboard' => [
			'ranking_block' => [
				'title' => 'Ranking',
				'th_candidate' => 'Candidate',
				'th_country' => 'Country',
				'th_score' => 'Score',
				'td_points' => 'Points'
			],

			'membership_block' => [
				'title' => 'Memberships',
				'th_membership' => 'Membership',
				'th_number_user' => 'Number of Users',

			],

			'tickets_block' => [
				'title' => 'Tickets',
				'th_client' => 'Client',
				'th_ticket' => 'Ticket'
			],
		],


		// misses
		'misses' => [
			'index' => [
				'panel_title' => 'Candidates',
				'panel_caption' => 'List of Candidates',
				'th_names' => 'Names',
				'th_country' => 'Country',
				'th_state' => 'State',
				'th_creation_date'=>'Creation Date',
				'th_upgrade'=>'Upgrade',
				'th_action' => 'Action',
				'td_edit' => 'Edit',
				'td_delete' =>'Delete',
				'btn_create' => 'Create Candidate',
				'td_state_active' => 'Active',
				'td_state_inactive' => 'Inactive',
			],

			'create-edit' => [
				'panel_title' => 'Candidates',
				'panel_subtitle' => 'Creation of candidates',
				'panel_edit_subtitle' => 'Edition of candidates',
				'label_name'=>'Name',
				'label_lastname'=>'Lastname',
				'label_country'=>'Country',
				'label_state'=>'State',
				'label_birthdate'=>'Birthdate',
				'label_place_of_birth'=>'Place of birth',
				'label_email'=>'Email',
				'label_phone_number'=>'Phone number',
				'label_address' => 'Address',
				'label_city' => 'City',
				'label_state_province' => 'State / Province',
				'label_measurements' => 'Measurements',
				'label_height' => 'Height',
				'label_weight' => 'Weight',
				'label_bust_measure'=>'Bust',
				'label_waist_measure'=>'Waist',
				'label_hip_measure' => 'Hip',
				'label_hair_color' => 'Hair Color',
				'label_eye_color'=>'Eye Color',
				'label_dairy_philosophy'=>'Dairy Philosophy',
				'label_why_would_you_win' => 'Why would you win',
				'label_photos' => 'Photos',
				'select_default' => '--Select--',
				'select_state_active' => 'Active',
				'select_state_inactive' => 'Inactive',
				'btn_cancel' => 'Cancel',
				'btn_save' => 'Save',
			],
		],
		'config' => [
			'index' => [
				'panel_title' => 'Settings',
				'tab_general' => 'General',
				'tab_castings' => 'Casting',
				'tab_email' => 'Email',
				'flag_message_success' => 'Config Updated Satisfactorily',
				'flag_message_error' => 'Config could not be updated, try again ',
				
			],

			'tab_general_content' => [
				'label_casting' => 'Exist Casting',
				'select_casting_yes' => 'Yes',
				'select_casting_no' => 'No',
				'btn_save' => 'Save'
			],

			'tab_casting_content' => [
				'tab_caption_title' => 'List of Castings',
				'btn_create_casting' => 'Create Casting'
			],
			'modal_create_edit_casting' => [
				'title' => 'Castings',
				'start_date' => 'Start Date',
				'end_date' => 'End Date',
				'action' => 'Action',
				'lang' => 'Language',
				'available_countries' => 'Available Contries',
				'dont_exist' => 'No Data',
				'btn_action_insert' => 'Insert',
				'option_language_key_es' => 'es',
				'option_language_label_es' => 'Español',
				'option_language_key_en' => 'en',
				'option_language_label_en' => 'English',
				'btn_save' => 'Save',
				'btn_cancel' => 'Cancel',

			],
			'tab_mail' => [
				'subject' => 'Subject',
				'body' => 'Body',
				'list_variables' => 'List of Variables'
			]

		],


	];