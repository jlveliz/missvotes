<?php
namespace  MissVote\RepositoryInterface;

interface  TicketVoteClientRepositoryInterface extends CoreRepositoryInterface {
	
	public function generateRaffle($value);

	public function generateListRaffle();
	
	public function paginate();


}