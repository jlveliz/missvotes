<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\TicketVoteClientRequest;

use MissVote\RepositoryInterface\TicketVoteClientRepositoryInterface;

use MissVote\Models\TicketVote;

use Response;

use Redirect;

use Lang;


class TicketVoteClientController extends Controller
{
    
    private $voteTicketClient;

    public $raffles;

    public function __construct(TicketVoteClientRepositoryInterface $voteTicketClient)
    {
       $this->voteTicketClient = $voteTicketClient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       $raffles = $this->voteTicketClient->generateListRaffle()->paginate();
       return view('frontend.pages.raffle-ticket-vote.index',compact('raffles'));
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
    public function store(TicketVoteClientRequest $request)
    {
        $data = $request->all();
        $voteTicketClient = $this->voteTicketClient->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($voteTicketClient) {
            $sessionData['mensaje'] = 'Tickets creado Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'El Tickets no pudo ser creado, intente nuevamente';
        }
        
        return Redirect::action('TicketVoteController@edit',$voteTicketClient->id)->with($sessionData);
        
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
        $voteTicketClient = $this->voteTicketClient->find($id);
        return view('backend.ticket-vote.edit',[
            'voteTicketClient'=>$voteTicketClient
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(TicketVoteClientRequest $request, $id)
    {
        $data = $request->all();
        $voteTicketClient = $this->voteTicketClient->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($voteTicketClient) {
            $sessionData['mensaje'] = 'Ticket editado Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'El Ticket no pudo ser creado, intente nuevamente';
        }
        
        return Redirect::action('TicketVoteController@edit',$voteTicketClient->id)->with($sessionData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $voteTicketClient = $this->voteTicketClient->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($voteTicketClient) {
            $sessionData['mensaje'] = 'El ticket eliminado Satisfactoriamente';
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = 'El ticket no pudo ser eliminado, intente nuevamente';
        }
        
        return Redirect::action('TicketVoteController@index')->with($sessionData);
            
        
    }

    public function add(Request $request)
    {
        
        if (existOnCart($request->get('raffle_number'))) {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = Lang::get('raffle_ticket.cant_insert_same_number');
            return redirect()->back()->with($sessionData);
        }

        $item = $this->voteTicketClient->generateRaffle($request->get('raffle_number'));
        session()->push('cart',$item);
        
        //sum total
        $total = session()->has('total_sum') ? session()->get('total_sum') : 0 ;
        session()->put('total_sum',($total + $item['price']));
        return redirect()->back();
    }

    public function remove(Request $request)
    {
        if (existOnCart($request->get('raffle_number'))) {
            $cart = session()->get('cart');
            $ruffle = $this->voteTicketClient->generateRaffle($request->get('raffle_number'));
            foreach ($cart as $key => $itemCart) {
                if ($itemCart['raffle_number'] == $request->get('raffle_number')) {
                    unset($cart[$key]);
                }
            }

            //sum total
            $total = session()->has('total_sum') ? session()->get('total_sum') : 0 ;
            session()->put('total_sum',($total - $ruffle['price']));
            
            //validate if remove cache key
            if (count($cart) > 0) {
                session()->put('cart',$cart);
            } else {
                session()->forget('cart');
            }

            return redirect()->back();
        }
    }

    /**
     * search a ticket
     */
    public function query(Request $request)
    {
        if (!$request->has('query')) return redirect()->route('list.buy.ticket');
        
        $query = $request->get('query');
        $raffles = $this->voteTicketClient->generateListRaffle()->search($query)->paginate();
        if (!$raffles->total() > 0) {
            $message = Lang::get('raffle_ticket.tickets_not_found_query',['param'=>$query]);
            return view('frontend.pages.raffle-ticket-vote.index',compact('raffles','query','message'));
        }

        return view('frontend.pages.raffle-ticket-vote.index',compact('raffles','query'));
    }

}
