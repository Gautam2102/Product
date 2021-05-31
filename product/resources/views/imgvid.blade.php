@extends('layouts.app')

@section('content')

<div class="container">

@foreach($data as $row)

<img src="{{ asset('images/' .$row) }}"style="height:200px;width:200px;maragin:10px,10px"><br>
@endforeach

</div>

    @endsection