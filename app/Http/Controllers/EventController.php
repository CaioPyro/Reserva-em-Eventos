<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index() {

        $actual_date = date('Y-m-d');

        $search = request('search');

        $events_academicos = [];     
        $events_corporativos = [];   
        $events_culturais = [];
        $events_esportivos = [];
        $events_religiosos = [];
        $events_sociais  = [];

        if($search) {
            
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();

        }else {
            
            $events = Event::where('date', '>=', $actual_date)->orderBy('date')->take(4)->get();
            $events_academicos = Event::where('date', '>=', $actual_date)->where('category', '=', 0)->orderBy('date')->get();
            $events_corporativos = Event::where('date', '>=', $actual_date)->where('category', '=', 1)->orderBy('date')->get();
            $events_culturais = Event::where('date', '>=', $actual_date)->where('category', '=', 2)->orderBy('date')->get();
            $events_esportivos = Event::where('date', '>=', $actual_date)->where('category', '=', 3)->orderBy('date')->get();
            $events_religiosos = Event::where('date', '>=', $actual_date)->where('category', '=', 4)->orderBy('date')->get();
            $events_sociais = Event::where('date', '>=', $actual_date)->where('category', '=', 5)->orderBy('date')->get();                

        }
        
<<<<<<< HEAD
        return view('welcome', ['events' => $events, 'search' => $search, 'actual_date' => $actual_date]);
=======
        return view('Welcome', 
            ['events' => $events, 
            'search' => $search, 
            'events_academicos' => $events_academicos,
            'events_corporativos' => $events_corporativos,
            'events_culturais' => $events_culturais,
            'events_esportivos' => $events_esportivos,
            'events_religiosos' => $events_religiosos,
            'events_sociais' => $events_sociais,
            'actual_date' => $actual_date]);
>>>>>>> 66f837d (Adição do recurso de categorias)
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->category = $request->category;
        $event->description = $request->description;
        $event->items = $request->items;

        //  Image Upload

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso');
    }

    public function show($id) {

        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {

            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);

    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', 
            ['events' => $events, 'eventsasparticipant' => $eventsAsParticipant]
        );
    }

    public function destroy($id) {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id) {
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);

    }

    public function update(Request $request) {

        $data= $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');

    }

    public function joinEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->title);

    }

    public function leaveEvent($id) {
        
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento: ' . $event->title);

    }

    public function participants($id) {
        $user = auth()->user();

        $event = Event::findOrFail($id);

        $events = $event->users;

        $event_user = $event->users();

        if($user->id != $event->user_id) {
            return redirect('/dashboard');
        }

        return view('events.participants', ['events' => $events, 'event_user' => $event_user, 'event' => $event]);
    }
}

