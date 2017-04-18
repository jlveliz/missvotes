<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\ClientApplyProcessRepositoryInterface;
use MissVote\Models\ClientApplyProcess;
use Carbon\Carbon;
/**
* 
*/
class ClientApplyProcessRepository implements ClientApplyProcessRepositoryInterface
{
	
	public function enum($params = null)
	{
		if (!$params) {
			$applies = ClientApplyProcess::all();
		} elseif (is_array($params)) {
			if (array_key_exists('process_status', $params)) {
				$applies = ClientApplyProcess::where('process_status',$params['process_status'])->get();
			}
		}

		return $applies;
	}

	public function find($field, $returnException = false)
	{
		if (is_array($field)) {
			if (array_key_exists('client_id', $field)) { 
				$apply = ClientApplyProcess::where('client_id',$field['client_id'])->first();
			}else {
				return abort(404);
			}
		} elseif (is_string($field) || is_int($field)) {

			$apply = ClientApplyProcess::where('id',$field)->first();
		}
		if ($returnException) {
			return abort(404);
		} else {
			if (!$apply) return false;
		}
		
		return $apply;

	}

	//TODO
	public function save($data)
	{
		$apply = new ClientApplyProcess();
		$apply->fill($data);
		if ($apply->save()) {
			$keyPrecandidate = $apply->getKey();
			return  $this->find($keyPrecandidate);
		} 
		return false;
		
	}

	public function edit($id,$data)
	{
		$apply = $this->find($id);
		$apply->fill($data);
		if($apply->update()){
			$keyPrecandidate = $apply->getKey();
				return $this->find($keyPrecandidate);
		}
		return false;

	}

	public function remove($id)
	{
		if ($apply = $this->find($id)) {
			$apply->delete();
			return true;
		}
		return false;
	}

}