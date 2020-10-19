<?php

namespace App\Http\Controllers;

use App\Http\Requests\Room\Store;
use App\Http\Requests\Room\Update;
use App\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('name')->get();

        return view("modules.rooms.index")->with(compact(
            'rooms'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("modules.rooms.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Room\Store  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $room = Room::create($request->all());
        
        if ($room) {
            toastr()->success('Sala cadastrado com sucesso');
            return redirect()->route('rooms.index');
        } else {
            toastr()->error('Houve um erro ao cadastrar a sala!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view("modules.rooms.edit")->with(compact(
            'room'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Room\Update  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Room $room)
    {
        $room = $room->update($request->all());

        if ($room) {
            toastr()->success('Sala atualizado com sucesso');
            return redirect()->route('rooms.index');
        } else {
            toastr()->error('Houve um erro ao atualizar a Sala!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        if ($room->meetings()->count()){
            toastr()->error('Não é possível remover esta sala pois ela possui reuniões vinculadas');
            return redirect()->back();
        }

        $room->delete();

        toastr()->success('Sala removido com sucesso');
        return redirect()->back();
    }
}
