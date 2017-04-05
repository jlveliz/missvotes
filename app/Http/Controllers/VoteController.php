<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\VoteRequest;

use MissVote\RepositoryInterface\VoteRepositoryInterface;

use MissVote\RepositoryInterface\ClientRepositoryInterface;

use Response;

use Redirect;

use Auth;

class VoteController extends Controller
{
    
    public $vote;

    public $clientRepo;

   
    public function __construct(VoteRepositoryInterface $vote, ClientRepositoryInterface $clientRepo)
    {
        $this->vote = $vote;
        $this->clientRepo =  $clientRepo;

        // $this->middleware('auth');
        // $this->middleware('can:acess-backend');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(VoteRequest $request)
    {
        if($this->authorize('vote',Auth::user()) ) {
            $data = $request->all();
            //find a client
            $client = $this->clientRepo->find(Auth::user()->id);
            //find a val vote
            $valVote = $client &&  $client->current_membership() ? $client->current_membership()->membership->points_per_vote :  config('vote.vote-default');
            //find a membership
            $typeMembership = $client &&  $client->current_membership() ? $client->current_membership()->membership->name :  config('vote.type-membership-default');

            $data['value'] = $valVote;
            $data['type']  = $typeMembership;
            
            $vote = $this->vote->save($data);
            
            $sessionData = [
                'tipo_mensaje' => 'success',
                'mensaje' => '',
            ];

            if (!$vote) {
                $sessionData['tipo_mensaje'] = 'error';
                $sessionData['mensaje'] = 'El voto no pudo ser procesado, intente nuevamente.';  
            } 
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'No tiene derecho a realizar esta acción.';
        }
        
        return Redirect::back()->with($sessionData);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(VoteRequest $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
       
        
    }
}
