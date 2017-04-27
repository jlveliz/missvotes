<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\TicketVoteRequest;

use MissVote\RepositoryInterface\TicketVoteRepositoryInterface;

use MissVote\Models\TicketVote;

use Response;

use Redirect;

use Lang;


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
       $raffles = $this->voteTicket->generateListRaffle()->paginate();
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

    public function add(Request $request)
    {
        
        if (existOnCart($request->get('raffle_number'))) {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = Lang::get('raffle_ticket.cant_insert_same_number');
            return redirect()->back()->with($sessionData);
        }

        $item = $this->voteTicket->generateRaffle($request->get('raffle_number'));
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
            $ruffle = $this->voteTicket->generateRaffle($request->get('raffle_number'));
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

}
