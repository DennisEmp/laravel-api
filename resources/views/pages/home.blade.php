@extends('layouts.main-layout')

@section('content')
    <div class="container text-center my-5">
        <h1 class="text-center bg-dark text-danger">Movie Categories</h1>

        <div class="d-flex justify-content-center my-3">
            <a href="{{ route('movies') }}" class="btn btn-danger me-3">
                <i class="fa-solid fa-rectangle-list"></i>
                All Movie
            </a>
            <a href="{{ route('create.movie') }}" class="btn btn-danger">
                <i class="fa-solid fa-square-plus"></i>
                New Movie
            </a>
        </div>

        @foreach ($genres as $genre)
            <div class="card my-5">
                <div class="card-header bg-dark text-danger text-center">
                    <h3><strong>Genre:</strong> {{ $genre->name }}</h3>
                </div>

                {{-- container contenente tutti i film che appartengono al genere --}}
                <div class="card-body">

                    {{-- griglia di card del film --}}
                    <div class="d-flex justify-content-center flex-wrap">
                        @foreach ($genre->movies as $movie)
                            <div class="card m-3" style="width: 18rem;">
                                <div class="card-body text-start">
                                    <h5 class="card-title">{{ $movie->name }}</h5>
                                    <span>Release Date: {{ $movie->release_date }}</span>
                                    <br>
                                    <span>Cash Out: {{ $movie->cashOut }}</span>
                                    {{-- link per eliminare e modificare il prodotto --}}
                                    <div class="mt-3">
                                        <a href="{{route('delete.movie', $movie)}}" class="btn btn-danger">
                                            <i class="fa-solid fa-trash">X</i>
                                        </a>
                                        <a href="{{route('edit.movie', $movie)}}" class="btn btn-danger">
                                            <i class="fa-solid fa-pen-to-square">Edit</i>
                                        </a>
                                    </div>
                                </div>
                            </div>   
                        @endforeach
                    </div>

                </div>

            </div>
        @endforeach
    </div>
@endsection
