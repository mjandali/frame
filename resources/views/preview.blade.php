@extends('layouts.app')

@section('content')
<div class="container text-center main">
    <div class="preview-img">
        <img src="{{ asset("images/" . $data->url)}}" alt="{{ $data->url }}">
    </div>

    <div class="mt-3 d-flex buttons">
        <span class=""><a href="/bibliotheek"><button class="btn btn-secondary mr-2"><i class="fa fa-check"></i> Oke</button></a></span>

        <span class=""><a href="/image/download/{{ $data->id }}"><button class="btn btn-success mr-2"><i class="fa fa-download"></i> Download</button></a></span>
        <form action="/image/delete/{{ $data->id }}" method="POST">
            @csrf
            @method('delete')
            <button class="btn btn-primary" type="submit"><i class="fa fa-undo"></i> Opnieuw Proberen</button>
        </form>
    </div>
</div>
@endsection
