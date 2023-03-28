@extends('layouts.app')

@section('content')
<div class="container text-center main">
    <div class="preview-img">
        <img src="{{ asset("images/" . $image->url)}}" alt="{{ $image->url }}">
    </div>

    <div class="center">
        <div class="mt-3 buttons">
            <span class=""><a href="/image/download/{{ $image->id }}"><button class="btn btn-success mr-2"><i class="fa fa-download"></i> Download</button></a></span>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteImage"><i class="fa fa-trash"></i> Delete</button>

            <!-- Modal -->
            <div class="modal fade mt-5" id="deleteImage" tabindex="-1" role="dialog" aria-labelledby="deleteImageLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-light" id="deleteImageLabel">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-xl">
                        De geselecteerde afbeelding wordt permanent verwijderd, weet u het zeker?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-undo"></i> Terug</button>
                        <form action="/image/delete/{{ $image->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
