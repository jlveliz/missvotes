<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\TicketVoteRepositoryInterface;
use MissVote\Models\TicketVote;
use Carbon\Carbon;

/**
* 
*/
class TicketVoteRepository implements TicketVoteRepositoryInterface
{
	
	public function enum($params = null)
	{
		$ticketVotes = TicketVote::all();
		
		if (!$ticketVotes) {
			return false;
		}
		return $ticketVotes;
	}

	public function find($field)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$miss = TicketVote::where('name',$field['name'])->first();
			} else {
				return false;	
			}
		} elseif (is_string($field) || is_int($field)) {
		
			$miss = TicketVote::where('id',$field)->first();
		}

		
		if (!$miss) return false;
		
		
		return $miss;

	}

	//TODO
	public function save($data)
	{
		$miss = new TicketVote();
		$miss->fill($data);
		if ($miss->save()) {
			$keyMiss = $miss->getKey();
			return  $this->find($keyMiss);
		} 
		return false;
		
	}

	public function edit($id,$data)
	{
		$miss = $this->find($id);

		if ($miss) {
			$miss->fill($data);
			if($miss->update()){
				$key = $miss->getKey();
				return $this->find($key);
			}
		}

		return false;

	}

	public function remove($id)
	{
		if ($miss = $this->find($id)) {
			$miss->delete();
			return true;
		}
		return false;
	}



}