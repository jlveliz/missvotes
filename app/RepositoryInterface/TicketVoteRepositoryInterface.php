<?php
namespace  MissVote\RepositoryInterface;

interface  TicketVoteRepositoryInterface extends CoreRepositoryInterface {
	
	public function generateRaffle($value);

	public function generateListRaffle();
	
	public function paginate();


}