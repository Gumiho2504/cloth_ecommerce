<div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <img class="p-8 rounded-t-lg"
            src="https://s3.ap-south-1.amazonaws.com/modelfactory.in/upload/2023/Jan/12/blog_images/805400762d8cd9113cc51f3e5aee53f9.jpg"
            alt="product image" />
    </a>
    <div class="px-5 pb-5">
        <a href="{{ route('product.show', $product->slug) }}">
            <h5 class="whitespace-nowrap overflow-hidden text-ellipsis text-base font-semibold tracking-tight sm:text-xl   text-gray-900 dark:text-white">
                {{ $product->name }}</h5>
        </a>
        <div>
            <div class="flex items-center mt-2.5 mb-5 space-x-1">
                @foreach ($product->colors as $color)
                    <x-color @class([$color->css()]) />
                @endforeach



            </div>

        </div>
        <div class="flex items-center justify-between">
            <span class="text-3xl font-bold text-gray-900 dark:text-white">${{ $product->price }}</span>
            <button wire:click="addToCart()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <h5 class=" hidden sm:inline">Add
                    to cart</h5>
                <svg class="w-5 h-5 -ms-2 me-2 sm:hidden" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                </svg>

            </button>
        </div>
    </div>
</div>
