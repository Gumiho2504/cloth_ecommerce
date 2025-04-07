<div class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
            <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                <img class="w-full dark:hidden"
                    src="https://s3.ap-south-1.amazonaws.com/modelfactory.in/upload/2023/Jan/12/blog_images/805400762d8cd9113cc51f3e5aee53f9.jpg"
                    alt="" />
                <img class="w-full hidden dark:block"
                    src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="" />
            </div>

            <div class="mt-6 sm:mt-8 lg:mt-0">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                    {{ $product->name }}
                </h1>
                <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                    <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white ">
                        ${{ $product->price }}
                    </p>


                </div>

                <div class="mt-4 flex flex-col space-y-3">
                    <p class="text-md font-medium text-gray-700 sm:text-xl dark:text-white ">
                        Size
                    </p>

                    <div class=" flex space-x-1">
                        @foreach ($product->sizes as $size)
                            <button type="button" wire:click="selectSize({{ $size->id }})"
                                class=" text-md font-semibold flex justify-center items-center w-12 h-12 border-2
                                {{ $size_id === $size->id ? 'border-blue-700 text-white bg-blue-500' : 'text-slate-500' }} border-slate-500 text-center rounded-md  ">
                                {{ $size->type }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 flex flex-col space-y-3">
                    <p class="text-md font-medium text-gray-700 sm:text-xl dark:text-white ">
                        Color
                    </p>

                    <div class=" flex space-x-2">
                        @foreach ($product->colors as $color)
                            <button wire:click="selectColor({{ $color->id }})"
                                class=" p-4 w-8 h-8 rounded-full {{ $color_id === $color->id ? ' outline outline-2 outline-offset-2 outliine-blue-700' : '' }} {{ $color->css() }}"></button>
                        @endforeach
                    </div>


                </div>


                <div
                    class="text-sm max-w-20 text-center my-4 p-1 border  rounded-full {{ $stockByColor > 0 ? 'bg-sky-100 text-sky-500 border-sky-500' : 'bg-red-100 text-red-500 border-red-500 line-through' }}">
                    {{ $stockByColor > 0 ? 'Stock: ' . $stockByColor : 'No Stock' }}
                </div>


                <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                    <a href="#" title=""
                        class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-white focus:outline-none bg-blue-600 rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        role="button">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>
                        Add to favorites
                    </a>


                </div>

                <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                <p class="mb-6 text-gray-500 dark:text-gray-400">
                    {{ Str::limit($product->description, 200) }}
                </p>

                <p class="text-gray-500 dark:text-gray-400">
                    {{ Str::substr($product->description, 200, 400) }}
                </p>
                <a wire:click.prevent="test()">Test</a>
            </div>
        </div>
    </div>
</div>
