@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um Evento</h1>
    <form  action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar" >
        <button type="submit" class="btn btn-primary"><ion-icon name="search-outline"></ion-icon></button>
    </form>
</div>

<div id="events-container" class="col-md-12">
    @if($search)
    <h2>Buscando por: {{ $search }}</h2>
    @else
    <h2>Próximos Eventos</h2>
    <p class"subtitle">Veja os eventos dos próximos dias</p>
    @endif
    <div id="cards-container" class="row">
        @foreach($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-participants">{{ count($event->users) }} Participantes</p>
                    <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber Mais</a>
                </div>
            </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Não foi possível encontrar nenhum evento com {{ $search }}! <a href="/">Ver todos</a></p>
        @elseif(count($events) == 0)
            <p>Não há eventos disponíveis</p>    
        @endif
    </div>
    @if(count($events_academicos) != 0)
        <div id="cards-container" class="row">
            <h3>Eventos Acadêmicos</h3>
            @foreach($events_academicos as $academico)
            <div class="card col-md-3">
                <img src="/img/events/{{ $academico->image }}" alt="{{ $academico->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($academico->date)) }}</p>
                    <h5 class="card-title">{{ $academico->title }}</h5>
                    <p class="card-participants">{{ count($academico->users) }} Participantes</p>
                    <a href="/events/{{ $academico->id }}" class="btn btn-primary">Saber Mais</a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    @if(count($events_corporativos) != 0)
        <div id="cards-container" class="row">
            <h3>Eventos Corporativos</h3>
            @foreach($events_corporativos as $corporativo)
            <div class="card col-md-3">
                <img src="/img/events/{{ $corporativo->image }}" alt="{{ $corporativo->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($corporativo->date)) }}</p>
                    <h5 class="card-title">{{ $corporativo->title }}</h5>
                    <p class="card-participants">{{ count($corporativo->users) }} Participantes</p>
                    <a href="/events/{{ $corporativo->id }}" class="btn btn-primary">Saber Mais</a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    @if(count($events_culturais) != 0)
        <div id="cards-container" class="row">
            <h3>Eventos Culturais</h3>
            @foreach($events_culturais as $cultural)
            <div class="card col-md-3">
                <img src="/img/events/{{ $cultural->image }}" alt="{{ $cultural->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($cultural->date)) }}</p>
                    <h5 class="card-title">{{ $cultural->title }}</h5>
                    <p class="card-participants">{{ count($cultural->users) }} Participantes</p>
                    <a href="/events/{{ $cultural->id }}" class="btn btn-primary">Saber Mais</a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    @if(count($events_esportivos) != 0)
        <div id="cards-container" class="row">
            <h3>Eventos Esportivos</h3>
            @foreach($events_esportivos as $esportivo)
            <div class="card col-md-3">
                <img src="/img/events/{{ $esportivo->image }}" alt="{{ $esportivo->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($esportivo->date)) }}</p>
                    <h5 class="card-title">{{ $esportivo->title }}</h5>
                    <p class="card-participants">{{ count($esportivo->users) }} Participantes</p>
                    <a href="/events/{{ $esportivo->id }}" class="btn btn-primary">Saber Mais</a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    @if(count($events_religiosos) != 0)
        <div id="cards-container" class="row">
            <h3>Eventos Religiosos</h3>
            @foreach($events_religiosos as $religioso)
            <div class="card col-md-3">
                <img src="/img/events/{{ $religioso->image }}" alt="{{ $religioso->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($religioso->date)) }}</p>
                    <h5 class="card-title">{{ $religioso->title }}</h5>
                    <p class="card-participants">{{ count($religioso->users) }} Participantes</p>
                    <a href="/events/{{ $religioso->id }}" class="btn btn-primary">Saber Mais</a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    @if(count($events_sociais) != 0)
        <div id="cards-container" class="row">
            <h3>Eventos Sociais</h3>
            @foreach($events_sociais as $social)
            <div class="card col-md-3">
                <img src="/img/events/{{ $social->image }}" alt="{{ $social->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($social->date)) }}</p>
                    <h5 class="card-title">{{ $social->title }}</h5>
                    <p class="card-participants">{{ count($social->users) }} Participantes</p>
                    <a href="/events/{{ $social->id }}" class="btn btn-primary">Saber Mais</a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
        
@endsection