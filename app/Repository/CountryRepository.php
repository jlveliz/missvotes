<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\CountryRepositoryInterface;
use MissVote\Models\Country;
use Image;
/**
* 
*/
class CountryRepository implements CountryRepositoryInterface
{
	
	public function enum($params = null)
	{
		$countries = Country::whereNotNull('flag_img')->orderBy('name')->get();
		
		if (!$countries) {
			throw new CountryException("No se han encontrado cientes",404);
		}
		return $countries;
	}

	public function find($field, $returnException = true)
	{
		if (is_array($field)) {
			if (array_key_exists('name', $field)) { 
				$country = Country::where('name',$field['name'])->first();
			} elseif (array_key_exists('code', $field)) {
				$country = Country::where('code',$field['code'])->first();
			} else {
				abort(500);
			}
		} elseif (is_string($field) || is_int($field)) {
		
			$country = Country::where('id',$field)->first();
		}

		if ($returnException) {
			if (!$country) abort(404);
		} else {
			if (!$country) return false;
		}
		
		return $country;

	}

	//TODO
	public function save($data)
	{
		$country = new Country();
		$country->fill($data);
		if ($country->save()) {
			$key = $country->getKey();
			return  $this->find($key);
		} 
		abort(500);
		
	}

	public function edit($id,$data)
	{
		$country = $this->find($id);

		if ($country) {
			$country->fill($data);
			if($country->update()){
				$key = $country->getKey();
				return $this->find($key);
			}
		}

		abor(500);

	}

	public function remove($id)
	{
		if ($country = $this->find($id)) {
			$country->delete();
			return true;
		}
		abort(500);
	}

	// private function pathUplod() {
	// 	return public_path().'/uploads/profiles';
	// }


	// public function uploadPhoto($countryId,$photo)
	// {
	// 	if ($photo->isValid()) {
			
	// 		$realPath = $photo->getRealPath();
	// 		$image = Image::make($realPath);
			
	// 		$image->resize(550,550,function($constraint){
	// 				$constraint->aspectRatio();
	// 		});


	// 		$imageName = $countryId.'_'.str_random().'.'. $photo->getCountryOriginalExtension();
	// 		if($image->save($this->pathUplod().'/'.$imageName)){
	// 			return 'public/uploads/profiles/'.$imageName; 
	// 		} else {
	// 			return false;
	// 		}
	// 	}

	// 	return false;
	// }


}