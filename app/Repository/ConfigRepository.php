<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\ConfigRepositoryInterface;
use MissVote\Models\Config;
use MissVote\Models\Country;
use Image;
/**
* 
*/
class ConfigRepository implements ConfigRepositoryInterface
{
	
	public function enum($params = null)
	{
		$configs = Config::all();

		if (!$configs) {
			throw new ConfigException("No se han encontrado cientes",404);
		}
		return $configs;
	}

	public function find($field, $returnException = true)
	{
		if (is_array($field)) {
			if (array_key_exists('key', $field)) { 
				$config = Config::where('key',$field['key'])->first(); 
			} else {
				abort(500);
			}
		} elseif (is_string($field) || is_int($field)) {
			$config = Config::where('id',$field)->first();
		}

		if ($returnException) {
			if (!$config) abort(404);
		} else {
			if (!$config) return false;
		}
		
		return $config;

	}

	//TODO
	public function save($data)
	{
		$countries = [];
		if (array_key_exists('countries', $data)) {
			$countries = $data['countries'];
		}

		if ($config = $this->find(['key'=>$data['key'] ] , false)) {
		} else {
			$config = new Config();
			
		}
		$config->fill($data);
		$config->save();

		//if countries
		if (count($countries)) {
			//reset all countries with casting id
			Country::where('casting_id',$config->getKey())->update(['casting_id'=>null]);
			$countriesToUpdate = Country::whereIn('id',$countries)->get();
			foreach ($countriesToUpdate as $key => $coun) {
				$coun->casting_id = $config->getKey();
				$coun->update();
			}
		}

		return $this->enum();
	}

	public function edit($id,$data)
	{
		$config = $this->find($id);

		if ($config) {
			$config->fill($data);
			if($config->update()){
				return $this->find($config->getKey());
			}
		}

		abor(500);

	}

	public function remove($id)
	{
		if ($config = $this->find($id)) {
			$config->delete();
			return true;
		}
		abort(500);
	}

}