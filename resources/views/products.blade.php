@extends('layouts.app')
@section('products')
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
<form method="post" action="{{route('pinsert')}}" enctype="multipart/form-data">
    @csrf
    LOGO:<br>
      <div>
        <input type="file" class="form-control" name="foto" value="{{old('foto')}}"><br>
    </div>
    Brend:<br>
    <select name="brand_id" class="form-control">
        <option value="">Brendi seçin</option>
            @foreach($bdata as $binfo)
                <option value="{{$binfo->id}}">{{$binfo->brand}}</option>
            @endforeach
    </select>
    
    Məhsul:<br>
    <div>
        <input type="text" class="form-control" name="mehsul" value="{{old('mehsul')}}"><br>
    </div>
    Alış:<br>
    <div>
        <input type="text" class="form-control" name="alish" value="{{old('alish')}}"><br>
    </div>
    Satış:<br>
    <div>
        <input type="text" class="form-control" name="satish" value="{{old('satish')}}"><br>
    </div>
    Miqdar:<br>
    <div>
        <input type="text" class="form-control" name="miqdar" value="{{old('miqdar')}}"><br>
    </div>
    <button type="submit" class="btn btn-primary">DAXİL ET</button>
</form>
@endempty


@isset($editdata)
<form method="post" action="{{route('pupdate')}}" enctype="multipart/form-data">
    @csrf
    LOGO:<br>
      <div>
        <td><img src="{{url($editdata->foto)}}" style="weight:70px; height:60px"></td>
        <input type="file" class="form-control" name="foto" value="{{$editdata->foto}}"><br>
    </div>
    Brend:<br>
    <select name="brand_id" class="form-control">
        <option value="">Brendi seçin</option>
            @foreach($bdata as $binfo)
            @if($editdata->brand_id==$binfo->id)
              <option selected value="{{$binfo->id}}">{{$binfo->brand}}</option>
              @else
              <option value="{{$binfo->id}}">{{$binfo->brand}}</option>
            @endif
            @endforeach
    </select>
    
    Məhsul:<br>
    <div>
        <input type="text" class="form-control" name="mehsul" value="{{$editdata->mehsul}}"><br>
    </div>
    Alış:<br>
    <div> 
        <input type="text" class="form-control" name="alish" value="{{$editdata->alish}}"><br>
    </div>
    Satış:<br>
    <div>
        <input type="text" class="form-control" name="satish" value="{{$editdata->satish}}"><br>
    </div>
    Miqdar:<br>
    <div>
        <input type="text" class="form-control" name="miqdar" value="{{$editdata->miqdar}}"><br>
    </div>
    <input type="hidden"  name="id" value="{{$editdata->id}}"><br>
    <button type="submit" class="btn btn-success">Yenilə</button>
    <a href="{{route('pselect')}}"><button type="button" class="btn btn-dark">Ləğv et</button></a>
</form>
@endisset

<br><br>

@isset($sildata)
Siz <b> {{$sildata->mehsul}}</b> məhsulu silməyə əminsiniz?<br>
<a href="{{route('pdelete',$sildata->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
<a href="{{route('pselect',$sildata->id)}}"><button type="button" class="btn btn-success">Ləğv et</button></a>
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
        <th>Logo</th>
        <th>Brend</th>
        <th>Məhsul</th>
        <th>Alış</th>
        <th>Satış</th>
        <th>Miqdar</th>
        <th>Tarix</th>
        <th></th>
      </tr>
    </thead>

    <tbody class="alldata">
    @foreach($list as $i=>$info)
      <tr>
        <td>{{$i+=1}}</td>
        <td><img src="{{url($info->foto)}}" style="weight:70px; height:60px"></td>
        <td>{{$info->brand}}</td>
        <td>{{$info->mehsul}}</td>
        <td>{{$info->alish}}</td>
        <td>{{$info->satish}}</td>
        <td>{{$info->miqdar}}</td>
        <td>{{$info->created_at}}</td>
        <td>
        <a href="{{route('psil',$info->id)}}"><button type="button" class="btn btn-danger">Sil</button></a>
        <a href="{{route('pedit',$info->id)}}"><button type="button" class="btn btn-primary">Redaktə et</button></a>
      </td>
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
      url : '{{route('psearch')}}',
      data:{'search':$value},
      success:function(data){
        $('#content').html(data);
        }
      });
  });
})

    </script>

@endsection