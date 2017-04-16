<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\PrecandidateRepositoryInterface;
use MissVote\Models\Precandidate;
use Carbon\Carbon;
use Image;
/**
* 
*/
class PrecandidateRepository implements PrecandidateRepositoryInterface
{
	
	public function enum($params = null)
	{
		if (!$params) {
			$precandidates = Precandidate::all();
		} elseif (is_array($params)) {
			if (array_key_exists('state', $params)) {
				$precandidates = Precandidate::where('state',$params['state'])->get();
			}
		}

		return $precandidates;
	}

	public function find($field, $returnException = false)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$precandidate = Precandidate::where('name',$field['name'])->first();
			} elseif (array_key_exists('slug', $field)) {
				$precandidate = Precandidate::where('slug',$field['slug'])->first();
			}else {
				return abort(404);
			}
		} elseif (is_string($field) || is_int($field)) {
		
			$precandidate = Precandidate::where('id',$field)->first();
		}
		if ($returnException) {
			return abort(404);
		} else {
			if (!$precandidate) return false;
		}
		
		return $precandidate;

	}

	//TODO
	public function save($data)
	{
		$precandidate = new Precandidate();
		// $photos = $data['photos'];
		// $precandidate->slug = str_slug($data['name'].' '.$data['last_name'],'-');
		$precandidate->fill($data);
		if ($precandidate->save()) {
			$keyPrecandidate = $precandidate->getKey();
			// foreach ($photos as $key => $photo) {
			// 	$this->uploadPhoto($keyPrecandidate,$photo);
			// }
			return  $this->find($keyPrecandidate);
		} 
		return false;
		
	}

	public function edit($id,$data)
	{
		$precandidate = $this->find($id);
		// $photos = null;
		// if ($precandidate) {
		// 	if (array_key_exists('photos', $data)) {
		// 		$photos = $data['photos'];
		// 	}
		// 	$precandidate->slug = str_slug($data['name'].' '.$data['last_name'],'-');
			$precandidate->fill($data);
			if($precandidate->update()){
				$keyPrecandidate = $precandidate->getKey();
				// if ($photos) {
				// 	foreach ($photos as $key => $photo) {
				// 		$this->uploadPhoto($keyPrecandidate,$photo);
				// 	}
				// }
				return $this->find($keyPrecandidate);
			}
		// }

		return false;

	}

	public function remove($id)
	{
		if ($precandidate = $this->find($id)) {
			$precandidate->delete();
			return true;
		}
		return false;
	}


	private function pathUplod() {
		return public_path().'/uploads';
	}


	public function uploadPhoto($precandidateId,$photo)
	{
		$arrayModel=[];
		if ($photo->isValid()) {
			
			$realPath = $photo->getRealPath();
			$image = Image::make($realPath);
			$isLandScape = true;

			if ($image->width() >= $image->height()) {
				$isLandScape = false;
			}
			//is landscape
			if ($isLandScape) {
				$image->resize(309,482,function($constraint){
					$constraint->aspectRatio();
				});
			} else {
				//is portrait
				$image->resize(722,482,function($constraint){
					$constraint->aspectRatio();
				});				
			}


			$imageName = $precandidateId.'_'.str_random().'.'. $photo->getClientOriginalExtension();
			if($image->save($this->pathUplod().'/'.$imageName)){
				$arrayModel['path'] = 'public/uploads/'.$imageName;
				// $paths[$key]['precandidate_id'] = $keyPrecandidate;
			}
		}

		if ($arrayModel) {
			$precandidate = $this->find($precandidateId);
			$arrayModel['is_landscape'] = $isLandScape;
			$modelRelation = new \MissVote\Models\MissPhoto($arrayModel);
			$precandidate->photos()->save($modelRelation);
			return $precandidate;
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