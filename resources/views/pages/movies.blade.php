@extends('layouts.main-layout')

@section('content')
    <div class="container text-center">
        <h1 class="text-danger mb-3">List Movie</h1>

        {{-- creo un bottone per far tornare l'utente alla home page --}}
        <a href="{{ route('home') }}" class="btn btn-danger my-3">
            <i class="fa-solid fa-igloo"></i>
            Home
        </a>

        {{-- creo le card per stampare le info sui film --}}
        <div class="d-flex flex-wrap justify-content-center gap-3">

            {{-- card del film --}}
            @foreach ($movies as $movie)
                <div class="card border border-3" style="width: 300px;">
                    <div class="card-body text-start">
                        <h5 class="card-title">{{ $movie -> name }}</h5>
                        <span>Release Date: {{ $movie -> release_date }}</span>
                        <br>
                        <span>Cash Out: {{ $movie -> cash_out }}</span>

                        <!-- link per eliminare il prodotto  -->
                        <div class="mt-3">
                            <a href="{{route('delete.movie', $movie)}}" class="btn btn-danger mt-5">
                                <i class="fa-solid fa-trash">X</i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
