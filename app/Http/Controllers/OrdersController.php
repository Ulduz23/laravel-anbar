<?php

namespace App\Http\Controllers;
 
use App\Http\Requests\orequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brands;
use App\Models\Clients;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller
{

    public function insert(orequest $post)
    {
        $con = new Orders();

        $con->product_id = $post->product_id;
        $con->client_id = $post->client_id;
        $con->sifarish = $post->sifarish;
        $con->tesdiq = 0;
        $con->user_id = Auth::id();


        $con -> save();

        return redirect()->route('orinsert')->with('success','Sifariş daxil edildi!');
  
    }

      
    public function select(){
    
        $data = Orders::join('clients','clients.id','=','orders.client_id') 
        ->join('products','products.id','=','orders.product_id')
        ->join('brands','brands.id','=','products.brand_id')
        ->select('brands.brand','clients.client','clients.soyad','products.miqdar','products.mehsul','products.alish','products.satish','orders.created_at','orders.id','orders.sifarish','orders.tesdiq')
        ->where('orders.user_id','=',Auth::id())
        ->orderBy('orders.id','desc')
        ->get();

        $bdata = Brands::get();
        $cdata = Clients::get();

        $pdata = Product::join('brands','brands.id','=','products.brand_id')
        ->select('brands.brand','products.id','products.miqdar','products.mehsul','products.alish','products.satish')
        ->orderBy('products.id','desc')->get();

        return view('orders',[
            'list'=>$data,
            'bdata'=>$bdata,
            'cdata'=>$cdata,
            'pdata'=>$pdata

        ]);
    }

    
    public function sil($id)
    {
        
       $sildata = Orders::find($id); //where('id', '=' , $id)
       
       
       $data = Orders::join('clients','clients.id','=','orders.client_id') 
        ->join('products','products.id','=','orders.product_id')
        ->join('brands','brands.id','=','products.brand_id')
        ->select('brands.brand','clients.client','clients.soyad','products.miqdar','products.mehsul','products.alish','products.satish','orders.created_at','orders.id','orders.sifarish','orders.tesdiq')
        ->orderBy('orders.id','desc')
        ->get();

        $bdata = Brands::get();
        $cdata = Clients::get();
        $pdata = Product::get();


        return view('orders',[
            'list'=>$data,
            'sildata'=>$sildata,
            'bdata'=>$bdata,
            'cdata'=>$cdata,
            'pdata'=>$pdata

        ]);
    }

     
    public function delete($id)
    {
        
       $sil = Orders::find($id)->delete(); //where('id', '=' , $id)
       
       return redirect()->route('orselect')->with('success','Sifariş silindi');
       
    }

    
    public function edit($id){

        $editdata = Orders::find($id);

        $data = Orders::join('clients','clients.id','=','orders.client_id') 
        ->join('products','products.id','=','orders.product_id')
        ->join('brands','brands.id','=','products.brand_id')
        ->select('brands.brand','clients.client','clients.soyad','products.miqdar','products.mehsul','products.alish','products.satish','orders.created_at','orders.id','orders.sifarish','orders.tesdiq')
        ->where('orders.user_id','=',Auth::id())
        ->orderBy('orders.id','desc')
        ->get();

        $bdata = Brands::get();
        $cdata = Clients::get();
        $pdata = Product::get();
    
        $pdata = Product::join('brands','brands.id','=','products.brand_id')
        ->select('brands.brand','products.id','products.miqdar','products.mehsul','products.alish','products.satish')
        ->orderBy('products.id','desc')->get();


        return view('orders',[
            'list'=>$data,
            'editdata'=>$editdata,
            'bdata'=>$bdata,
            'cdata'=>$cdata,
            'pdata'=>$pdata

        ]);

    }

    public function update(orequest $post){

        $con = Orders::find($post->id);
       
        $con->client_id = $post->client_id;
        $con->product_id = $post->product_id;
        $con->sifarish = $post->sifarish;           
            
        $con->save(); 

        return redirect()->route('orselect')->with('success','Sifariş yeniləndi');

    }

    public function tesdiq($id){

        $orders = Orders::find($id);      
        $omiq = $orders->sifarish;  
        $products = Product::find($orders->product_id);   
        $pmiq = $products->miqdar;

        if($omiq < $pmiq){

        
        $miq=$pmiq-$omiq;
        $products->miqdar=$miq;
        $products->save();

        $orders->tesdiq=1;
        $orders->user_id = Auth::id();
        $orders->save();

        return redirect()->route('orselect')->with('success','Sifariş təsdiqləndi :)');
        }
        return redirect()->route('orselect')->with('error','Anbarda kifayət qədər məhsul yoxdur');

    }


    
    public function legv($id){
        
        $orders = Orders::find($id);   
        $omiq = $orders->sifarish;   
        $products = Product::find($orders->product_id);       
        $pmiq = $products->miqdar;
        $miq=$pmiq+$omiq;
        $products->miqdar=$miq;
        $products->save();

        $orders->tesdiq=0;
        $orders->save();
        
        return redirect()->route('orselect')->with('error','Sifariş ləğv olundu :(');


    
    }

    public function search(Request $post){
        if($post->ajax()){

        $list = Orders::join('clients','clients.id','=','orders.client_id') 
        ->join('products','products.id','=','orders.product_id')
        ->join('brands','brands.id','=','products.brand_id')
        ->select('brands.brand','clients.client','clients.soyad','products.miqdar','products.mehsul','products.alish','products.satish','orders.created_at','orders.id','orders.sifarish','orders.tesdiq')
        ->orWhere('mehsul','LIKE','%'.$post->search.'%')
        ->orWhere('client','LIKE','%'.$post->search.'%')
        ->orWhere('soyad','LIKE','%'.$post->search.'%')
        ->orWhere('brand','LIKE','%'.$post->search.'%')

        ->get();

        $output = "";  
        
        foreach ($list as $i=>$info) {
            $output.='<tr>'.
            '<tr>
            <td>'.($i+=1).'</td>
            <td>'.$info->client.' '.$info->soyad.'</td>
            <td>'.$info->mehsul.'</td>
            <td>'.$info->brand.'</td>
            <td>'.$info->alish.'</td>
            <td>'.$info->satish.'</td>
            <td>'.$info->miqdar.'</td>
            <td>'.$info->sifarish.'</td>
            <td>'.$info->created_at.'</td>';

            if($info->tesdiq==0)
            {            
            $output.=

            '<td>'.'<a href="/orsil/'.$info->id.'">'.'<button type="button" class="btn btn-danger btn-sm title="SİL"><i class="bi bi-trash-fill"></i></button>'.'</a>
            '.'<a href="/oredit/'.$info->id.'">'.'<button type="button" class="btn btn-primary btn-sm" title="REDAKTƏ"><i class="bi bi-pen-fill"></i></button>'.'</a>
            '.'<a href="/tesdiq/'.$info->id.'">'.'<button type="button" class="btn btn-success btn-sm" title="TƏSDİQ"><i class="bi bi-clipboard-check-fill"></i></button>'.'</a>
            </td>';

            }
            else
            {
                $output.=
                '<td>'.' <a href="/legv/'.$info->id.'">'.'<button type="button" class="btn btn-danger btn-sm">Ləgv</button>'.'</a>
                </td>';
            }

            $output.='<tr>';
        }
        
      return Response($output);

        }
   
  
}
       


}
