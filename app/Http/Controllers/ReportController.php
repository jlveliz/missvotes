<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\VoteRepositoryInterface;
use MissVote\RepositoryInterface\ClientRepositoryInterface;
use MissVote\RepositoryInterface\TicketVoteClientRepositoryInterface;
use MissVote\RepositoryInterface\CountryRepositoryInterface;

class ReportController extends Controller
{
    
	private $voteRepo;
	private $clientRepo;
	private $voteTicket;
	private $countryRepo;


	public function __construct(VoteRepositoryInterface $voteRepo, ClientRepositoryInterface $clientRepo,TicketVoteClientRepositoryInterface $voteTicket, CountryRepositoryInterface $countryRepo)
	{
		$this->middleware('auth');
        $this->middleware('can:acess-backend');
		$this->voteRepo = $voteRepo;
		$this->clientRepo = $clientRepo;
		$this->voteTicket = $voteTicket;
		$this->countryRepo = $countryRepo;
	}

    public function dashboard()
    {
    	$votes = $this->voteRepo->ranking();
    	$countUserMemberships = $this->clientRepo->countUserMemberships();
    	$tickets = $this->voteTicket->enum();
    	$resumeCastingOne = $this->countryRepo->getResumeCurrentCastings('casting_1');
    	$resumeCastingTwo = $this->countryRepo->getResumeCurrentCastings('casting_2');
    	return view('backend.dashboard.index',compact('votes','countUserMemberships','tickets','resumeCastingOne','resumeCastingTwo'));
    }
}
