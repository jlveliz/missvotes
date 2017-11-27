<?php
namespace  MissVote\RepositoryInterface;

interface  MissRepositoryInterface extends CoreRepositoryInterface {
	
	public function paginate();

	public function uploadApplicantPhoto($photo);

	public function uploadPhoto($key,$photo);

	public function enumPrecandidates($request);

	public function enumApplicants($request);

	public function enumCandidates($request);


}