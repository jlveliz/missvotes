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

    public function show($slug)
    {
    	if (!$slug) abort(404);
    	$miss = $this->missRepo->find(['slug' => $slug]);
    	if (!$miss) abort(404);
    	return view('frontend.pages.show-miss',compact('miss'));
    }
}
