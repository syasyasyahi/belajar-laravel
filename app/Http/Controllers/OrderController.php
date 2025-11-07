<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\order;
use App\Models\orders_detail;
use App\Models\product;
use DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "All Transactions";
        $datas = [];
        return view('order.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $prefix = "ORD";
        $date = now()->format('dmY');
        //select max from orders
        $lastTransaction = order::whereDate('created_at', now()->toDateString())->orderBy('id', 'desc')->first();
        $lastNumber = 0;
        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction->order_code, -4);
        }
        $runningNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $order_code = $prefix . "-" . $date . "-" . $runningNumber;
        return view('order.create', compact('categories', 'order_code'));
    }
    public function getProducts()
    {
        try {
            $products = product::with('category')->get();
            return response()->json($products);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Fetch product failed',
                'status' => false,
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $order = Order::create([
                'order_code' => $request->order_code,
                'order_amount' => $request->subTotal,
                'order_status' => 1,
                'order_subtotal' => $request->GrandTotal
            ]);

            foreach ($request->cart as $item) {
                orders_detail::insert([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'qty' => $item['quantity'],
                    'order_price' => $item['product_price'],
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'order_code' => $request->order_code
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
