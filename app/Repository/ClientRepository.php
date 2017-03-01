<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\ClientRepositoryInterface;
use MissVote\Models\Client;

/**
* 
*/
class ClientRepository implements ClientRepositoryInterface
{
	
	public function enum($params = null)
	{
		$clients = Client::where('is_admin',0)->get();
		
		if (!$clients) {
			throw new ClientException("No se han encontrado cientes",404);
		}
		return $clients;
	}

	public function find($field, $returnException = true)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$client = Client::where('name',$field['name'])->first();
			} else {
				throw new ClientException("No se puede buscar al client",500);		
			}
		} elseif (is_string($field) || is_int($field)) {
		
			$client = Client::where('id',$field)->first();
		}

		if ($returnException) {
			if (!$client) throw new ClientException("No se ha encontrado el client solicitado",404);
		} else {
			if (!$client) return false;
		}
		
		return $client;

	}

	//TODO
	public function save($data)
	{
		$client = new Client();

		$data['password'] = \Hash::make($data['password']);

		$client->fill($data);
		if ($client->save()) {
			// $client->roles()->sync($data['roles']);
			$key = $client->getKey();
			return  $this->find($key);
		} 
		throw new ClientException("Ha ocurrido un error al guardar el ciente",500);
		
	}

	public function edit($id,$data)
	{
		$client = $this->find($id);

		if ($client) {
			// dd($data);
			$client->name = $data['name'];
			$client->email = $data['email'];
			$client->address = $data['address'];
			$client->is_admin = $data['is_admin'];
			if(!empty($data['password'])) {
				// dd($data['password']);
				$data['password'] = \Hash::make($data['password']);
				$client->password = $data['password']; 
   			}
			if($client->update()){
				// $client->roles()->sync($data['roles']);
				$key = $client->getKey();
				return $this->find($key);
			}
		}

		throw new ClientException("Ha ocurrido un error al actualizar el ciente",500);

	}

	public function remove($id)
	{
		if ($client = $this->find($id)) {
			$client->delete();
			return true;
		}
		throw new ClientException("Ha ocurrido un error al eliminar el client",500);
	}

}