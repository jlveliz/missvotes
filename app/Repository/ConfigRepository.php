<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\ConfigRepositoryInterface;
use MissVote\Models\Config;
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
		//save all config
		foreach ($data as $key => $value) {
			if ($config = $this->find(['key' => $key],false)) {
				$dataPost = [
					'key' => $key,
					'payload' => $value
				];
				$config->fill($dataPost)->update();
			} else {
				
				$dataPost = [
					'key' => $key,
					'payload' => $value
				];
				$config = new Config();
				$config->fill($dataPost);
				$config->save();
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