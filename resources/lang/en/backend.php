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

			'create' => [
				'panel_title' => 'Candidates',
				'panel_subtitle' => 'Creation of candidates',
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
				'label_bust_measure'=>'Bust measure',
				'label_waist_measure'=>'Waist measure',
				'label_hip_measure' => 'Hip measure',
				'label_hair_color' => 'Hair Color',
				'label_eye_color'=>'Eye Color',
				'label_dairy_philosophy'=>'Dairy Philosophy',
				'label_why_would_you_win' => 'Why would you win',
				'label_photos' => 'Photos',
				'btn_cancel' => 'Cancel',
				'btn_save' => 'Save',
			],
		],


	];