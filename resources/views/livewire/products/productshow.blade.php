<div>
    <h1>Product Show</h1>
    <h1 class=" text-3xl font-bold">{{ $product->name }}</h1>
    <p class=" text-slate-700">{{ Str::limit($product->description, 100) . '...' }}</p>
    <div>
        <span>Price : ${{ $product->price }}</span>
        <span>Colors : ${{ $product->colors()->count() }}</span>
    </div>
    <div>

        @foreach ($product->colors as $color)
            <a href="">{{ $color->name }}</a>
            <div class="w-10 h-10 rounded-full {{ $color->css() }}"
                style="background-color: {{ Str::lower($color->name) }}"></div>
        @endforeach

    </div>
