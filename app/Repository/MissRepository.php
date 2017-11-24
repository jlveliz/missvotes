<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\MissRepositoryInterface;
use MissVote\Models\Miss;
use MissVote\Repository\ConfigRepository;
use Carbon\Carbon;
use Image;
/**
* 
*/
class MissRepository implements MissRepositoryInterface
{
	
	public function paginate()
	{
		return Miss::where('state','1')->whereHas('photos')->paginate();
	}

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
			abort(404);
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
			}elseif (array_key_exists('email', $field)) {
				$miss = Miss::where('email',$field['email'])->first();
			}else {
				return false;
			}
		} elseif (is_string($field) || is_int($field)) {
		
			$miss = Miss::where('id',$field)->first();
		}

		if ($returnException) {
			if (!$miss) abort(404);
		} else {
			if (!$miss) return false;
		}
		
		return $miss;

	}

	//TODO
	public function save($data)
	{
		$miss = new Miss();
		$photos = null;
		if (array_key_exists('photos', $data)) {
			$photos = $data['photos'];
		}

		if (array_key_exists('applicant_face_photo', $data)) {
			$data['applicant_face_photo'] = $this->uploadApplicantPhoto($data['applicant_face_photo']);
		}

		if (array_key_exists('applicant_body_photo', $data)) {
			$data['applicant_body_photo'] = $this->uploadApplicantPhoto($data['applicant_body_photo']);

		}

		$miss->slug = str_slug($data['name'].' '.$data['last_name'],'-');
		$miss->fill($data);
		if ($miss->save()) {
			$keyMiss = $miss->getKey();
			if ($photos) {
				foreach ($photos as $key => $photo) {
					$this->uploadPhoto($keyMiss,$photo);
				}
			}
			return  $this->find($keyMiss);
		} 
		return abort(500);
		
	}

	public function edit($id,$data)
	{
		$miss = $this->find($id);
		$photos = null;
		if ($miss) {
			if (array_key_exists('photos', $data)) {
				$photos = $data['photos'];
			}
			if (array_key_exists('name', $data) && array_key_exists('last_name', $data)) {
				$miss->slug = str_slug($data['name'].' '.$data['last_name'],'-');
			}
			$miss->fill($data);
			if($miss->update()){
				$keyMiss = $miss->getKey();
				if ($photos) {
					foreach ($photos as $key => $photo) {
						$this->uploadPhoto($keyMiss,$photo);
					}
				}
				return $this->find($keyMiss);
			}
		}

		return abort(500);

	}

	public function remove($id)
	{
		if ($miss = $this->find($id)) {
			$miss->delete();
			return true;
		}
		return abort(500);
	}


	private function pathUplod() {
		return public_path().'/uploads';
	}


	
	public function uploadApplicantPhoto($photo)
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


			$imageName = '_'.str_random().'.'. $photo->getClientOriginalExtension();
			if($image->save($this->pathUplod().'/'.$imageName)){
				return 'public/uploads/'.$imageName;
			}
		}
	}



	public function uploadPhoto($missId,$photo)
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


			$imageName = $missId.'_'.str_random().'.'. $photo->getClientOriginalExtension();
			if($image->save($this->pathUplod().'/'.$imageName)){
				$arrayModel['path'] = 'public/uploads/'.$imageName;
				// $paths[$key]['miss_id'] = $keyMiss;
			}
		}

		if ($arrayModel) {
			$miss = $this->find($missId);
			$arrayModel['is_landscape'] = $isLandScape;
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