<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Repository\MissRepository;

class WebsiteController extends Controller
{
    
	private $missRepo;


	public function __construct(MissRepository $missRepo)
	{
		$this->missRepo = $missRepo;
	}

    public function index()
    {
    	$misses = $this->missRepo->enum(['state' => 1]);
    	return view('frontend.pages.home',['misses'=>$misses]);
    }
}
