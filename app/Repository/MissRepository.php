<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\MissRepositoryInterface;
use MissVote\Models\Miss;
use MissVote\Repository\ConfigRepository;
use Illuminate\Http\Request;
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

	public function enum($request = null)
	{
		return Miss::all();
	}

	public function enumApplicants($request)
	{
		
		if ($request) {
			

			if ($request->has('casting_id')) {
				$query = Miss::whereRaw("country_id in (SELECT id from country where casting_id = ".$request->get('casting_id')." )");
			}
			
			if($request->has('country_id') && $request->get('country_id') != 'null'){
				$query->where('country_id',$request->get('country_id'));
			}

			if ($request->has('state') && $request->get('state') != 'null') {
				//si envian un parametro indebido
				if ($request->get('state') >= Miss::PRECANDIDATE) {
					$query->where('state','<=',Miss::NOPRESELECTED);
				} else{
					$query->where('state',$request->get('state'));
				}
			} else{
				$query->where('state','<',Miss::PRECANDIDATE);
			}

			if ($request->has('date_from') && $request->has('date_to')) {
				$query->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') between '".$request->get('date_from')."' and '".$request->get('date_to')."'");
			}
			return $misses = $query->get();
			
			
		} else {
			$misses = Miss::where('state','<=',Miss::NOPRESELECTED)->get();
			
		}

		if (!$misses) {
			abort(404);
		}
		return $misses;
	}

	public function enumPrecandidates($request)
	{
		if ($request->all()) {

			if ($request->has('state') && $request->get('state') != 'null') {
				//si envian un parametro indebido
				if ($request->get('state') >= Miss::CANDIDATE || $request->get('state') <= Miss::NOPRESELECTED) {
					$query = Miss::whereBetween('state',[Miss::PRECANDIDATE,Miss::DISQUALIFIEDPRECANDIDATE]);
				} else{
					$query = Miss::where('state',$request->get('state'));
				}
			} else{
				$query = Miss::whereBetween('state',[Miss::PRECANDIDATE,Miss::DISQUALIFIEDPRECANDIDATE]);
			}

			if($request->has('country_id') && $request->get('country_id') != 'null'){
				$query->where('country_id',$request->get('country_id'));
			}

			if ($request->has('date_from') && $request->has('date_to')) {
				$query->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') between '".$request->get('date_from')."' and '".$request->get('date_to')."'");
			}


		} else {
			$query = Miss::whereBetween('state',[Miss::PRECANDIDATE,Miss::DISQUALIFIEDPRECANDIDATE]);
		}

		$misses = $query->get();

		return $misses;
	}

	public function enumCandidates($request)
	{
		if ($request->all()) {

			if ($request->has('state') && $request->get('state') != 'null') {
				//si envian un parametro indebido
				if ($request->get('state') <=  Miss::DISQUALIFIEDPRECANDIDATE) {
					$query = Miss::whereBetween('state',[Miss::CANDIDATE,Miss::DISQUALIFIEDCANDIDATE]);
				} else{
					$query = Miss::where('state',$request->get('state'));
				}
			} else{
				$query = Miss::whereBetween('state',[Miss::CANDIDATE,Miss::DISQUALIFIEDCANDIDATE]);
			}

			if($request->has('country_id') && $request->get('country_id') != 'null'){
				$query->where('country_id',$request->get('country_id'));
			}

			if ($request->has('date_from') && $request->has('date_to')) {
				$query->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') between '".$request->get('date_from')."' and '".$request->get('date_to')."'");
			}


		} else {
			$query = Miss::whereBetween('state',[Miss::CANDIDATE,Miss::DISQUALIFIEDCANDIDATE]);
		}

		$misses = $query->get();

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


	public function getSocialNetworkMoreUsed($casting,$limit = 1, $countryId = null)
	{
		$query = Miss::selectRaw("case
				when miss.how_did_you_hear_about_us  like '%facebook%' then 'Facebook'
				when miss.how_did_you_hear_about_us  like '%friend%' then 'Friend'
				when miss.how_did_you_hear_about_us  like '%former_contestant%' then 'Former Contestant'
				when miss.how_did_you_hear_about_us  like '%instagram%' then 'Instagram'
				when miss.how_did_you_hear_about_us  like '%online_ad%' then 'Online AD'
				when miss.how_did_you_hear_about_us  like '%school_teacher%' then 'School Teacher/Coach'
				when miss.how_did_you_hear_about_us  like '%website_google%' then 'Website / Google Search'
			end as occurrence, count(country.id) as counter")
				->leftJoin('country','miss.country_id','=','country.id');
		if ($countryId) {
			$query->whereRaw("country.id = '".$countryId."'");
		}
		$query->whereRaw("miss.state < 3
					and country.casting_id = ( SELECT config.id FROM config WHERE config.key = '".$casting."')
					GROUP BY miss.how_did_you_hear_about_us
					ORDER BY COUNT(*) desc")->limit($limit);
		if ($limit > 1) {
			return $query->get();
		} else {
			return $query->first();
		}
	}

	public function getAllSocialNetworkMoreUsed($castingId = null)
	{
		$query = Miss::selectRaw("country.name as country ,
			case
				when miss.how_did_you_hear_about_us  like '%facebook%' then 'Facebook'
				when miss.how_did_you_hear_about_us  like '%friend%' then 'Friend'
				when miss.how_did_you_hear_about_us  like '%former_contestant%' then 'Former Contestant'
				when miss.how_did_you_hear_about_us  like '%instagram%' then 'Instagram'
				when miss.how_did_you_hear_about_us  like '%online_ad%' then 'Online AD'
				when miss.how_did_you_hear_about_us  like '%school_teacher%' then 'School Teacher/Coach'
				when miss.how_did_you_hear_about_us  like '%website_google%' then 'Website / Google Search'
			end as occurrence, 
			count(country.id) as counter")->leftJoin('country','miss.country_id','=','country.id');
		if ($castingId) {
			$query->whereRaw("country.casting_id = ( SELECT config.id FROM config WHERE config.key = '".$castingId."')");
		}
		$query->whereRaw("miss.state < 3
					GROUP BY country.name
					ORDER BY COUNT(*) ASC");
		$data = $query->limit(3)->get();
		return $data;
	}

	public function getSocialNetworkGroupCountry($castingId)
	{
		$query = Miss::selectRaw("country.name as country ,
			case
				when miss.how_did_you_hear_about_us  like '%facebook%' then 'Facebook'
				when miss.how_did_you_hear_about_us  like '%friend%' then 'Friend'
				when miss.how_did_you_hear_about_us  like '%former_contestant%' then 'Former Contestant'
				when miss.how_did_you_hear_about_us  like '%instagram%' then 'Instagram'
				when miss.how_did_you_hear_about_us  like '%online_ad%' then 'Online AD'
				when miss.how_did_you_hear_about_us  like '%school_teacher%' then 'School Teacher/Coach'
				when miss.how_did_you_hear_about_us  like '%website_google%' then 'Website / Google Search'
			end as occurrence, count(DISTINCT(country.name)) as counter")->leftJoin('country','miss.country_id','=','country.id')->whereRaw("miss.state < 3
					and country.casting_id = ( select config.id from config where config.key = '".$castingId."')
					GROUP BY  miss.how_did_you_hear_about_us
					ORDER BY COUNT(DISTINCT(country.name)) DESC")->get();
		return $query;
	}

}