@extends('layouts.app')

@section('content')

<dashboard :posts="{{ json_encode($posts) }}"></dashboard>
@endsection
