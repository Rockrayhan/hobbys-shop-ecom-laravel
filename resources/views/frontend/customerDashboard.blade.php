@extends('frontend.layouts.app')

@section('title', 'All Products')

@section('content')
    <div class="py-5 container">
        <h1> Customer Dashboard </h1>


        <h1>Wanna Logout !</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>


    </div>

@endsection
