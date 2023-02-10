@extends('layouts.app')
@section('orders')
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" 
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css" integrity="sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="container">

@empty($editdata)
<form method="post" action="{{route('orinsert')}}">
    @csrf
    Məhsul:<br>
    <select name="product_id" class="form-control">
        <option value="">Məhsulu seçin</option>
            @foreach($pdata as $pinfo)
                <option value="{{$pinfo->id}}">{{$pinfo->mehsul}}</option>
            @endforeach
    </select>
    Müştəri:<br>
    <select name="client_id" class="form-control">
        <option value="">Müştərini seçin</option>
            @foreach($cdata as $cinfo)
                <option value="{{$cinfo->id}}">{{$cinfo->client}} {{$cinfo->soyad}}</option>
            @endforeach
    </select>
    Miqdar:<br>
    <div>
        <input type="text" class="form-control" name="sifarish" value="{{old('sifarish')}}"><br>
    </div>
    <button type="submit" class="btn btn-primary"><i class="bi bi-cloud-plus"></i></button>
</form>
@endempty


@isset($editdata)
<form method="post" action="{{route('orupdate')}}">
    @csrf
    Məhsul:<br>
    <select name="product_id" class="form-control">
        <option value="">Məhsulu seçin</option>
        @foreach($pdata as $pinfo)
            @if($pinfo->id==$editdata->product_id)
                <option selected value="{{$pinfo->id}}">{{$pinfo->mehsul}}</option>
            @else
                <option value="{{$pinfo->id}}">{{$pinfo->mehsul}}</option>
            @endif
        @endforeach
    </select>
    Müştəri:<br>
    <select name="client_id" class="form-control">
        <option value="">Müştərini seçin</option>
        @foreach($cdata as $cinfo)
        @if($editdata->client_id==$cinfo->id)
          <option selected value="{{$cinfo->id}}">{{$cinfo->client}} {{$cinfo->soyad}}</option>
          @else
          <option value="{{$cinfo->id}}">{{$cinfo->client}} {{$cinfo->soyad}}</option>
        @endif
        @endforeach
    </select>
    Miqdar:<br>
    <div>
        <input type="text" class="form-control" name="sifarish" value="{{$editdata->sifarish}}"><br>
    </div>
    <input type="hidden"  name="id" value="{{$editdata->id}}"><br>
    <button type="submit" class="btn btn-success"><i class="bi bi-pencil-square"></i></button>
    <a href="{{route('orselect')}}"><button type="button" class="btn btn-dark"><i class="bi bi-x-octagon"></i></button></a>
</form>
@endisset

<br>


@isset($sildata)
Bu sifarişi silməyə əminsiniz?<br>
<a href="{{route('ordelete',$sildata->id)}}"><button type="button" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></a>
<a href="{{route('orselect',$sildata->id)}}"><button type="button" class="btn btn-success"><i class="bi bi-x-octagon"></i></button></a>
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
        <th>MUSTERI</th>
        <th>MEHSUL</th>
        <th>BREND</th>
        <th>ALISH</th>
        <th>SATISH</th>
        <th>STOK</th>
        <th>Miqdar</th>
        <th>Tarix</th>
        <th></th>
      </tr>
    </thead>

    <tbody class="alldata">
    @foreach($list as $i=>$info)
      <tr>
        <td>{{$i+=1}}</td> 
        <td>{{$info->client}} {{$info->soyad}}</td>
        <td>{{$info->mehsul}}</td>
        <td>{{$info->brand}}</td>
        <td>{{$info->alish}}</td>
        <td>{{$info->satish}}</td>
        <td>{{$info->miqdar}}</td>
        <td>{{$info->sifarish}}</td>
        <td>{{$info->created_at}}</td>
        @if($info->tesdiq==0)
        <td>
            <a href="{{route('orsil',$info->id)}}"><button type="button" class="btn btn-danger btn-sm" title="SİL"><i class="bi bi-trash-fill"></i></button></a>
            <a href="{{route('oredit',$info->id)}}"><button type="button" class="btn btn-primary btn-sm" title="REDAKTƏ"><i class="bi bi-pen-fill"></i></button></a>
            <a href="{{route('tesdiq',$info->id)}}"><button type="button" class="btn btn-success btn-sm" title="TƏSDİQ"><i class="bi bi-clipboard-check-fill"></i></button></a>
        </td>
      
      @else
      <td>
        <a href="{{route('legv',$info->id)}}"><button type="button" class="btn btn-danger" title="Ləğv et"><i class="bi bi-x-square-fill"></i></button></a>
      </td>

    @endif
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
      url : '{{route('osearch')}}',
      data:{'search':$value},
      success:function(data){
        $('#content').html(data);
        }
      });
  });
})
    </script>


@endsection