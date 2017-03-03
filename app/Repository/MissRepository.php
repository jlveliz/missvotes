<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\MissRepositoryInterface;
use MissVote\Models\Miss;
use Carbon\Carbon;

/**
* 
*/
class MissRepository implements MissRepositoryInterface
{
	
	public function enum($params = null)
	{
		$misses = Miss::all();
		
		if (!$misses) {
			throw new MissException("No se han encontrado cientes",404);
		}
		return $misses;
	}

	public function find($field, $returnException = true)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$miss = Miss::where('name',$field['name'])->first();
			} else {
				throw new MissException("No se puede buscar a la Candidata",500);		
			}
		} elseif (is_string($field) || is_int($field)) {
		
			$miss = Miss::where('id',$field)->first();
		}

		if ($returnException) {
			if (!$miss) throw new MissException("No se ha encontrado a la Candidata solicitada",404);
		} else {
			if (!$miss) return false;
		}
		
		return $miss;

	}

	//TODO
	public function save($data)
	{
		$miss = new Miss();
		$photos = $data['photos'];
		$miss->fill($data);
		if ($miss->save()) {
			$paths=[];
			$keyMiss = $miss->getKey();
			foreach ($photos as $key => $photo) {
				if ($photo->isValid()) {
					$imageName = $keyMiss.'_'.str_random().'.'. $photo->getClientOriginalExtension();
					if($photo->move($this->pathUplod(),$imageName)){
						$paths[$key]['path'] = 'public/uploads/'.$imageName;
						// $paths[$key]['miss_id'] = $keyMiss;
					}
				}
			}
			// dd($paths);
			if (count($paths) > 0) {
				foreach ($paths as $key => $path) {
					$modelRelation = new \MissVote\Models\MissPhoto($path);
					// dd($modelRelation);
					$miss->photos()->save($modelRelation);
				}
			}
			return  $this->find($keyMiss);
		} 
		throw new MissException("Ha ocurrido un error al guardar la candidata",500);
		
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

		throw new MissException("Ha ocurrido un error al actualizar la candidata",500);

	}

	public function remove($id)
	{
		if ($miss = $this->find($id)) {
			$miss->delete();
			return true;
		}
		throw new MissException("Ha ocurrido un error al eliminar la candidata",500);
	}


	private function pathUplod() {
		return public_path().'/uploads';
	}

}