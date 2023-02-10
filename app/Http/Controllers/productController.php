<?php

namespace App\Http\Controllers;
 
use App\Http\Requests\prequest;
use App\Models\product;
use App\Models\clients;

use App\Models\orders;
use App\Models\brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    public function insert(prequest $post)
    {
        $con = new product();

        if($post->file('foto'))
        
        $file = time().'.'.$post->foto->extension();

        $post->foto->storeAs('public/uploads/fotolar/',$file);

        $con->foto = 'storage/uploads/fotolar/'.$file;
 

        $con->brand_id = $post->brand_id;
        $con->mehsul = $post->mehsul;
        $con->alish = $post->alish;
        $con->satish = $post->satish;
        $con->miqdar = $post->miqdar;

        $con->user_id = Auth::id();

        $con -> save();

        return redirect()->route('pselect')->with('success','Məhsullar daxil edildi!');
  
    }

    
    public function select()
    {
        $data = product::join('brands','brands.id','=','products.brand_id')
        ->select('products.mehsul','brands.brand','products.alish','products.satish','products.miqdar','products.foto','products.brand_id','products.created_at','products.id')
        ->where('products.user_id','=',Auth::id())
        ->orderBy('products.id','desc')
        ->get();

        $bdata = brands::get();


        return view('products',[
            'list'=>$data,
            'bdata'=>$bdata

        ]);
    }

    public function sil($id)
    {
        
       $sildata = product::find($id); //where('id', '=' , $id)
       
       $data = product::join('brands','brands.id','=','products.brand_id')
        ->select('products.mehsul','brands.brand','products.alish','products.satish','products.miqdar','products.foto','products.brand_id','products.created_at','products.id')
        ->where('products.user_id','=',Auth::id())
        ->orderBy('products.id','desc')
        ->get();

        $bdata = brands::get();


        return view('products',[
            'list'=>$data,
            'sildata'=>$sildata,
            'bdata'=>$bdata,

        ]);
    }

     
    public function delete($id)
    {
        
       $sil = product::find($id)->delete(); //where('id', '=' , $id)
       
       return redirect()->route('pselect')->with('success','Məhsul silindi');
       
    }

    
    public function edit($id)
    {
        
       $editdata = product::find($id); //where('id', '=' , $id)
       
       $data = product::join('brands','brands.id','=','products.brand_id')
        ->select('products.mehsul','brands.brand','products.alish','products.satish','products.miqdar','products.foto','products.brand_id','products.created_at','products.id')
        ->where('products.user_id','=',Auth::id())
        ->orderBy('products.id','desc')
        ->get();

        $bdata = brands::get();


        return view('products',[
            'list'=>$data,
            'editdata'=>$editdata,
            'bdata'=>$bdata


        ]);
    }


    public function update(prequest $post)
    {
        

        $con = product::find($post->id);

        if($post->file('foto')){
        
        $file = time().'.'.$post->foto->extension();

        $post->foto->storeAs('public/uploads/fotolar/',$file);

        $con->foto = 'storage/uploads/fotolar/'.$file;
        }
        else
        {$con->foto = $con->foto;}
    

        $con->brand_id = $post->brand_id;
        $con->mehsul = $post->mehsul;
        $con->alish = $post->alish;
        $con->satish = $post->satish;
        $con->miqdar = $post->miqdar;

        $con->user_id = Auth::id();


        $con->save(); 
        return redirect()->route('pselect')->with('success','Məhsullar yeniləndi!');
       
    }

    public function search(Request $post){
        if($post->ajax()){

        $list = product::join('brands','brands.id','=','products.brand_id')
        ->select('products.mehsul','brands.brand','products.alish','products.satish','products.miqdar','products.foto','products.brand_id','products.created_at','products.id')
        ->orWhere('mehsul','LIKE','%'.$post->search.'%')
        ->orWhere('brand','LIKE','%'.$post->search.'%')
        ->get();
        $output = "";  
        
        foreach ($list as $i=>$info) {
            $output.='<tr>'.
            '<tr>
            <td>'.($i+=1).'</td>
            <td>'.'<img src="'.$info->foto.'" style="weight:70px; height:60px">'.'</td>
            <td>'.$info->brand.'</td>
            <td>'.$info->mehsul.'</td>
            <td>'.$info->alish.'</td>
            <td>'.$info->satish.'</td>
            <td>'.$info->miqdar.'</td>
            <td>'.$info->created_at.'</td>
            <td>'.'<a href="/psil/'.$info->id.'">'.'<button type="button" class="btn btn-danger">Sil</button>'.'</a>
            '.'<a href="/pedit/'.$info->id.'">'.'<button type="button" class="btn btn-primary">Redaktə et</button>'.'</a>
            </td>
            </tr>';
        }
        
      return Response($output);

        }
   
  
}

}
