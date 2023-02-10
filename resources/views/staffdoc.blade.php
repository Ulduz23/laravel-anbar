@extends('layouts.app')

@section('staffdoc')
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
alpha/css/bootstrap.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" 
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@empty($editdata)
    <form method="post" action="{{route('docinsert')}}" enctype="multipart/form-data">
        @csrf
        Şəkil:<br>
          <div>
            <input type="file" class="form-control" name="scan" value="{{old('scan')}}"><br>
        </div>
        Başlıq:<br>
        <div>
            <input type="text" class="form-control" name="title" value="{{old('title')}}"><br>
        </div>
        Haqqında:<br>
        <div>
            <input type="text" class="form-control" name="about" value="{{old('about')}}"><br>
        </div>
        <input type="hidden" name="staf_id" value="{{$staf_id}}"><br>

        <button type="submit" class="btn btn-primary">Daxil et</button>
    </form>
@endempty


@isset($editdata)
<form method="post" action="{{route('docupdate')}}" enctype="multipart/form-data">
  @csrf
  Şəkil:<br>
  <div>
    <img src="{{url($editdata->scan)}}" style="font-weight:70px; height:60px"><br>
    <input type="file" class="form-control" name="scan" value="{{$editdata->scan}}"><br>
</div>
Başlıq:<br>
<div>
    <input type="text" class="form-control" name="title" value="{{$editdata->title}}"><br>
</div>
Haqqında:<br>
<div>
    <input type="text" class="form-control" name="about" value="{{$editdata->about}}"><br>
</div>
<input type="hidden"  name="id" value="{{$editdata->id}}"><br>


  <button type="submit" class="btn btn-success">Yenilə</button>
  <a href="{{route('docselect',$staf_id)}}"><button type="button" class="btn btn-dark">Ləğv et</button></a>
</form>

@endisset
<br>
@isset($sildata)
Siz <b> {{$sildata->title}} </b> adlı documenti silməyə əminsiniz?<br>
<a href="{{route('docdelete',$sildata->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
<a href="{{route('docselect',$sildata->id)}}"><button type="button" class="btn btn-success">Ləğv et</button></a>

@endisset
<br><br>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>Şəkil</th>
        <th>Başlıq</th>
        <th>Haqqında</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

    @foreach($list as $i=>$info)
      <tr>
        <td>{{$i+=1}}</td>
        <td><img src="{{url($info->scan)}}" style="font-weight:70px; height:60px"></td>
        <td>{{$info->title}}</td>
        <td>{{$info->about}}</td>

        <td>
          <a href="{{route('docsil',$info->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
          <a href="{{route('docedit',$info->id)}}"><button type="button" class="btn btn-primary">Redaktə et</button></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>


@endsection