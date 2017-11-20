<?php
namespace  MissVote\RepositoryInterface;

interface  CountryRepositoryInterface extends CoreRepositoryInterface {

	public function getAvailableCountries();

	public function getSelectedCountries($castingId  = null);
	

}