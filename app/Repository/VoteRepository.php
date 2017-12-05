<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\VoteRepositoryInterface;
use MissVote\Models\Vote;

/**
* 
*/
class VoteRepository implements VoteRepositoryInterface
{
	
	public function enum($params = null)
	{
		$votes = Vote::all();
		
		if (!$votes) {
			throw new VoteException("No se han encontrado Votos",404);
		}
		return $votes;
	}

	public function find($field, $returnException = true)
	{
		if (is_array($field)) {
			if (array_key_exists('miss_id', $field)) { 
				$vote = Vote::where('miss_id',$field['miss_id'])->first();
			} elseif (array_key_exists('client_id', $field)) {
				$vote = Vote::where('client_id',$field['client_id'])->first();
			} else {
				abort(500);
			}
		} elseif (is_string($field) || is_int($field)) {
		
			$vote = Vote::where('id',$field)->first();
		}

		if ($returnException) {
			if (!$vote) abort(404);
		} else {
			if (!$vote) return false;
		}
		
		return $vote;

	}

	//TODO
	public function save($data)
	{
		$vote = new Vote();
		$vote->fill($data);
		if ($vote->save()) {
			$key = $vote->getKey();
			return  $this->find($key);
		} 
		abort(500);
		
	}

	public function edit($id,$data)
	{
		$vote = $this->find($id);

		if ($vote) {
			
			$vote->client_id = $data['client_id'];
			$vote->miss_id = $data['miss_id'];
			$vote->type = $data['type'];
			$vote->value = $data['value']; //TODO?
			if($vote->update()){
				$key = $vote->getKey();
				return $this->find($key);
			}
		}

		abor(500);

	}

	public function remove($id)
	{
		if ($vote = $this->find($id)) {
			$vote->delete();
			return true;
		}
		abort(500);
	}



	/**
	* REPORTS
	**/
	public function ranking()
	{
		
		return Vote::SelectRaw('sum(value) as sumatory, miss_id')->groupBy('miss_id')->orderBy('sumatory','desc')->limit(10)->get();

	}

}