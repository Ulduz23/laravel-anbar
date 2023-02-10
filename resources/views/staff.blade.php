@extends('layouts.app')

@section('staff')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
alpha/css/bootstrap.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" 
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


@empty($editdata)
    <form method="post" action="{{route('isinsert')}}" enctype="multipart/form-data">
        @csrf
        Şəkil:<br>
          <div>
            <input type="file" class="form-control" name="foto" value="{{old('foto')}}"><br>
        </div>
        Ad:<br>
        <div>
            <input type="text" class="form-control" name="name" value="{{old('name')}}"><br>
        </div>
        Soyad:<br>
        <div>
            <input type="text" class="form-control" name="surname" value="{{old('surname')}}"><br>
        </div>
        Telefon:<br>
        <div>
            <input type="text" class="form-control" name="telefon" value="{{old('telefon')}}"><br>
        </div>
        Email:<br>
        <div>
            <input type="text" class="form-control" name="email" value="{{old('email')}}"><br>
        </div>
        Başladığı tarix:<br>
        <div>
            <input type="date" class="form-control" name="istarix" value="{{old('istarix')}}"><br>
        </div>
        Maaş:<br>
        <div>
            <input type="text" class="form-control" name="salary" value="{{old('salary')}}"><br>
        </div>
        Peşə:<br>
        <div>
            <input type="text" class="form-control" name="job" value="{{old('job')}}"><br>
        </div>

        <button type="submit" class="btn btn-primary">Daxil et</button>
    </form>
@endempty


@isset($editdata)
<form method="post" action="{{route('isupdate')}}" enctype="multipart/form-data">
  @csrf
  Şəkil:<br>
  <div>
    <img src="{{url($editdata->foto)}}" style="font-weight:70px; height:60px"><br>
    <input type="file" class="form-control" name="foto" value="{{$editdata->foto}}"><br>
</div>
Ad:<br>
<div>
    <input type="text" class="form-control" name="name" value="{{$editdata->name}}"><br>
</div>
Soyad:<br>
<div>
    <input type="text" class="form-control" name="surname" value="{{$editdata->surname}}"><br>
</div>
Telefon:<br>
<div>
    <input type="text" class="form-control" name="telefon" value="{{$editdata->telefon}}"><br>
</div>
Email:<br>
<div>
    <input type="text" class="form-control" name="email" value="{{$editdata->email}}"><br>
</div>
Başladığı tarix:<br>
<div>
    <input type="date" class="form-control" name="istarix" value="{{$editdata->istarix}}"><br>
</div>
Maaş:<br>
<div>
    <input type="text" class="form-control" name="salary" value="{{$editdata->salary}}"><br>
</div>
Peşə:<br>
<div>
    <input type="text" class="form-control" name="job" value="{{$editdata->job}}"><br>
</div>
<input type="hidden"  name="id" value="{{$editdata->id}}"><br>
  <button type="submit" class="btn btn-success">Yenilə</button>
  <a href="{{route('isselect')}}"><button type="button" class="btn btn-dark">Ləğv et</button></a>
</form>

@endisset
 <br>

@isset($sildata)
Siz <b> {{$sildata->name}} {{$sildata->surname}}</b> adlı işçini silməyə əminsiniz?<br>
<a href="{{route('isdelete',$sildata->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
<a href="{{route('isselect',$sildata->id)}}"><button type="button" class="btn btn-success">Ləğv et</button></a>
@endisset

<br><br>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>Foto</th>
        <th>Ad</th>
        <th>Soyad</th>
        <th>Telefon</th>
        <th>Email</th>
        <th>Başladığı tarix</th>
        <th>Maaş</th>
        <th>Peşə</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

    @foreach($list as $i=>$info)
      <tr>
        <td>{{$i+=1}}</td>
        <td><img src="{{url($info->foto)}}" style="font-weight:70px; height:60px"></td>
        <td>{{$info->name}}</td>
        <td>{{$info->surname}}</td>
        <td>{{$info->telefon}}</td>
        <td>{{$info->email}}</td>
        <td>{{$info->istarix}}</td>
        <td>{{$info->salary}}</td>
        <td>{{$info->job}}</td>

        <td><a href="{{route('issil',$info->id)}}"><button type="button" class="btn btn-danger btn-sm">Sil</button></a>
        <a href="{{route('isedit',$info->id)}}"><button type="button" class="btn btn-primary btn-sm">Redaktə et</button></a>
        <a href="{{route('docselect',$info->id)}}"><button type="button" class="btn btn-success btn-sm">Doc</button></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>


@endsection