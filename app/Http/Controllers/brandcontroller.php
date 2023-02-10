<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\brequest;
use App\Models\brands;
use App\Models\clients;
use App\Models\orders;
use App\Models\product;

use Illuminate\Support\Facades\Auth;


  
class brandcontroller extends Controller
{
    public function insert(brequest $post)
    {
        $con = new brands();

        
        $yoxla = brands::where('brand','=', $post->brand)->count();

        if($yoxla==0)
        {
            if($post->file('foto'))
            
                $file = time().'.'.$post->foto->extension();

                $post->foto->storeAs('public/uploads/fotolar/',$file);

                $con->foto = 'storage/uploads/fotolar/'.$file;

                $con->brand = $post->brand;

                $con->user_id = Auth::id();

                $con -> save();

                return redirect()->route('select')->with('success','Brend ugurla daxil edildi!');

        }
        return redirect()->route('select')->with('warning','Bu brend artıq mövcuddur!');

}

     
    public function select()
    {
        $data = brands::get()->where('user_id','=',Auth::id());

        return view('brands',[
            'list'=>$data

        ]);      
      }

    public function sil($id)
    {
        
       $sildata = brands::find($id); //where('id', '=' , $id)
       
       
        $data = brands::get()        
        ->where('user_id','=',Auth::id());

        return view('brands',[
            'list'=>$data,
            'sildata'=>$sildata


        ]);      
    }

    
    public function delete($id)
    {
        
       $sil = brands::find($id)->delete(); //where('id', '=' , $id)
       
       return redirect()->route('select')->with('success','Brend silindi');
       
    }

    public function edit($id)
    {
        
       $editdata = brands::find($id); //where('id', '=' , $id)
       
       $data = brands::get()        
        ->where('user_id','=',Auth::id());


        return view('brands',[
            'list'=>$data,
            'editdata'=>$editdata


        ]);       
    }


    public function update(brequest $post)
    {
    
        $con = brands::find($post->id);

        if($post->file('foto')){
        
        $file = time().'.'.$post->foto->extension();

        $post->foto->storeAs('public/uploads/fotolar/',$file);

        $con->foto = 'storage/uploads/fotolar/'.$file;
        }
        else
        {$con->foto = $con->foto;}
    
        $con->brand = $post->brand;

        $con->user_id = Auth::id();


        $con->save(); 
        return redirect()->route('select')->with('success','Brend yenilendi!');
        
    }

public function search(Request $post){
        if($post->ajax()){

        $list = brands::where('brand','LIKE','%'.$post->search.'%')->get();
        $output = "";  
        
        foreach ($list as $i=>$info) {
            $output.='<tr>'.
            '<tr>
            <td>'.($i+=1).'</td>
            <td>'.'<img src="'.$info->foto.'" style="weight:70px; height:60px">'.'</td>
            <td>'.$info->brand.'</td>
            <td>'.'<a href="/brandsil/'.$info->id.'">'.'<button type="button" class="btn btn-danger">Sil</button>'.'</a>
            '.'<a href="/brandedit/'.$info->id.'">'.'<button type="button" class="btn btn-primary">Redaktə et</button>'.'</a>
            </td>
            </tr>';
        }
        
      return Response($output);

        }
   
  
}
   
}
