<div class="bg-white py-2 antialiased dark:bg-gray-900 md:py-2">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>

        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">


                @forelse ($carts as $cart)
                    <div class="space-y-6">
                        @forelse ($cart->cartItems as $item)
                            <livewire:components.cart-item :cart="$cart" :cartItem="$item" :key="$item->id">
                            @empty
                                <p class=" text-md text-slate-900">No Cart Item <a href="{{ route('home') }}"
                                        class=" text-red-400 underline">shop now
                                        -></a></p>
                        @endforelse
                    </div>
                @empty
                    <p class=" text-md text-slate-900">No Cart <a href="{{ route('home') }}"
                            class=" text-red-400 underline">shop now
                            -></a></p>
                @endforelse



            </div>
            @if ($carts->count() > 0)
                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div
                        class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

                        @if (session('error'))
                            <div
                                class="p-4 border border-l-4 border-red-500 rounded-md animate-fade-in duration-1000 delay-200 ease-in-out">
                                <p class="text-md text-red-600">{{ session('error') }}</p>
                            </div>
                        @endif

                        <div class="space-y-4">
                            <div class="space-y-2">
                                {{-- <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">$7,592.00</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                                <dd class="text-base font-medium text-green-600">-$299.00</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Store Pickup</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">$99</dd>
                            </dl>

                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">$799</dd>
                            </dl> --}}
                            </div>

                            <dl
                                class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>

                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    ${{ $cart->total_amount ?? 0 }}
                                </dd>
                            </dl>
                        </div>

                        <button wire:click="placeOrder()" wire:loading.attr="disabled"
                            class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <div wire:loading.remove>Proceed
                                to Checkout</div>
                            <div wire:loading wire:target="placeOrder()">
                                Proceesing ..
                            </div>
                        </button>

                        <div class="flex items-center justify-center gap-2">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                            <a href="{{ route('home') }}" wire:click.prevent="remove"
                                class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                Continue Shopping
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>

                            </a>
                        </div>
                    </div>


                </div>
            @endif

        </div>
    </div>
</div>
