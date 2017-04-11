<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\ClientActivityRepositoryInterface;
use MissVote\Models\ClientActivity;

/**
* 
*/
class ClientActivityRepository implements ClientActivityRepositoryInterface
{
	
	public function enum($params = null)
	{
		if (is_array($params)) {
			if (array_key_exists('client_id', $params)) {
				$activities = ClientActivity::where('client_id',$params['client_id'])->orderBy('created_at','desc')->get();
			}
		} else {
			$activities = ClientActivity::all();
		}
		
		return $activities;
	}

	public function find($field, $returnException = true)
	{
		#

	}

	//TODO
	public function save($data)
	{
		#
		
	}

	public function edit($id,$data)
	{
		#

	}

	public function remove($id)
	{
		#
	}

}