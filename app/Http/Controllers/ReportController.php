<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\VoteRepositoryInterface;
use MissVote\RepositoryInterface\ClientRepositoryInterface;

class ReportController extends Controller
{
    
	private $voteRepo;
	private $clientRepo;


	public function __construct(VoteRepositoryInterface $voteRepo, ClientRepositoryInterface $clientRepo)
	{
		$this->middleware('auth');
        $this->middleware('can:acess-backend');
		$this->voteRepo = $voteRepo;
		$this->clientRepo = $clientRepo;
	}

    public function ranking()
    {
    	$votes = $this->voteRepo->ranking();
    	$countUserMemberships = $this->clientRepo->countUserMemberships();
    	return view('backend.dashboard.index',compact('votes','countUserMemberships'));
    }
}
