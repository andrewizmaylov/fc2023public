<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Merch;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderPlaced;
use Inertia\Inertia;

class OrderController extends Controller
{
	public function __construct()
	{
		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Inertia::render('Order/OrderIndex', [
			'orders' => Order::with(['user.contact', 'merch'])->orderBy('created_at', 'DESC')->get(),
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreOrderRequest $request)
	{
		$validated = $request->validated();

		$order = Order::create($validated);

		$dto = array(
			'order_id' => $order->id,
			'user'     => User::with(['contact', 'address'])->find($request->user_id),
			'product'  => Merch::find($request->merch_id),
		);

		User::where('email', env('ADMIN_EMAIL'))->first()->notify(new OrderPlaced($dto));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Order $order)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Order $order)
	{
		return Inertia::render('Order/OrderShow', [
			'order' => $order->load(['user', 'user.contact', 'merch'])
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateOrderRequest $request, Order $order)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Order $order)
	{
		//
	}
}
