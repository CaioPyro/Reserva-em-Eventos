@extends('layouts.main')

@section('title', 'participants')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Participantes do Evento: {{ $event->title }}</h1>
    </div>

    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }}</td>
                            <td>{{ $event['name'] }}</td>
                            <td>{{ $event['email'] }}</td>
                        </tr>
                    @endforeach          
                </tbody>
            </table>
        @endif    
    </div>

@endsection