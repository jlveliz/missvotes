<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\VoteRepositoryInterface;
use MissVote\RepositoryInterface\ClientRepositoryInterface;
use MissVote\RepositoryInterface\TicketVoteClientRepositoryInterface;

class ReportController extends Controller
{
    
	private $voteRepo;
	private $clientRepo;
	private $voteTicket;


	public function __construct(VoteRepositoryInterface $voteRepo, ClientRepositoryInterface $clientRepo,TicketVoteClientRepositoryInterface $voteTicket)
	{
		$this->middleware('auth');
        $this->middleware('can:acess-backend');
		$this->voteRepo = $voteRepo;
		$this->clientRepo = $clientRepo;
		$this->voteTicket = $voteTicket;
	}

    public function dashboard()
    {
    	$votes = $this->voteRepo->ranking();
    	$countUserMemberships = $this->clientRepo->countUserMemberships();
    	$tickets = $this->voteTicket->enum();
    	return view('backend.dashboard.index',compact('votes','countUserMemberships','tickets'));
    }
}
