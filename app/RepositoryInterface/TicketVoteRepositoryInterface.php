<?php
namespace  MissVote\RepositoryInterface;

interface  TicketVoteRepositoryInterface extends CoreRepositoryInterface {
	
	public function paginate();

	public function generateRaffle();

}