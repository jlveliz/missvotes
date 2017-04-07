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
		$clients = ClientActivity::all();
		
		return $clients;
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