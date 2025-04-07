<div>
    <div class=" h-60 bg-red-600 w-full rounded-lg relative mt-20">
        <img src="https://img.freepik.com/premium-photo/3d-render-brown-cloth-iridescent-holographic-foil-abstract-art-fashion-background_387680-1447.jpg"
            alt="bgimage" class="w-full h-full rounded-lg relative">
        <img src="https://static.vecteezy.com/system/resources/thumbnails/034/028/820/small_2x/fashion-model-girl-in-beige-wear-png.png"
            alt="" class=" absolute bottom-0 -right-20 w-1/2 h-80 object-contain">
        <div class=" absolute top-1/2 -translate-y-1/2 left-20 text-white">
            <h1 class=" text-3xl font-bold w-8/12">
                20% OFF ONLY TODAY AND GET SPACIAL GIFT!
            </h1>
            <p class="">TODAY ONLY ENJOY AN STYLIST 20% OFF AND RECIEVE EXCLUSIVE GIFT!</p>
            <p>ELEVATE YOUR WARDROPE NOW!</p>
        </div>
    </div>


    <div class=" flex space-x-5 mt-4">
        <div class=" w-3/12 border border-slate-200 rounded-md p-4">
            <div>
                <h1 class=" text-2xl text-slate-800 font-bold">Filter Product</h1>
            </div>

            <div class="mt-3">

                <label for=""Size" class=" text-slate-800 font-medium text-md">Size : </label>

                <select wire:model.live="size" class=" rounded-full">

                    <option value="">All</option>
                    @foreach (\App\Models\Size::all() as $size)
                        <option value="{{ $size->type }}">{{ $size->type }}</option>
                    @endforeach
                </select>
            </div>



            <div class="m-3">
                <label for=""Size" class=" text-slate-800 font-medium text-md">Category : </label>
                <select wire:model.live="category" class=" rounded-full bg-slate-100">
                    <option value="">All</option>
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->slug }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <hr>

            <div class=" text-lg text-slate-900 font-medium m-3">Price :</div>

            <div class=" mt-3">
                <label for=""Size" class=" text-slate-800 font-medium text-md">From : </label>
                <input type="number" wire:model.live="minPrice" class=" rounded-full bg-slate-100">
            </div>
            <div class=" mt-3">
                <label for=""Size" class=" text-slate-800 font-medium text-md">To : </label>
                <input type="number" wire:model.live="maxPrice" class=" rounded-full bg-slate-100">
            </div>

            <div class="m-3">
                <label for=""Size" class=" text-slate-800 font-medium text-md">Color : </label>
                <select wire:model.live="color" class=" rounded-full bg-slate-100">
                    <option value="">All</option>
                    @foreach (\App\Models\Color::all() as $color)
                        <option value="{{ $color->name }}">
                            <div>{{ $color->name }}</div>
                        </option>
                    @endforeach
                </select>
            </div>


            <div>Filters:</div>
            @foreach ($filters as $filter)
                <span class=" text-green-800">{{ $filter }}</span>
            @endforeach
            <br>

        </div>
        <div class="grid grid-cols-2 gap-3 md:grid-cols-2 lg:grid-cols-4 items-start">

            @foreach ($products as $product)
                <livewire:products.product-cart :product="$product" :key="$product->id" />
            @endforeach

        </div>


    </div>




    <div>
        {{ $products->links() }}
    </div>

</div>
