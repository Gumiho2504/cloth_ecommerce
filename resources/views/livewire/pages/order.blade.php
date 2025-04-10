<div>
    <h1 class=" text-3xl text-slate-900 font-extrabold">Order Sumery :</h1>
    @if (session('success'))
        <div
            class="p-4 border border-l-4 border-green-500 rounded-md animate-fade-in duration-1000 delay-200 ease-in-out">
            <p class="text-md text-green-600">{{ session('success') }}</p>
        </div>
    @endif
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
