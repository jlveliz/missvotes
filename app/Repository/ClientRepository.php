<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\ClientRepositoryInterface;
use MissVote\Models\Client;
use Image;
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
			} elseif (array_key_exists('confirmation_code', $field)) {
				$client = Client::where('confirmation_code',$field['confirmation_code'])->first();
			} elseif (array_key_exists('email', $field)) {
				$client = Client::where('email',$field['email'])->first();
			} else {
				abort(500);
			}
		} elseif (is_string($field) || is_int($field)) {
		
			$client = Client::where('id',$field)->first();
		}

		if ($returnException) {
			if (!$client) abort(404);
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
		abort(500);
		
	}

	public function edit($id,$data)
	{
		$client = $this->find($id);

		if ($client) {
			// dd($data);
			$client->name = $data['name'];
			$client->last_name = $data['last_name'];
			$client->country_id = $data['country_id'];
			$client->city = $data['city'];
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

		abor(500);

	}

	public function remove($id)
	{
		if ($client = $this->find($id)) {
			$client->delete();
			return true;
		}
		abort(500);
	}

	private function pathUplod() {
		return public_path().'/uploads/profiles';
	}


	public function uploadPhoto($clientId,$photo)
	{
		if ($photo->isValid()) {
			
			$realPath = $photo->getRealPath();
			$image = Image::make($realPath);
			
			$image->resize(550,550,function($constraint){
					$constraint->aspectRatio();
			});


			$imageName = $clientId.'_'.str_random().'.'. $photo->getClientOriginalExtension();
			if($image->save($this->pathUplod().'/'.$imageName)){
				return 'public/uploads/profiles/'.$imageName; 
			} else {
				return false;
			}
		}

		return false;
	}


	public function countUserMemberships() 
	{
		return Client::selectRaw("membership_client.membership_id as membership, count(*) AS counter")
				->leftJoin('membership_client','user.id','=','membership_client.client_id')
				->leftJoin('membership','membership.id','=','membership_client.membership_id')
				->where('user.is_admin',(new Client())->getInactive())
				->where('user.confirmed',(new Client())->getActive())
				->groupBy('membership_client.membership_id')
				->get();
	}


}