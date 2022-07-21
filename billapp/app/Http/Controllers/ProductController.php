<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Models\Products;
use App\Models\Customers;
use App\Models\BillInfo;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{


    public function genarateBIllNo(){
        $billNo=$randomNumber = random_int(10000000, 99999999);
        return response()->json($billNo); 
    }


    public function ProductName(Request $request){
        $id = $request->productId;
        $proInfo =Products::latest()->get();
        foreach($proInfo as $info){
            if($info->id == $id){
                $nid=$info->name;
            }
        }
        
        return response()->json($nid); 
    }

public function ShowProducts(Request $request){
    // ProductDetails::all();
    
    $data=DB::table('products')
        ->leftJoin('product_details', 'products.id', '=', 'product_details.productId')
        ->get();
        
    return response()->json($data);
}



    public function AddProducts(Request $request){


        $proInfo =Products::latest()->get();
        $pid=$request->productId ;
        foreach ( $proInfo as $info){
            if($pid == $info->id){
                $prate = $info->rate;
            }
        }

        
        $qty = $request->qty;
        $discount = $request->discount;
        $totalAmount = $qty * $prate;
        $netAmount = $totalAmount - $discount;


        $paidAmount=$request->paidAmount;
        $billNo= $request->billNo;
        
        
        $nets = ProductDetails::all();
        $netTotal =$netAmount;
        $discountTotal=$discount;
        // foreach($nets as $net){
        //     if($billNo == $net->billNo){
        //         $netTotal = $netTotal +$net->$netAmount;
        //         $discountTotal=$discountTotal+$net->$discount;
        //     }
        // }
            
        

        $dueAmount = $netTotal-$paidAmount;
        

        



        $data = ProductDetails::insert([
         'date'=>$request->date,
         'billNo'=>$billNo,
         'customerId'=>$request->customerId,
         'productId'=>$request->productId,
         'qty'=>$request->qty,
         'totalAmount'=>$totalAmount ,
         'discount'=>$request->discount,
         'netAmount'=>$netAmount,
         'paidAmount'=>$request->paidAmount,
        'rate'=>$prate,
        'netTotal'=>$netTotal,
        'discountTotal'=>$discountTotal,
        'dueAmount'=>$dueAmount,
        'status'=>1,
         
        ]);
        
        return response()->json($data);

     }


     public function EditProduct(Request $request, $id){


        $data1 = ProductDetails::findOrFail($id);

        $date=$data1->date;
        $billNo=$data1->billNo;
        $customerId=$data1->customerId;
        $productId=$data1->productId;
        $qty=$data1->qty;
        $rate=$data1->rate;
        $totalAmount=$data1->totalAmount;
        $discount=$request->discount;
        $netAmount = $totalAmount - $discount;
        $paidAmount = $data1->paidAmount;
        
        $netTotal =$netAmount;
        $discountTotal=$discount;
        $dueAmount = $netTotal-$paidAmount;
        
        


        $data = ProductDetails::findOrFail($id)->update([
        'date'=>$date,
        'billNo'=>$billNo,
        'productId'=>$productId,
        'qty'=>$qty,
        'totalAmount'=>$totalAmount ,
        'discount'=>$request->discount,
        'netAmount'=>$netAmount,
        'paidAmount'=>$paidAmount,
        'customerId'=>$customerId,
        'rate'=>$rate,
        'netTotal'=>$netTotal,
        'discountTotal'=>$discountTotal,
        'dueAmount'=>$dueAmount,
        'status'=>1,
        ]);
        
        return response()->json($data);
     }



     public function QtyProduct(Request $request, $id){


        $data1 = ProductDetails::findOrFail($id);
        

        $date=$data1->date;
        $billNo=$data1->billNo;
        $customerId=$data1->customerId;
        $productId=$data1->productId;
        $qty=$request->qty;
        $rate=$data1->rate;
        $totalAmount = $qty * $rate;
        $discount=$data1->discount;
        $netAmount = $totalAmount - $discount;
        $paidAmount = $data1->paidAmount;

        $netTotal =$netAmount;
        $discountTotal=$discount;
        $dueAmount = $netTotal-$paidAmount;
        


        $data = ProductDetails::findOrFail($id)->update([
        'date'=>$date,
        'billNo'=>$billNo,
        'customerId'=>$customerId,
        'productId'=>$productId,
          
        'qty'=>$request->qty,
        'totalAmount'=>$totalAmount ,
        'discount'=>$discount,
        'netAmount'=>$netAmount,
        'paidAmount'=>$paidAmount,
        'rate'=>$rate,
        'netTotal'=>$netTotal,
        'discountTotal'=>$discountTotal,
        'dueAmount'=>$dueAmount,
        'status'=>1,
        ]);
        
        return response()->json($data);
     }




     public function BillSe(Request $request){

        $data=DB::table('products')
        ->leftJoin('product_details', 'products.id', '=', 'product_details.productId')
        ->where('billNo',$request->billNo)->get();

        
        
        return response()->json($data);
     }



     public function SaveBill(Request $request){

        // $datas=DB::table('products')
        // ->leftJoin('product_details', 'products.id', '=', 'product_details.productId')
        // ->where('billNo',$request->billNo)->get();
        
        $datas =DB::table('product_details')->get();
       
        $netTotal=0;
        $discountTotal=0;
        $dueAmount=0;
        $paidAmount=0;
        foreach($datas as $data){
            if($request->billNo == $data->billNo){
                $paidAmount =$paidAmount+ $data->paidAmount;

        $netTotal =$netTotal+$data->netTotal;
        $discountTotal=$discountTotal+$data->discountTotal;
        $dueAmount =$dueAmount+ $data->dueAmount;
                
                
            }
        }
        

        $data1 = BillInfo::insert([
            'billNo'=>$request->billNo,
            'paidAmount'=>$paidAmount,
           'netTotal'=>$netTotal,
           'discountTotal'=>$discountTotal,
           'dueAmount'=>$dueAmount,
        
            
           ]);
           
           return response()->json($data1);

     }
}
