@extends('layouts.main-layout')

@section('content')
    <h1 class="text-danger">Movie Categories</h1>

    @foreach ($genres as $genre)

    <div class="card text-center my-5">

        <div class="card-header">
            <h3><strong>Genre:</strong> {{ $genre -> name }}</h3>
        </div>

        {{-- container contenente tutti i film che appartengono al genere --}}
        <div class="card-body d-flex flex-wrap gap-3">

            {{-- card del film --}}
            @foreach ($genre -> movies as $movie)
                <div class="card" style="width: 18rem;">
                    <div class="card-body text-start">
                        <h5 class="card-title">{{ $movie -> name }}</h5>
                        <span>Release Date: {{ $movie -> release_date }}</span>
                        <br>
                        <span>Cash Out: {{ $movie -> cashOut }}</span>
                    </div>
                </div>   
            @endforeach

        </div>

    </div>
    @endforeach
@endsection