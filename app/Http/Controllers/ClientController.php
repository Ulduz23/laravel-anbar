<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Requests\crequest;
use App\Models\clients;


use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{
    public function insert(crequest $post)
    {
        $yoxla = clients::where('telefon','=', $post->telefon)->orwhere('email','=', $post->email)->count();

        if($yoxla==0)
        {
            $con = new clients();

            $con->client = $post->client;
            $con->soyad = $post->soyad;
            $con->telefon = $post->telefon;
            $con->email = $post->email;
            $con->sirket = $post->sirket;
            $con->user_id = Auth::id();

            $con -> save(); 
    
            return redirect()->route('cselect')->with('success','Müştəri əlavə edildi!');
        }

        return redirect()->route('cselect')->with('warning','Belə müştəri artıq mövcuddur!');

    }

    
    public function select()
    {
        $data = clients::get()->where('user_id','=',Auth::id());


        return view('clients',[
            'list'=>$data
        ]);    
    }

    public function sil($id)
    {
        
       $sildata = clients::find($id); //where('id', '=' , $id)
       
       $data = clients::orderBy('id','desc')->get();



        return view('clients',[
            'list'=>$data,
            'sildata'=>$sildata

        ]);    
    }

    
    public function delete($id)
    {
        
       $sil = clients::find($id)->delete(); //where('id', '=' , $id)
       
       return redirect()->route('cselect')->with('success','Müştəri silindi');
       
    }

    public function edit($id)
    {
        
       $editdata = clients::find($id); //where('id', '=' , $id)
       
       $data = clients::orderBy('id','desc')->get();


        return view('clients',[
            'list'=>$data,
            'editdata'=>$editdata
        ]);      
    }


    public function update(crequest $post)
    {
        $con = clients::find($post->id);

        $con->client = $post->client;
        $con->soyad = $post->soyad;
        $con->telefon = $post->telefon;
        $con->email = $post->email;
        $con->sirket = $post->sirket;

        $con->save(); 
        return redirect()->route('cselect')->with('success','Müştəri yeniləndi!');
    }

    public function search(Request $post){
        if($post->ajax()){

        $list = clients::where('client','LIKE','%'.$post->search.'%')
        ->orwhere('soyad','LIKE','%'.$post->search.'%')
        ->orwhere('email','LIKE','%'.$post->search.'%')
        ->get();
        $output = "";  
        
        foreach ($list as $i=>$info) {
            $output.='<tr>'.
            '<tr>
            <td>'.($i+=1).'</td>
            <td>'.$info->client.'</td>
            <td>'.$info->soyad.'</td>
            <td>'.$info->telefon.'</td>
            <td>'.$info->email.'</td>
            <td>'.$info->sirket.'</td>
            <td>'.'<a href="/clientsil/'.$info->id.'">'.'<button type="button" class="btn btn-danger">Sil</button>'.'</a>
            '.'<a href="/clientsedit/'.$info->id.'">'.'<button type="button" class="btn btn-primary">Redaktə et</button>'.'</a>
            </td>
            </tr>';
        }
        
      return Response($output);

        }
   
  
}

}
