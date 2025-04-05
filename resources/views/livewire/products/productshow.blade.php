<div>
    <h1>Product Show : {{ $product->id }}</h1>
    <h1 class=" text-3xl font-bold">{{ $product->name }}</h1>
    <p class=" text-slate-700">{{ Str::limit($product->description, 100) . '...' }}</p>
    <div>
        <span>Price : ${{ $product->price }}</span>

    </div>
    <div>

        @foreach ($product->colors as $color)
            <a href="">{{ $color->name }}</a>
            <div class="w-10 h-10 rounded-full {{ $color->css() }}"
                style="background-color: {{ Str::lower($color->name) }}"></div>
        @endforeach

        <div class="m-3">
            <label for=""Size" class=" text-slate-800 font-medium text-md">Color : </label>
            <select wire:model.live="color_id" class=" rounded-full bg-slate-100">

                @foreach ($product->colors as $color)
                    <option value="{{ $color->id }}">
                        <div>{{ $color->name }}</div>
                    </option>
                @endforeach
            </select>
        </div>



        <div class="mt-3">

            <label for=""Size" class=" text-slate-800 font-medium text-md">Size : </label>

            <select wire:model.live="size_id" class=" rounded-full">


                @foreach (\App\Models\Size::all() as $size)
                    <option value="{{ $size->id }}">{{ $size->type }}</option>
                @endforeach
            </select>
        </div>

        <div>Stock = {{ $stockByColor }}</div>
        <div>{{ $color_id }} - {{ $size_id }}</div>
    </div>
