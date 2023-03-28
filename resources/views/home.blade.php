@extends('layouts.app')

@section('content')
<div class="container">
    <div class="img-cover"></div>

    @if (Session::get('err'))
    <div class="alert alert-danger session-message">
        {{ Session::get('err') }}
    </div>
    @endif

    <div class="container main">
        <div class="image-upload text-center">
            @if (!Session::get('message'))
            <h2 class="pt-5">Upload een afbeelding</h2>
            <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                        <div class="input-image">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mt-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
                    </div>
            </form>
            @else
                <div class="bg-success success-message">
                    Uw afbeelding is succesvol geüpload.
                </div>

                <div class="preview-img">
                    <img src="{{ asset("images/" . $image->url)}}" alt="{{ $image->url }}">
                </div>

                <div class="d-flex buttons mt-3">
                    <span class="preview"><a href="/image/convert/{{ $image->id }}"><button class="btn btn-success mr-2"><i class="fa fa-exchange"></i> Converteren</button></a></span>
                    <form action="image/delete/{{ $image->id }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-primary" type="submit"><i class="fa fa-undo"></i> Opnieuw Proberen</button>
                    </form>
                </div>
            @endif

        </div>

        <div>

        </div>
    </div>

</div>
@endsection
