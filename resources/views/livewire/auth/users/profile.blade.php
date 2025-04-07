<div>
    @php
        if (Auth::check()) {
            $user = Auth::user();
            $cart = $user->carts()->first();
        }
    @endphp
    <h1>Profile</h1>
    @isset($user)
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->email }}</p>
        <button wire:click="logout" class=" text-red-400 px-4 py-3 bg-red-900">Logout</button>
    @endisset




    @if (auth()->user()->carts->count() > 0)
        <div>
            <div class=" flex justify-between" wire:click="deleteCart({{ $cart->id }})">
                <h1>Cart : {{ $user->carts()->count() }}</h1>
                <button class=" text-md text-red-600">remove</button>
            </div>

            @forelse ($user->carts()->first()->cartItems as $item)
                <div class="m-3 border-b-4">
                    <p class=" text-md text-slate-900">
                        {{ $item->product->name }} |
                        <span class=" text-red-400">uni_price :</span>${{ $item->uni_price }} |
                        <span class=" text-red-400">qantity :</span> {{ $item->quantity }} |
                        <span class=" text-red-400">total :</span>${{ $item->total_price }} |
                        <button wire:click="deleteCardItem({{ $item->id }})" class=" text-red-400">Delete</button>
                    </p>
                </div>
            @empty
                <p class=" text-md text-slate-900">Empty</p>
            @endforelse



            <p class=" text-md text-slate-900">Total : ${{ $user->carts()->first()->total_amount }}</p>
        </div>
    @endif
</div>
