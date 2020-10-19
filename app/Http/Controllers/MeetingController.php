<?php

namespace App\Http\Controllers;

use App\Exceptions\Meeting\MeetingException;
use App\Http\Requests\Meeting\Store;
use App\Meeting;
use App\Room;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetings = Meeting::orderBy('start')->get();

        return view("modules.meetings.index")->with(compact(
            'meetings'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::orderBy('name')->get()->pluck('name', 'id');

        return view("modules.meetings.create")->with(compact(
            'rooms'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Meeting\Store  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        try {
            $startTimestamp = new Carbon("{$request->input('start_date')} {$request->input('start_time')}");
            $endTimestamp = new Carbon("{$request->input('end_date')} {$request->input('end_time')}");

            // Validate the meeting, throws a exception if not valid
            $this->validateMeeting($startTimestamp, $endTimestamp, $request->input('room'));

            $meeting = new Meeting([
                'start' => $startTimestamp,
                'end' => $endTimestamp
            ]);

            $room = Room::find($request->input('room'));
            $meeting->room()->associate($room);
            $meeting->user()->associate(Auth::user());
            $meeting->save();


            toastr()->success('Reunião cadastrado com sucesso');
            return redirect()->route('meetings.index');
        } catch (MeetingException $e) {

            return redirect()->back()->withErrors(new MessageBag([
                'meeting_error' => $e->getMessage()
            ]))->withInput();

        } catch (Exception $e) {
            toastr()->error('Houve um erro ao cadastrar a reunião!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        if ( !($meeting->user == Auth::user() || Auth::user()->admin) ){
            toastr()->error('Você não tem permissão para editar esta reunião!');
            return redirect()->route('meetings.index');
        }

        $rooms = Room::orderBy('name')->get()->pluck('name', 'id');

        return view("modules.meetings.edit")->with(compact(
            'rooms',
            'meeting'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        try {
            $startTimestamp = new Carbon("{$request->input('start_date')} {$request->input('start_time')}");
            $endTimestamp = new Carbon("{$request->input('end_date')} {$request->input('end_time')}");

            // Validate the meeting, throws a exception if not valid
            $this->validateMeeting($startTimestamp, $endTimestamp, $request->input('room'), $meeting);

            $meeting->start = $startTimestamp;
            $meeting->end = $endTimestamp;

            $room = Room::find($request->input('room'));
            $meeting->room()->associate($room);
            $meeting->save();


            toastr()->success('Reunião alterada com sucesso');
            return redirect()->route('meetings.index');
        } catch (MeetingException $e) {

            return redirect()->back()->withErrors(new MessageBag([
                'meeting_error' => $e->getMessage()
            ]))->withInput();

        } catch (Exception $e) {

            toastr()->error('Houve um erro ao alterar a reunião!');
            return redirect()->back()->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meeting $meeting)
    {
        if ($meeting->user == Auth::user() || Auth::user()->admin) {
            $meeting->delete();

            toastr()->success('Reunião removida com sucesso');
            return redirect()->back();
        } else {
            toastr()->error('Você não tem permissão para remover essa reunião!');
            return redirect()->back();
        }
    }

    /**
     * Validate the specified meeting timestamp for the current user
     *
     * @param  \Carbon\Carbon  $startTimestamp
     * @param  \Carbon\Carbon  $endTimestamp
     * @param  int  $room
     * @param  \App\Meeting  $except
     */
    private function validateMeeting(Carbon $startTimestamp, Carbon $endTimestamp, int $room, Meeting $except = null){
        // Validate the start tiemstamp
        if ( $startTimestamp->isPast() )
            throw new MeetingException("O momento de início da reunião deve ser futuro.");

        // Check if the end timestamp is after the start
        if ($endTimestamp->lte($startTimestamp))
            throw new MeetingException("O fim da reunião não pode ser igual ou anterior ao início.");

        // Check if the difference beetwen start and end is below 60 minutes
        if ( $startTimestamp->diffInMinutes($endTimestamp) > 60 )
            throw new MeetingException("A reunião não pode durar mais de 60 minutos.");

        // Check if the room is available during the time interval
        $meeting = Meeting::where('room_id', $room)
                            ->where( function($where) use ($startTimestamp, $endTimestamp) {
                                $where->whereBetween('start', [$startTimestamp, $endTimestamp]);
                                $where->orWhereBetween('end', [$startTimestamp, $endTimestamp]);
                            });

        if ($except)
            $meeting->where('id', '<>', $except->id);

        // Already exists another meeting during the time interval
        if ( $meeting->exists() ){
            $meeting = $meeting->first();
            throw new MeetingException("Já existe uma reunião durante este horário ({$meeting->start->format('d/m H:i')} às {$meeting->end->format('d/m H:i')}).");
        }

        // Check if the user doesn't have another meeting in this day
        $userMeeting = Meeting::where('user_id', Auth::id())->whereDate('start', $startTimestamp);
        if ($except)
            $userMeeting->where('id', '<>', $except->id);

        if ( $userMeeting->exists() )
            throw new MeetingException("Você já possuí uma reunião marcada para este dia!");
    }
}
