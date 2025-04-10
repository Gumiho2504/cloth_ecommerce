<div class=" sticky top-2 bg-white flex px-5 py-3 mt-3 justify-between items-center border-b-2 border-slate-500 z-10">
    @php
        $pages = ['Home', 'Category', 'About', 'Contact'];
    @endphp
    <nav class=" hidden sm:flex space-x-4">
        @foreach ($pages as $page)
            <x-nav-link href="{{ route(strtolower($page)) }}" :active="request()->routeIs(strtolower($page))"
                @class([''])>{{ Str::upper($page) }}</x-nav-link>
        @endforeach
    </nav>
    <div class="w-4/12 flex space-x-3">
        <x-ri-shopping-bag-line class="w-6 h-6 text-amber-800" />
        @php
            $username = 'Guest';
            if (Auth::check()) {
                $username = Auth::user()->name;
            }
        @endphp
        <h2 class=" text-xl font-bold">{{ $username }}</h2>


    </div>

    <div class="flex space-x-4 justify-between items-center">
        <x-ri-search-2-line class="icon-size" />
        <x-ri-notification-line class="icon-size" />
        <a href="{{ route('carts') }}"
            class="flex justify-center items-center space-x-2 text-sm py-2 px-3 rounded-full border border-slate-900">
            <span>My Card</span>
            <x-ri-shopping-bag-line class="w-4 h-4 text-slate-800" />
        </a>
        <div class="bar"></div>
        <a href="{{ route('profile') }}">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSA6zq21NVsOxQs4PL4rJU30aiCXEkVrwB-Y19RYowqhUGklgM3SNfj6e-L1UU3mfuyByM&usqp=CAU"
                alt="profile" class="w-9 h-9 rounded-full shadow-sm shadow-slate-300">
        </a>
    </div>
</div>
