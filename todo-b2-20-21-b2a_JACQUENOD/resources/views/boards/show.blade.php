@extends('layouts.main')

@section('title', "THE board")


@section('content')
    <h2>Bienvenu dans le board {{$board->title}}</h2>
    @if (Auth::user()->can('update', $board))
    @foreach ($board->users as $user)
        <p>{{ $user->name }} : {{ $user->email }} 
            <form method="POST" action="{{route('boards.users.destroy', $user->pivot->id)}}">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>
        @endif
        </p> 
    @endforeach
    @if (Auth::user()->can('update', $board))
    <form method="POST" action="{{route('boards.users.store', $board)}}">
        @csrf
        <label for="user_id"></label>
        <select name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}: {{$user->email}}</option>
            @endforeach
        </select>
        <button type="submit">Ajouter</button>
    </form>
    @endif

    <br>
    <a href="{{route('boards.tasks.create', $board)}}">Ajouter une tâche</a>
@endsection