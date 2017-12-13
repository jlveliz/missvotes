<?php
namespace MissVote\Repository;

use MissVote\RepositoryInterface\CountryRepositoryInterface;
use MissVote\Repository\ConfigRepository;
use MissVote\Models\Country;
use MissVote\Models\Miss;
use DB;
use Image;
/**
* 
*/
class CountryRepository implements CountryRepositoryInterface
{
	
	public function enum($params = null)
	{
		if ($params) {
			if (is_array($params) && array_key_exists('with_flags', $params)) {
				$countries = Country::whereNotNull('flag_img')->orderBy('name')->get();
			}
		} else {
			$countries = Country::orderBy('name')->get();
		}
		
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
		$photo = $data['flag_img'];
		$data['flag_img'] = $this->uploadPhoto($photo);
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
			if (array_key_exists('flag_img', $data)) {
				$data['flag_img'] = $this->uploadPhoto($data['flag_img']);
			}
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

	private function pathUplod() {
		return public_path().'/images';
	}


	public function uploadPhoto($photo)
	{
		if ($photo->isValid()) {
			
			$realPath = $photo->getRealPath();
			$image = Image::make($realPath);
			
			$image->resize(168,167,function($constraint){
					$constraint->aspectRatio();
			});


			$imageName = '_'.str_random().'.'. $photo->getClientOriginalExtension();
			if($image->save($this->pathUplod().'/'.$imageName)){
				return $imageName; 
			} else {
				return false;
			}
		}

		return false;
	}


	public function getAvailableCountries()
	{
		return Country::whereNull('casting_id')->whereNotNull('flag_img')->get();
	}

	public function getSelectedCountries($castingId  = null)
	{
		$casting =  ConfigRepository::getCurrentCasting();
		if ($casting) {
			return Country::where('casting_id',$casting->id)->whereNotNull('flag_img')->orderBy('name')->get();
		}
	}


	public function getResumeCurrentCastings($casting)
	{
		
		return Country::selectRaw("country.id as country_id,country.casting_id as casting_id,country.name country , (select count(miss.code) from miss where miss.state <= '".MISS::NOPRESELECTED."' and country.id = miss.country_id) counter,
				(select count(miss.id) from miss where miss.state = '".MISS::PRESELECTED."' and country.id = miss.country_id) preselected,
				(select count(miss.id) from miss where miss.state = '".MISS::NOPRESELECTED."' and country.id = miss.country_id) nopreselected,
				(select count(miss.id) from miss where miss.state = '".MISS::FORRATING."' and country.id = miss.country_id) missing,
				concat((SELECT case
				when miss.how_did_you_hear_about_us  like '%facebook%' then 'Facebook'
				when miss.how_did_you_hear_about_us  like '%friend%' then 'Friend'
				when miss.how_did_you_hear_about_us  like '%former_contestant%' then 'Former Contestant'
				when miss.how_did_you_hear_about_us  like '%instagram%' then 'Instragram'
				when miss.how_did_you_hear_about_us  like '%online_ad%' then 'Online AD'
				when miss.how_did_you_hear_about_us  like '%school_teacher%' then 'School Teacher/Coach'
				when miss.how_did_you_hear_about_us  like '%website_google%' then 'Website / Google Search'
			end as occurrence FROM miss WHERE miss.state < 3 AND country.id = miss.country_id
					GROUP BY miss.how_did_you_hear_about_us
					ORDER BY COUNT(*) desc
					limit 1), ' (', (SELECT count(miss.how_did_you_hear_about_us) as occurrence FROM miss WHERE miss.state < 3 AND country.id = miss.country_id
					GROUP BY miss.how_did_you_hear_about_us
					ORDER BY COUNT(*) desc
					limit 1), ')') network
				")
				->leftJoin('miss','miss.country_id','=','country.id')
				->whereRaw("country.casting_id = ( SELECT config.id FROM config WHERE config.key = '".$casting."')")
				->groupBy('country.name')
				->get();

	}

}