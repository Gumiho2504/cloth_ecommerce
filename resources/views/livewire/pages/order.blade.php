<div>
    <h1 class=" text-3xl text-slate-900 font-extrabold">Order Sumery :</h1>

    <div class="mt-4 flex flex-col space-y-3">
        @forelse ($orders as $order)
            <div class="border border-dotted rounded-xl p-4 max-w-md">
                <h4>Order Id : {{ $order->id }}</h4>
                <div>
                    @foreach ($order->orderItems as $item)
                        <p>{{ $item->product->name }} : {{ $item->quantity }} </p>
                    @endforeach
                </div>
                <p>Order Status : {{ $order->status }}</p>
                <div class="flex justify-between">
                    <p>Order Total : {{ $order->total_amount }}</p>
                    <p>Order Date : {{ $order->created_at }}</p>
                </div>


            </div>
        @empty
            <p>No Order</p>
        @endforelse
    </div>

</div>
