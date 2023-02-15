@extends('layouts.main-layout')

@section('content')
    <h1 class="text-center bg-dark text-danger">Movie Categories</h1>

    @foreach ($genres as $genre)

    <div class="card my-5">

        <div class="card-header bg-dark text-danger text-center">
            <h3><strong>Genre:</strong> {{ $genre -> name }}</h3>
        </div>

        {{-- container contenente tutti i film che appartengono al genere --}}
        <div class="card-body">

            {{-- griglia di card del film --}}
            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($genre -> movies as $movie)
                    <div class="card m-3" style="width: 18rem;">
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

    </div>
    @endforeach
@endsection
