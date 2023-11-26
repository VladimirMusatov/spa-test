@extends('layouts.app')

@section('content')
<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary mt-3">
    <div class="col-lg-12 px-0">
      <h1 class="display-4 fst-italic"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$post->title}}</font></font></h1>
      <p class="lead my-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$post->text}}</font></font></p>
      <div class="d-flex justify-content-between">
        <span>{{$post->created_at}}</span>
        <div>
        <div class="d-flex">
            <a href="{{route('edit', $post->id)}}" style="margin-right : 5px">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
            </svg>
            </a>
          </div> 
        </div>
      </div>
    </div>
  </div>
  @endsection