@extends('layouts.app')

@section('admin')

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

 
<div class="container">

@if($errors->any())
  @foreach($errors->all() as $sehv)
   <div class="alert alert-danger"> {{$sehv}}<br></div>
  @endforeach
@endif

@if(session('mesaj'))
  <div class="alert alert-success">{{session('mesaj')}}</div>
@endif
 
@isset($sildata)
Siz <b> {{$sildata->name}} {{$sildata->surname}} </b> adli kontakti silmeye eminsinizmi?<br>
<a href="{{route('admindel',$sildata->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
<a href="{{route('adselect',$sildata->id)}}"><button type="button" class="btn btn-success">Legv et</button></a>

@endisset


@empty($editdata)
<form method="post" action="{{route('adinsert')}}" enctype="multipart/form-data">
    @csrf
    ADINIZ:<br>
    <div>
        <input type="text" class="form-control" name="name"><br>
    </div>
    SOYADINIZ:<br>
    <div>
        <input type="text" class="form-control" name="surname"><br>
    </div>
    TELEFON:<br>
    <div>
        <input type="text" class="form-control" name="telefon"><br>
    </div>
    EMAIL:<br>
    <div>
        <input type="text" class="form-control" name="email"><br>
    </div>
    PAROL:<br>
    <div>
        <input type="password" class="form-control" name="password"><br>
    </div>
    TEKRAR PAROL:<br>
    <div>
        <input type="password" class="form-control" name="tpass"><br>
    </div>
    <button type="submit" class="btn btn-primary">DAXIL ET</button>
</form>
@endempty



@isset($editdata)
<form method="post" action="{{route('adminupdate')}}" enctype="multipart/form-data">
    @csrf
    ADINIZ:<br>
    <div>
        <input type="text" class="form-control" name="name" value="{{$editdata->name}}"><br>
    </div>
    SOYADINIZ:<br>
    <div>
        <input type="text" class="form-control" name="surname" value="{{$editdata->surname}}"><br>
    </div>
    TELEFON:<br>
    <div>
        <input type="text" class="form-control" name="telefon" value="{{$editdata->telefon}}"><br>
    </div>
    EMAIL:<br>
    <div>
        <input type="text" class="form-control" name="email" value="{{$editdata->email}}"><br>
    </div>
    PAROL:<br>
    <div>
        <input type="password" class="form-control" name="password"><br>
    </div>
    TEKRAR PAROL:<br>
    <div>
        <input type="password" class="form-control" name="tpass"><br>
    </div>
    <input type="hidden"  name="id" value="{{$editdata->id}}"><br>
    <button type="submit" class="btn btn-warning">YENILE</button>
    <a href="{{route('adselect')}}"><button type="submit" class="btn btn-primary">LEGV ET</button></a>

</form>
@endisset



<div class="alert alert-info"> Bazada  <b> {{$list->count()}} </b> user var </div>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>Istifadeci</th>
        <th>Telefon</th>
        <th>Email</th>
        <th>Tarix</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    @foreach($list as $i=>$info)
      <tr>
        <td>{{$i+=1}}</td>
        <td>{{$info->name}} {{$info->surname}}</td>
        <td>{{$info->telefon}}</td>
        <td>{{$info->email}}</td>
        <td>{{$info->created_at}}</td>
        @if($info->blok==0)
        <td> <a href="{{route('adminsil',$info->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
        <a href="{{route('adminedit',$info->id)}}"><button type="button" class="btn btn-warning">Edit</button></a>
        <a href="{{route('blok',$info->id)}}"><button type="button" class="btn btn-success">BLOK</button></td>
        
        @else
      <td>
        <a href="{{route('noblok',$info->id)}}"><button type="button" class="btn btn-danger">Legv et</button></a>
      </td>

    @endif
      </tr>
      @endforeach
    </tbody>
  </table>
 
</div>



@endsection