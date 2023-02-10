@extends('layouts.app')

@section('clients')
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" 
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 
<div class="container">

@empty($editdata)
<form method="post" action="{{route('clinsert')}}" enctype="multipart/form-data">
    @csrf
    AD:<br>
    <div>
        <input type="text" class="form-control" name="client" value="{{old('client')}}"><br>
    </div>
    SOYAD:<br>
    <div>
        <input type="text" class="form-control" name="soyad" value="{{old('soyad')}}"><br>
    </div>
    TELEFON:<br>
    <div>
        <input type="text" class="form-control" name="telefon" value="{{old('telefon')}}"><br>
    </div>
    EMAIL:<br>
    <div>
        <input type="text" class="form-control" name="email" value="{{old('email')}}"><br>
    </div>
    ŞİRKƏT:<br>
    <div>
        <input type="text" class="form-control" name="sirket" value="{{old('sirket')}}"><br>
    </div>
    <button type="submit" class="btn btn-primary">DAXİL ET</button>
</form>

@endempty

@isset($editdata)
<form method="post" action="{{route('cupdate')}}" enctype="multipart/form-data">
    @csrf
    ADINIZ:<br>
    <div>
        <input type="text" class="form-control" name="client" value="{{$editdata->client}}"><br>
    </div>
    SOYADINIZ:<br>
    <div>
        <input type="text" class="form-control" name="soyad" value="{{$editdata->soyad}}"><br>
    </div>
    TELEFON:<br>
    <div>
        <input type="text" class="form-control" name="telefon" value="{{$editdata->telefon}}"><br>
    </div>
    EMAIL:<br>
    <div>
        <input type="text" class="form-control" name="email" value="{{$editdata->email}}"><br>
    </div>
    SIRKET:<br>
    <div>
        <input type="text" class="form-control" name="sirket" value="{{$editdata->sirket}}"><br>
    </div>
    <input type="hidden"  name="id" value="{{$editdata->id}}"><br>
    <button type="submit" class="btn btn-success">Yenile</button>
    <a href="{{route('cselect')}}"><button type="button" class="btn btn-dark">Ləğv et</button></a>

</form>

@endisset
<br><br>
@isset($sildata)
Siz <b> {{$sildata->client}} {{$sildata->soyad}} </b> adlı müştərini silməyə əminsinizmi?<br><br>
<a href="{{route('cdelete',$sildata->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
<a href="{{route('cselect',$sildata->id)}}"><button type="button" class="btn btn-success">Ləğv et</button></a>

@endisset
<br><br>

 <!-- Search -->
<!-- ============================================================== -->
<ul class="float-right">

  <li class="nav-item d-none d-md-block">
    <a class="nav-link" href="javascript:void(0)">
        <form method="POST">
            <div class="customize-input">
                <input class="form-control custom-shadow custom-radius border-0 bg-white"
                    type="search" name="search" placeholder="Search" id="search" aria-label="Search">
                <i class="form-control-icon" data-feather="search"></i>
            </div>
        </form>
    </a>
  </li>
  </ul>
  
  <br><br>


  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>Ad</th>
        <th>Soyad</th>
        <th>Telefon</th>
        <th>Email</th>
        <th>Şirkət</th>
        <th></th>
      </tr>
    </thead>

    <tbody class="alldata">
    @foreach($list as $i=>$info)
      <tr>
        <td>{{$i+=1}}</td>
        <td>{{$info->client}}</td>
        <td>{{$info->soyad}}</td>
        <td>{{$info->telefon}}</td>
        <td>{{$info->email}}</td>
        <td>{{$info->sirket}}</td>
        <td><a href="{{route('csil',$info->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
        <a href="{{route('cedit',$info->id)}}"><button type="button" class="btn btn-primary">Redaktə et</button></a></td>
      </tr>
      @endforeach
    </tbody>

    <tbody id="content" class="searchdata"></tbody>

  </table>

</div>


<script type="text/javascript">
  $(document).ready(function(){

    $('#search').on('keyup',function(){
    $value=$(this).val();
      if($value){
        $('.alldata').hide();
        $('.searchdata').show();

      }
      else
      {
        $('.alldata').show();
        $('.searchdata').hide();
      }

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    $.ajax({
      method: 'POST',
      type : 'GET',
      url : '{{route('csearch')}}',
      data:{'search':$value},
      success:function(data){
        $('#content').html(data);
        }
      });
  });
})
    </script>



@endsection