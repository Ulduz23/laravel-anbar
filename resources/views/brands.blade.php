@extends('layouts.app')

@section('brands')
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" 
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css" integrity="sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


@empty($editdata)
    <form method="post" action="{{route('insert')}}" enctype="multipart/form-data">
        @csrf
        Foto:<br>
          <div>
            <input type="file" class="form-control" name="foto" value="{{old('foto')}}"><br>
        </div>
        AD:<br>
        <div>
            <input type="text" class="form-control" name="brand" value="{{old('brand')}}"><br>
        </div>
        <button type="submit" class="btn btn-primary">Daxil et</button>
    </form>
@endempty


@isset($editdata)
<form method="post" action="{{route('update')}}" enctype="multipart/form-data">
  @csrf
  Foto:<br>
  <div>
    <img src="{{url($editdata->foto)}}" style="weight:70px; height:60px"><br>
    <input type="file" class="form-control" name="foto" value="{{$editdata->foto}}"><br>
</div>
  ADINIZ:<br>
  <div>
      <input type="text" class="form-control" name="brand" value="{{$editdata->brand}}"><br>
  </div>
  <input type="hidden"  name="id" value="{{$editdata->id}}"><br>
  <button type="submit" class="btn btn-success">Yenile</button>
  <a href="{{route('select')}}"><button type="button" class="btn btn-dark">Legv et</button></a>
</form>

@endisset
<br><br>

@isset($sildata)
Siz <b> {{$sildata->brand}}</b> brendi silməyə əminsiniz?<br><br>
<a href="{{route('delete',$sildata->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
<a href="{{route('select',$sildata->id)}}"><button type="button" class="btn btn-success">Ləğv et</button></a>

@endisset
<br><br>
 <!-- Search -->
<!-- ============================================================== -->
<ul class="float-right">
  <form method="POST">
  <li class="nav-item d-none d-md-block">
      <div class="customize-input">
          <input class="form-control custom-shadow custom-radius border-0 bg-white"
              type="search" placeholder="Search" id="search" name="search" aria-label="Search">
      </div>
  </li>
  </form>
</ul>

<br><br><br>

<!-- ============================================================== -->
<!-- User profile and search -->

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th>Logo</th>
        <th>Brend</th>
        <th></th>
      </tr>
    </thead>

    <tbody class="alldata">
    @foreach($list as $i=>$info)
      <tr>
        <td>{{$i+=1}}</td>
        <td><img src="{{url($info->foto)}}" style="weight:70px; height:60px"></td>
        <td>{{$info->brand}}</td>
        <td><a href="{{route('sil',$info->id)}}"><button type="button" class="btn btn-danger" title="SİL"><i class="bi bi-trash-fill"></i></button></a>
        <a href="{{route('edit',$info->id)}}"><button type="button" class="btn btn-primary" title="REDAKTƏ"><i class="bi bi-pen-fill"></i></button></a></td>
      </tr>
      @endforeach
    </tbody>

    <tbody id="content" class="searchdata"></tbody>
  </table>

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
      url : '{{route('search')}}',
      data:{'search':$value},
      success:function(data){
        $('#content').html(data);
        }
      });
  });
})
    </script>


 
@endsection