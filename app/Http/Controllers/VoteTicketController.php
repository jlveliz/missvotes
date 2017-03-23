<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\VoteTicketRequest;

use MissVote\RepositoryInterface\VoteTicketRepositoryInterface;

use MissVote\Models\VoteTicket;

use Response;

use Redirect;

class VoteTicketController extends Controller
{
    
    private $voteTicket;

    public function __construct(VoteTicketRepositoryInterface $voteTicket)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->voteTicket = $voteTicket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $voteTickets = $this->voteTicket->enum();
        $data = [
            'voteTickets' => $voteTickets
        ];
        return view('backend.vote-ticket.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       return view('backend.vote-ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(VoteTicketRequest $request)
    {
        $data = $request->all();
        $voteTicket = $this->voteTicket->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($voteTicket) {
            $sessionData['mensaje'] = 'Tickets creado Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'El Tickets no pudo ser creado, intente nuevamente';
        }
        
        return Redirect::action('VoteTicketController@edit',$voteTicket->id)->with($sessionData);
        
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
        $voteTicket = $this->voteTicket->find($id);
        return view('backend.vote-ticket.edit',[
            'voteTicket'=>$voteTicket
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(VoteTicketRequest $request, $id)
    {
        $data = $request->all();
        $voteTicket = $this->voteTicket->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($voteTicket) {
            $sessionData['mensaje'] = 'Ticket editado Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'El Ticket no pudo ser creado, intente nuevamente';
        }
        
        return Redirect::action('VoteTicketController@edit',$voteTicket->id)->with($sessionData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $voteTicket = $this->voteTicket->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($voteTicket) {
            $sessionData['mensaje'] = 'El ticket eliminado Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'El ticket no pudo ser eliminado, intente nuevamente';
        }
        
        return Redirect::action('VoteTicketController@index')->with($sessionData);
            
        
    }

}
