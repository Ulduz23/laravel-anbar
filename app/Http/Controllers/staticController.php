<?php

namespace App\Http\Controllers;

use App\Http\Requests\orequest;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\brands;
use App\Models\clients;
use App\Models\orders;
use Illuminate\Support\Facades\Auth;

class staticController extends Controller
{

    public function hesab()
    {
        $data = orders::join('clients','clients.id','=','orders.client_id') 
        ->join('products','products.id','=','orders.product_id')
        ->join('brands','brands.id','=','products.brand_id')
        ->select('brands.brand','clients.client','clients.soyad','products.miqdar','products.mehsul','products.alish','products.satish','orders.created_at','orders.id','orders.sifarish','orders.tesdiq')
        ->where('orders.user_id','=',Auth::id())
        ->orderBy('orders.id','desc')
        ->get();


        $pdata = product::where('products.user_id','=',Auth::id())->get();


        $stat = product::join('brands','brands.id','=','products.brand_id')
        ->select('products.miqdar','products.alish','products.satish')
        ->where('products.user_id','=',Auth::id())
        ->orderBy('products.id','desc')->get();

        $bdata = brands::where('brands.user_id','=',Auth::id())->get();
        $cdata = clients::where('clients.user_id','=',Auth::id())->get();
        $odata = orders::where('orders.user_id','=',Auth::id())->get();


        $tqazanc = 0;
        $talish = 0;
        $tsatish = 0;
        $tmiqdar = 0;

        foreach($stat as $info)
        {
            $alish = $info->alish;
            $satish = $info->satish;
            $miqdar = $info->miqdar;

            $talish = $talish+($info->alish);
            $tsatish = $tsatish+($info->satish);
            $tmiqdar = $tmiqdar+($info->miqdar);


            $tqazanc = $tqazanc + (($satish-$alish) * $miqdar);

        }


        return view('statistika',[
            'data'=>$data,
            'bdata'=>$bdata,
            'cdata'=>$cdata,
            'pdata'=>$pdata,
            'odata'=>$odata,
            'tqazanc'=>$tqazanc,
            'talish'=>$talish,
            'tsatish'=>$tsatish,
            'tmiqdar'=>$tmiqdar


        ]);
}
}
