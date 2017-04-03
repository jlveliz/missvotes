<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\VoteRequest;

use MissVote\RepositoryInterface\VoteRepositoryInterface;

use Response;

use Redirect;

class VoteController extends Controller
{
    
    public $vote;

   
    public function __construct(VoteRepositoryInterface $vote)
    {
        $this->vote = $vote;
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
        $data = $request->all();
        $data['value'] = 1;
        $data['type'] = 'membership_normal';
        $vote = $this->vote->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($vote) {
            $sessionData['mensaje'] = 'Gracias por su votación';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'El voto no pudo ser procesado, intente nuevamente.';
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
