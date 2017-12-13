<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;
use MissVote\RepositoryInterface\MissRepositoryInterface;
use MissVote\RepositoryInterface\CountryRepositoryInterface;
use MissVote\RepositoryInterface\ConfigRepositoryInterface;
use MissVote\RepositoryInterface\VoteRepositoryInterface;
use MissVote\RepositoryInterface\ClientRepositoryInterface;
use MissVote\RepositoryInterface\TicketVoteClientRepositoryInterface;
use Excel;

class ExportController extends Controller
{
    private $miss;
    private $country;
    private $config;
    private $voteRepo;
    private $clientRepo;
    private $voteTicket;

    public function __construct(MissRepositoryInterface $miss, CountryRepositoryInterface $country, ConfigRepositoryInterface $config, VoteRepositoryInterface $voteRepo, ClientRepositoryInterface $clientRepo, TicketVoteClientRepositoryInterface $voteTicket)
    {
    	$this->miss = $miss;
    	$this->country = $country;
        $this->config = $config;
    	$this->voteRepo = $voteRepo;
        $this->clientRepo = $clientRepo;
        $this->voteTicket = $voteTicket;
    }


    public function applicants(Request $request)
    {
    	$format = false;
        $applicants = $this->miss->enumApplicants($request);
        if ($request->has('format')) {
            $format = true;
            Excel::create('applicants.pdf',function($excel) use ($applicants,$format){
                $excel->sheet('New',function($sheet) use($applicants,$format){
                   $sheet->loadView('backend.pdf.applicants',compact('applicants','format'));
                });
            })->export('xls');
        } else {
            $view = view()->make('backend.pdf.applicants',compact('applicants','format'))->render();
            $pdf = app()->make('dompdf.wrapper');
            $pdf->loadHtml($view);
            return $pdf->stream('applicants.pdf');
        }
    }


    public function resumeCasting(Request $request)
    {
      
        $format = false;
        if ($request->has('casting_id')) {
    		$resumeCasting = $this->country->getResumeCurrentCastings($request->get('casting_id'));
            $socialMoreUsed = $this->miss->getSocialNetworkMoreUsed($request->get('casting_id'));
            if ($socialMoreUsed) {
                $socialMoreUsed = $socialMoreUsed->occurrence;
            }
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

            if ($request->has('format')) {
                $format = true;
                Excel::create('resume-casting',function($excel) use ($resumeCasting,$currentCasting,$totalNumApplies,$format,$totalNumPreselected,$totalNumNoPreselected,$totalNumMissing, $socialMoreUsed){
                    $excel->sheet('New',function($sheet) use($resumeCasting,$currentCasting,$totalNumApplies,$format,$totalNumPreselected,$totalNumNoPreselected,$totalNumMissing, $socialMoreUsed){
                       $sheet->loadView('backend.pdf.resume-casting',compact('resumeCasting','currentCasting','totalNumApplies','totalNumPreselected','totalNumNoPreselected','totalNumMissing','format','socialMoreUsed'));
                    });
                })->export('xls');
            } else {
        		$view = view()->make('backend.pdf.resume-casting',compact('resumeCasting','currentCasting','totalNumApplies','totalNumPreselected','totalNumNoPreselected','totalNumMissing','format','socialMoreUsed'))->render();
            	$pdf = app()->make('dompdf.wrapper');
            	$pdf->loadHtml($view);
            	return $pdf->stream('resume-casting.pdf');
            }

    	} else {
    		return back();
    	}
    }

    public function resumeTickets($format = null)
    {
        $votes = $this->voteRepo->ranking();
        
        if ($format) {
            Excel::create('resume-tickets',function($excel) use ($votes,$format){
                $excel->sheet('New',function($sheet) use($votes,$format){
                   $sheet->loadView('backend.pdf.resume-tickets-ranking',compact('votes','format'));
                });
            })->export('xls');
        } else {
            $view = view()->make('backend.pdf.resume-tickets-ranking',compact('votes','format'))->render();
            $pdf = app()->make('dompdf.wrapper');
            $pdf->loadHtml($view);
            return $pdf->stream('resume-tickets.pdf');
        }
    }

    public function resumeMemberships($format = null)
    {
        $countUserMemberships = $this->clientRepo->countUserMemberships();

        if ($format) {
            Excel::create('resume-memberships',function($excel) use ($countUserMemberships,$format){
                $excel->sheet('New',function($sheet) use($countUserMemberships,$format){
                   $sheet->loadView('backend.pdf.resume-memberships',compact('countUserMemberships','format'));
                });
            })->export('xls');
        } else {
            $view = view()->make('backend.pdf.resume-memberships',compact('countUserMemberships','format'))->render();
            $pdf = app()->make('dompdf.wrapper');
            $pdf->loadHtml($view);
            return $pdf->stream('resume-memberships.pdf');
        }
        
    }

    public function resumeClientTickets($format = null)
    {
        $tickets = $this->voteTicket->getAvailableAndPurchased();

        if ($format) {
            Excel::create('resume-client-tickets',function($excel) use ($tickets,$format){
                $excel->sheet('New',function($sheet) use($tickets,$format){
                   $sheet->loadView('backend.pdf.resume-client-tickets',compact('tickets','format'));
                });
            })->export('xls');
        } else {
            $view = view()->make('backend.pdf.resume-client-tickets',compact('tickets','format'))->render();
            $pdf = app()->make('dompdf.wrapper');
            $pdf->loadHtml($view);
            return $pdf->stream('resume-client-tickets.pdf');
        }
    }

    public function precandidates(Request $request)
    {
        $format = false;
        $precandidates = $this->miss->enumPrecandidates($request);
        if ($request->has('format')) {
            $format = true;
            Excel::create('precandidates',function($excel) use ($precandidates,$format){
                $excel->sheet('New',function($sheet) use($precandidates,$format){
                   $sheet->loadView('backend.pdf.precandidates',compact('precandidates','format'));
                });
            })->export('xls');
        } else {
            $view = view()->make('backend.pdf.precandidates',compact('precandidates','format'))->render();
            $pdf = app()->make('dompdf.wrapper');
            $pdf->loadHtml($view);
            return $pdf->stream('precandidates.pdf');
        }
    }

    public function candidates(Request $request)
    {
        $format = false;
        $candidates = $this->miss->enumCandidates($request);

         if ($request->has('format')) {
            $format = true;
            Excel::create('candidates',function($excel) use ($candidates,$format){
                $excel->sheet('New',function($sheet) use($candidates,$format){
                   $sheet->loadView('backend.pdf.candidates',compact('candidates','format'));
                });
            })->export('xls');
        } else {
            $view = view()->make('backend.pdf.candidates',compact('candidates','format'))->render();
            $pdf = app()->make('dompdf.wrapper');
            $pdf->loadHtml($view);
            return $pdf->stream('candidates.pdf');
        }
    }

    public function resumeSocialNetwork($casting = null ,$format = null)
    {
        $networks = $this->miss->getAllSocialNetworkMoreUsed($casting);
        if ($format) {
            Excel::create('networks-used',function($excel) use ($networks,$format, $casting){
                $excel->sheet('New',function($sheet) use($networks,$format, $casting){
                   $sheet->loadView('backend.pdf.network-casting',compact('networks','format','casting'));
                });
            })->export('xls');
        } else {
            $view = view()->make('backend.pdf.network-casting',compact('networks','format','casting'))->render();
            $pdf = app()->make('dompdf.wrapper');
            $pdf->loadHtml($view);
            return $pdf->stream('networks-used.pdf');
        }
    }

    public function resumeSocialNetworkCasting(Request $request)
    {
        $countryId = $request->get('country_id');
        if ($countryId != 'null') {
            $socialMediaMoreUsed = $this->miss->getSocialNetworkMoreUsed($request->get('casting_id'), 3, $countryId);
        } else {
            $socialMediaMoreUsed = $this->miss->getSocialNetworkMoreUsed($request->get('casting_id'), 3);
            
        }
        $format = false;
        if ($request->has('format')) {
            $format = true;
            Excel::create('networks-used',function($excel) use ($socialMediaMoreUsed,$format){
                $excel->sheet('New',function($sheet) use($socialMediaMoreUsed,$format){
                   $sheet->loadView('backend.pdf.network-casting-2',compact('socialMediaMoreUsed','format'));
                });
            })->export('xls');
        } else {
            $view = view()->make('backend.pdf.network-casting-2',compact('socialMediaMoreUsed','format'))->render();
            $pdf = app()->make('dompdf.wrapper');
            $pdf->loadHtml($view);
            return $pdf->stream('networks-used.pdf');
        }
    }
}
