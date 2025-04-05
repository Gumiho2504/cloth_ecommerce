<div>
    @php
        if (Auth::check()) {
            $user = Auth::user();
        }
    @endphp
    <h1>Profile</h1>
    @isset($user)
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->email }}</p>
    @endisset



    <div>
        <h1>Cart : {{ $user->carts()->count() }}</h1>
        @foreach ($user->carts()->first()->cartItems as $item)
            <div class="m-3 border-b-4">
                <p class=" text-md text-slate-900">
                    {{ $item->product->name }} |
                    <span class=" text-red-400">uni_price :</span>${{ $item->uni_price }} |
                    <span class=" text-red-400">qantity :</span> {{ $item->quantity }} |
                    <span class=" text-red-400">total :</span>${{ $item->total_price }}
                </p>
            </div>
        @endforeach

        <p class=" text-md text-slate-900">Total : ${{ $user->carts()->first()->total_amount }}</p>
    </div>

</div>
