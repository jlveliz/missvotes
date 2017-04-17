<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\VoteRepositoryInterface;

class ReportController extends Controller
{
    
	private $voteRepo;


	public function __construct(VoteRepositoryInterface $voteRepo)
	{
		$this->middleware('auth');
        $this->middleware('can:acess-backend');
		$this->voteRepo = $voteRepo;
	}

    public function ranking()
    {
    	$votes = $this->voteRepo->ranking();
    	return view('backend.reports.ranking-miss',compact('votes'));
    }
}
