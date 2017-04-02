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
		if (!$params) {
			$misses = Miss::all();
		} elseif (is_array($params)) {
			if (array_key_exists('state', $params)) {
				$misses = Miss::where('state',$params['state'])->get();
			}
		}

		if (!$misses) {
			throw new MissException("No se han encontrado cientes",404);
		}
		return $misses;
	}

	public function find($field, $returnException = false)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$miss = Miss::where('name',$field['name'])->first();
			} elseif (array_key_exists('slug', $field)) {
				$miss = Miss::where('slug',$field['slug'])->first();
			}else {
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
		$miss->slug = str_slug($data['name'].' '.$data['last_name'],'-');
		$miss->fill($data);
		if ($miss->save()) {
			$keyMiss = $miss->getKey();
			foreach ($photos as $key => $photo) {
				$this->uploadPhoto($keyMiss,$photo);
			}
			return  $this->find($keyMiss);
		} 
		throw new MissException("Ha ocurrido un error al guardar la candidata",500);
		
	}

	public function edit($id,$data)
	{
		$miss = $this->find($id);

		if ($miss) {
			$miss->slug = str_slug($data['name'].' '.$data['last_name'],'-');
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


	public function uploadPhoto($missId,$photo)
	{
		$arrayModel=[];
		if ($photo->isValid()) {
			$imageName = $missId.'_'.str_random().'.'. $photo->getClientOriginalExtension();
			if($photo->move($this->pathUplod(),$imageName)){
				$arrayModel['path'] = 'public/uploads/'.$imageName;
				// $paths[$key]['miss_id'] = $keyMiss;
			}
		}

		if ($arrayModel) {
			$miss = $this->find($missId);
			$modelRelation = new \MissVote\Models\MissPhoto($arrayModel);
			$miss->photos()->save($modelRelation);
			return $miss;
		}
	}


	public function deletePhoto($idPhoto)
	{
		$photo = \MissVote\Models\MissPhoto::find($idPhoto);
		if ($photo) {
			$pathUnlink = '/'.$photo->path;
			if ($photo->delete()) {
				return true;
			}
		}
	}

}