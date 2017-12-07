<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\RepositoryInterface\VoteRepositoryInterface;
use MissVote\RepositoryInterface\ClientRepositoryInterface;
use MissVote\RepositoryInterface\TicketVoteClientRepositoryInterface;
use MissVote\RepositoryInterface\CountryRepositoryInterface;
use MissVote\RepositoryInterface\ConfigRepositoryInterface;
use MissVote\RepositoryInterface\MissRepositoryInterface;

class ReportController extends Controller
{
    
	private $voteRepo;
	private $clientRepo;
	private $voteTicket;
    private $countryRepo;
    private $config;
	private $missRepo;


	public function __construct(VoteRepositoryInterface $voteRepo, ClientRepositoryInterface $clientRepo,TicketVoteClientRepositoryInterface $voteTicket, CountryRepositoryInterface $countryRepo,ConfigRepositoryInterface $config, MissRepositoryInterface $missRepo)
	{
		$this->middleware('auth');
        $this->middleware('can:acess-backend');
		$this->voteRepo = $voteRepo;
		$this->clientRepo = $clientRepo;
		$this->voteTicket = $voteTicket;
        $this->countryRepo = $countryRepo;
        $this->config = $config;
		$this->missRepo = $missRepo;
	}

    public function dashboard()
    {
    	$votes = $this->voteRepo->ranking();
    	$countUserMemberships = $this->clientRepo->countUserMemberships();
    	$tickets = $this->voteTicket->getAvailableAndPurchased();
        $socialMediaMoreUsed = $this->missRepo->getAllSocialNetworkMoreUsed();
        return view('backend.dashboard.index',compact('votes','countUserMemberships','tickets','socialMediaMoreUsed'));

    }


    public function reportCasting($castingKey)
    {
        $resumeCasting = $this->countryRepo->getResumeCurrentCastings($castingKey);
    	$socialMoreUsed = $this->missRepo->getSocialNetworkMoreUsed($castingKey);
        $socialMediaMoreUsed = $this->missRepo->getSocialNetworkMoreUsed($castingKey, 3);
        if ($socialMoreUsed) {
            $socialMoreUsed = $socialMoreUsed->occurrence;
        }
        $casting = $this->config->find(['key'=>$castingKey]);
    	return view('backend.reports.resume-casting',compact('resumeCasting','casting','socialMoreUsed','socialMediaMoreUsed'));
    }
}
