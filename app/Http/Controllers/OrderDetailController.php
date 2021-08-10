<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $order_id)
    {
        //return OrderDetail::where('order_id','like', $order_id)->get();
        //return OrderDetail::join('orders','orders.order_id','order_details.order_id')->get();
        return OrderDetail::join('articles','articles.article_id','order_details.article_id')
                            ->select("order_details.order_detail_id","order_details.order_id","articles.article_id","articles.article_name","articles.description","order_details.unit_price","order_details.quantity","order_details.is_active")
                            ->where('order_details.order_id','=', $order_id)
                            //->where('order_details.is_active','=','1')
                            ->get();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return OrderDetail::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail, $id)
    {
        $order_detail_updated = OrderDetail::find($id);
        $order_detail_updated ->update($request->all());
        return $order_detail_updated;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }

    public function delete(Request $request, $id)
    {
        $order_detail_deleted = OrderDetail::find($id);
        $order_detail_deleted -> delete($id);
        return $order_detail_deleted;
    }
}
