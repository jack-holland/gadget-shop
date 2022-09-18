<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use DB;
use Auth;

class OrderController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
         $this->middleware('permission:order-list|order-create|order-edit|order-delete', ['only' => ['index','store','show']]);
         $this->middleware('permission:order-create', ['only' => ['create','store']]);
         $this->middleware('permission:order-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    }
    
    /**
     * index
     * Display the Orders and paginate every 10
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $orders = DB::table('orders')
        ->orderBy('id', 'DESC')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->select('orders.*', 'users.firstname', 'users.surname')
        ->paginate(10);

        return view('orders.index',compact('orders'));
    }
        
    /**
     * show
     * Show Order by ID
     *
     * @param  mixed $order
     * @return void
     */
    public function show(Order $order)
    {
        $orders = DB::table('orders')
        ->orderBy('id', 'DESC')
        ->where('orders.id', $order->id)
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->select('orders.*', 'users.firstname', 'users.surname')
        ->first();

        $products = DB::table('orders_products')
        ->select('products.name', 'products.image', 'products.price', 'orders_products.quantity')
        ->join('orders', 'orders_products.order_id', '=', 'orders.id')
        ->join('products', 'orders_products.product_id', '=', 'products.id')
        ->where('orders_products.order_id', $order->id)
        ->get();

        return view('orders.show',compact('orders'),compact('products'));
    }
    
    /**
     * destroy
     * Delete Order
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        Order::find($id)->delete();

        return redirect()->route('orders.index')
            ->with('success','Order deleted successfully');
    }
    
    /**
     * edit
     * Change the details of an Order
     *
     * @param  mixed $order
     * @return void
     */
    public function edit(Order $order)
    {
        return view('orders.edit',compact('order'));
    }

    /**
     * update
     * Change the Order in the Database
     *
     * @param  mixed $request
     * @param  mixed $order
     * @return void
     */
    public function update(Request $request, Order $order)
    {
         request()->validate([
            'status' => 'required',
        ]);
    
        $order->update($request->all());
    
        return redirect()->route('orders.index')
            ->with('success','Order updated successfully');
    }
    
    /**
     * showOrder
     * Show Order bY ID for the Admin section
     *
     * @return void
     */
    public function showOrder()
    {
        $user = Auth::user();

        $orders = DB::table('orders')
        ->select('orders.id', 'orders.created_at', 'orders.status', 'products.price', 'orders_products.quantity', 'products.name')
        ->where('orders.user_id', $user->id)
        ->join('orders_products', 'orders_products.order_id', '=', 'orders.id')
        ->join('products', 'orders_products.product_id', '=', 'products.id')
        ->groupBy('orders.id')
        ->get();

        return view('showorder',compact('orders'));
    }
    
    /**
     * ordercomplete
     * Order completed page
     *
     * @return void
     */
    public function ordercomplete()
    {
        return view('ordercomplete');
    }
    
    /**
     * showOrderById
     * Show the Order by ID for the User
     *
     * @param  mixed $order
     * @param  mixed $id
     * @return void
     */
    public function showOrderById (Order $order, $id)
    {
        $order = Order::findOrFail($id);
        $user = auth()->user();

        if($user['id'] != $order->user_id)
        {
            return redirect()->route('account')
                ->with('danger','This order does not belong to you.');
        }

        $products = DB::table('orders')
        ->where('orders.id', $order->id)
        ->join('orders_products', 'orders_products.order_id', '=', 'orders.id')
        ->join('products', 'orders_products.product_id', '=', 'products.id')
        ->get();

        return view('order',compact('order'),compact('products'));
    }
}

?>