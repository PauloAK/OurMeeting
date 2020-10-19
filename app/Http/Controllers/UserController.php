<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\User\Store;
use App\Http\Requests\User\Update;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        return view("modules.users.index")->with(compact(
            'users'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::orderBy('name')->get()->pluck('name', 'id');
        return view("modules.users.create")->with(compact(
            'departments'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\Store  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $data = $request->all();

        // Get the department register
        $department_id = $data['department'];
        unset($data['department']);

        // Turn the password to a hash
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if (!$user){
            toastr()->error('Houve um erro ao cadastrar o usuário!');
            return redirect()->back()->withInput();
        }

        // Attach the user to the department
        $department = Department::find($department_id);
        $user->department()->associate($department);
        $user->save();

        toastr()->success('Usuário cadastrado com sucesso');
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $departments = Department::orderBy('name')->get()->pluck('name', 'id');
        return view("modules.users.edit")->with(compact(
            'user',
            'departments'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\Update  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, User $user)
    {
        // Change password action
        if ( $request->has('new_password') && $request->input('new_password') ) {
            // Check if the current password is correct
            if ( !Hash::check($request->input('current_password'), $user->password) ){
                // Current password is incorrect
                return redirect()->back()->withErrors(new MessageBag(['current_password' => 'Senha incorreta']))->withInput();
            }

            // Passed all validations, we can change the user password
            $user->password = Hash::make($request->input('new_password'));
        }

        // Get the department register
        $department_id = $request->input('department');

        // Change the user department only if is different than the current
        if ($department_id != $user->department_id){
            $department = Department::find($department_id);
            $user->department()->associate($department);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        $user->save();

        toastr()->success('Usuário alterado com sucesso');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        toastr()->success('Usuário removido com sucesso');
        return redirect()->back();
    }
}
