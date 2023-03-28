@extends('layouts.app')

@section('content')
<div class="container main">
    <h2 class="text-center p-5">BIBLIOTHEEK</h2>

    <div class="d-flex bib-menu">
        <p class="mb-0"><a href="/"><button class="btn btn-primary"><i class="fa fa-upload"></i> upload een afbeelding</button></a></p>
        <p class="m-0">
            <input type="range" class="range" min="3" max="9" step="1" value="6" class="form-range" id="customRange1">
        </p>
        {{-- <p class="bib-size m-0"><span class="bib bib-"><i class="fa fa-compress"></i></span><span class="ml-2 bib bib+"><i class="fa fa-expand"></i></span></p> --}}
    </div>
    <hr size="50" class="mt-2 mb-0">


    <div class="bib-items mb-5">
        @foreach ($images as $image)
            <div class="bibliotheek">
                <a href="/image/show/{{ $image->id }}">
                    <img src="{{ asset('images/' . $image->url) }}" alt="{{ $image->url }}">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
