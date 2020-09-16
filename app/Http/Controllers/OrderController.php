<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get("status");
        $buyerEmail = $request->get("buyer_email");

        $orders = \App\Order::with('user')->with('books')->whereHas('user', function ($query) use ($buyerEmail) {
            $query->where('email', 'LIKE', "%$buyerEmail%");
        })->where('status', 'LIKE', "%$status%")->paginate(10);
        return view("orders.index", compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = \App\Order::findOrFail($id);
        return view("orders.edit", compact("order"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = \App\Order::findOrFail($id);
        $order->status = $request->get("status");
        $order->save();
        return redirect()->route("orders.index")->with("status", "Order Status updated");
    }
}
