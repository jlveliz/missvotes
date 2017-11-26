<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;
use MissVote\RepositoryInterface\MissRepositoryInterface;
use MissVote\RepositoryInterface\CountryRepositoryInterface;
use MissVote\RepositoryInterface\ConfigRepositoryInterface;
use MissVote\RepositoryInterface\VoteRepositoryInterface;
use MissVote\RepositoryInterface\ClientRepositoryInterface;
use MissVote\RepositoryInterface\TicketVoteClientRepositoryInterface;

class PdfExportController extends Controller
{
    private $applicant;
    private $country;
    private $config;
    private $voteRepo;
    private $clientRepo;
    private $voteTicket;

    public function __construct(MissRepositoryInterface $applicant, CountryRepositoryInterface $country, ConfigRepositoryInterface $config, VoteRepositoryInterface $voteRepo, ClientRepositoryInterface $clientRepo, TicketVoteClientRepositoryInterface $voteTicket)
    {
    	$this->applicant = $applicant;
    	$this->country = $country;
        $this->config = $config;
    	$this->voteRepo = $voteRepo;
        $this->clientRepo = $clientRepo;
        $this->voteTicket = $voteTicket;
    }


    public function applicants(Request $request)
    {
    	$applicants = $this->applicant->enum($request);
        $view = view()->make('backend.pdf.applicants',compact('applicants'))->render();
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHtml($view);
        return $pdf->stream('applicants.pdf');
    }


    public function resumeCasting(Request $request)
    {
    	if ($request->has('casting_id')) {
    		$resumeCasting = $this->country->getResumeCurrentCastings($request->get('casting_id'));
    		$currentCasting = $this->config->find(['key'=>$request->get('casting_id')]);
    		$totalNumApplies = 0;
    		$totalNumPreselected = 0;
    		$totalNumNoPreselected = 0;
    		$totalNumMissing = 0;

    		foreach ($resumeCasting as $key => $casting) {
    			$totalNumApplies+=$casting->counter;
    			$totalNumPreselected+=$casting->preselected;
    			$totalNumNoPreselected+=$casting->nopreselected;
    			$totalNumMissing+=$casting->missing;
    		}

    		$view = view()->make('backend.pdf.resume-casting',compact('resumeCasting','currentCasting','totalNumApplies','totalNumPreselected','totalNumNoPreselected','totalNumMissing'))->render();
        	$pdf = app()->make('dompdf.wrapper');
        	$pdf->loadHtml($view);
        	return $pdf->stream('resume-casting.pdf');
    	} else {
    		return back();
    	}
    }

    public function resumeTickets()
    {
        $votes = $this->voteRepo->ranking();
        $view = view()->make('backend.pdf.resume-tickets-ranking',compact('votes'))->render();
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHtml($view);
        return $pdf->stream('resume-tickets.pdf');
    }

    public function resumeMemberships()
    {
        $countUserMemberships = $this->clientRepo->countUserMemberships();
        $view = view()->make('backend.pdf.resume-memberships',compact('countUserMemberships'))->render();
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHtml($view);
        return $pdf->stream('resume-memberships.pdf');
    }

    public function resumeClientTickets()
    {
        $tickets = $this->voteTicket->enum();
        $view = view()->make('backend.pdf.resume-client-tickets',compact('tickets'))->render();
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadHtml($view);
        return $pdf->stream('resume-client-tickets.pdf');
    }

    public function precandidates()
    {
        # code...
    }
}
