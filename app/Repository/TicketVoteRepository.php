<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\TicketVoteRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use MissVote\Models\TicketVote;
use Carbon\Carbon;

/**
* 
*/
class TicketVoteRepository implements TicketVoteRepositoryInterface
{
	
	public $raffles = [];

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



	/**
	 * RAFFLE
	 */

	public function generateRaffle()
	{
		$valRuffle = 1;
		for ($i=0; $i < config('vote.raffle-numbers') ; $i++) { 
			$this->raffles[$i] = $valRuffle++;
		}

		return $this;
	}

	public function paginate()
	{
		//Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        //Create a new Laravel collection from the array data
        $collection = new Collection($this->raffles);

        //Define how many items we want to be visible in each page
        $perPage = 200;

        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        //Create our paginator and pass it to the view
        return  new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage,null,['path'=>'raffles']);
	}


}