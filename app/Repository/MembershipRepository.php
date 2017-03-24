<?php
namespace Miss\Repository;

use MissVote\RepositoryInterface\MembershipRepositoryInterface;
use MissVote\Models\Membership;
use Carbon\Carbon;

/**
* 
*/
class MembershipRepository implements MembershipRepositoryInterface
{
	
	public function enum($params = null)
	{
		$memberships = Membership::all();
		
		if (!$memberships) {
			throw new MembershipException("No se han encontrado Membresias",404);
		}
		return $memberships;
	}

	public function find($field, $returnException = false)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$membership = Membership::where('name',$field['name'])->first();
			} else {
				throw new MembershipException("No se puede buscar a la Membresia",500);		
			}
		} elseif (is_string($field) || is_int($field)) {
		
			$membership = Membership::where('id',$field)->first();
		}

		if ($returnException) {
			if (!$membership) throw new MembershipException("No se ha encontrado a la Membresia solicitada",404);
		} else {
			if (!$membership) return false;
		}
		
		return $membership;

	}

	//TODO
	public function save($data)
	{
		$membership = new Membership();
		$membership->fill($data);
		if ($membership->save()) {
			$keyMembership = $membership->getKey();
			return  $this->find($keyMembership);
		} 
		throw new MembershipException("Ha ocurrido un error al guardar la Membresia solicitada",500);
		
	}

	public function edit($id,$data)
	{
		$membership = $this->find($id);

		if ($membership) {
			$membership->fill($data);
			if($membership->update()){
				$key = $membership->getKey();
				return $this->find($key);
			}
		}

		throw new MembershipException("Ha ocurrido un error al actualizar la membresia",500);

	}

	public function remove($id)
	{
		if ($membership = $this->find($id)) {
			$membership->delete();
			return true;
		}
		throw new MembershipException("Ha ocurrido un error al eliminar la membresia",500);
	}

}