<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\CountryRequest;

use MissVote\RepositoryInterface\CountryRepositoryInterface;

use Response;

use Redirect;

class CountryController extends Controller
{
    
    public $country;


    public function __construct(countryRepositoryInterface $country)
    {
        $this->middleware('auth');
        $this->middleware('can:acess-backend');
        $this->country = $country;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $countries = $this->country->enum();
        $data = [
            'countries' => $countries
        ];
        return view('backend.country.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(countryRequest $request)
    {
        $data = $request->all();
        $country = $this->country->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($country) {
            $sessionData['mensaje'] = trans('backend.country.create-edit.flag_success_saved');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.country.create-edit.flag_error_saved');
        }
        
        return Redirect::action('countryController@edit',$country->id)->with($sessionData);
        
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
        $country = $this->country->find($id);
        return view('backend.country.edit',['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(countryRequest $request, $id)
    {
        $data = $request->all();
        $country = $this->country->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($country) {
            $sessionData['mensaje'] = trans('backend.country.create-edit.flag_success_updated');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.country.create-edit.flag_error_updated');
        }
        
        return Redirect::action('countryController@edit',$country->id)->with($sessionData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $country = $this->country->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($country) {
            $sessionData['mensaje'] = trans('backend.country.create-edit.flag_success_deleted');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.country.create-edit.flag_error_deleted');
        }
        
        return Redirect::action('countryController@index')->with($sessionData);
            
        
    }
}
