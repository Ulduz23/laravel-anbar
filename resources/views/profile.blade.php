@extends('layouts.app')

@section('profile')

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
alpha/css/bootstrap.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" 
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 
<div class="container">
    
    <div class="card">
        <form method="post">
            <div class="card-body">
            <h5 class="card-title">Profilini yenile :)</h5>
            <p class="card-text">Profilinizi silmek istediyinizden emin olduqda "hesabimi sil" duymesine basa bilersiniz.</p>
            <a href="{{route('profilsil',auth()->user()->id)}}"><button type="button" class="btn btn-outline-danger">Hesabımı sil</button></a>
            </div>
        </form>
    </div><br>

  
@isset($sildata)
<form action="{{route('profildelete')}}" method="post">
@csrf
    Siz <b> {{$sildata->name}} {{$sildata->surname}}</b> silməyə əminsiniz?<br>
    <button type="submit" class="btn btn-danger">Sil</button>
    <a href="{{route('myprofile')}}"><button type="button" class="btn btn-success">Ləğv et</button></a>
</form>
@endisset

<form method="post" action="{{route('profile')}}" enctype="multipart/form-data">
    @csrf
    Şəkil:<br>
    <div>
        <img src="{{url(Auth::user()->foto)}}" style="weight:70px; height:60px"><br>
        <input type="file" class="form-control" name="foto"><br>
    </div>
    Ad:<br>
    <div>
        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}"><br>
    </div>
    Soyad:<br>
    <div>
        <input type="text" class="form-control" name="surname" value="{{Auth::user()->surname}}"><br>
    </div>
    Telefon:<br>
    <div>
        <input type="text" class="form-control" name="telefon" value="{{Auth::user()->telefon}}"><br>
    </div>
    Email:<br>
    <div>
        <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}"><br>
    </div>
    Şifrə:<br>
    <div>
        <input type="password" class="form-control" name="password"><br>
    </div>
    Yeni şifrə:<br>
    <div>
        <input type="password" class="form-control" name="newpass"><br>
    </div>
    <button type="submit" class="btn btn-primary">Yenilə</button>
</form>

 
@endsection