<?php

namespace MissVote\Http\Controllers;

use Illuminate\Http\Request;

use MissVote\Http\Requests\UserRequest;

use MissVote\RepositoryInterface\UserRepositoryInterface;

// use MissVote\RepositoryInterface\RoleRepositoryInterface;

use Response;

use Redirect;

class UserController extends Controller
{
    
    public $user;

    // public $role;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
        $this->middleware('auth');
         $this->middleware('can:acess-backend');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->user->enum();
        $data = [
            'users' => $users
        ];
        return view('backend.user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // $roles = $this->role->enum();
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $user = $this->user->save($data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($user) {
            $sessionData['mensaje'] =  trans('backend.user.create-edit.flag_success_saved');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.user.create-edit.flag_error_saved');
        }
        
        return Redirect::action('UserController@edit',$user->id)->with($sessionData);
        
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
        $user = $this->user->find($id);
        // $roles = $this->role->enum();

        // foreach ($roles as $key => $role) {
        //     foreach ($user->roles as $key => $rolUser) {
        //         if ($rolUser->id == $role->id) {
        //             $role->checked = true;
        //         } 
        //     }
        // }

        return view('backend.user.edit',[
            'user'=>$user,
            // 'roles'=>$roles
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        $user = $this->user->edit($id,$data);
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        if ($user) {
            $sessionData['mensaje'] = trans('backend.user.create-edit.flag_success_updated');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] = trans('backend.user.create-edit.flag_error_updated');
        }
        
        return Redirect::action('UserController@edit',$user->id)->with($sessionData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
        $user = $this->user->remove($id);
        
        $sessionData = [
            'tipo_mensaje' => 'success',
            'mensaje' => '',
        ];
        
        if ($user) {
            $sessionData['mensaje'] = trans('backend.user.create-edit.flag_success_deleted');
        } else {
            $sessionData['tipo_mensaje'] = 'error';
            $sessionData['mensaje'] =  trans('backend.user.create-edit.flag_error_deleted');
        }
        
        return Redirect::action('UserController@index')->with($sessionData);
            
        
    }
}
