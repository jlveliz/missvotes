<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\TicketVoteRequest;

use MissVote\RepositoryInterface\TicketVoteRepositoryInterface;

use MissVote\Models\TicketVote;

use Response;

use Redirect;
//paginator 
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TicketVoteController extends Controller
{
    
    private $voteTicket;

    public function __construct(TicketVoteRepositoryInterface $voteTicket)
    {
       $this->voteTicket = $voteTicket;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $searchResults = [
            'item1',
            'item2',
            'item3',
            'item4',
            'item5',
            'item6',
            'item7',
            'item8',
            'item9',
            'item10'
            ];

        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($searchResults);

        //Define how many items we want to be visible in each page
        $perPage = 5;

        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice($currentPage * $perPage, $perPage)->all();

        //Create our paginator and pass it to the view
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        return view('frontend.pages.raffle-ticket-vote.index',compact('paginatedSearchResults'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       return view('backend.ticket-vote.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(TicketVoteRequest $request)
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
        
        return Redirect::action('TicketVoteController@edit',$voteTicket->id)->with($sessionData);
        
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
        return view('backend.ticket-vote.edit',[
            'voteTicket'=>$voteTicket
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(TicketVoteRequest $request, $id)
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
        
        return Redirect::action('TicketVoteController@edit',$voteTicket->id)->with($sessionData);
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
        
        return Redirect::action('TicketVoteController@index')->with($sessionData);
            
        
    }

}
