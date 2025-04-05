<div>
    <h1>AminLogin</h1>
    <form action="" wire:submit.prevent="login">
        @csrf
        <div>
            <label for="">email</label>
            <input type="text" name="" id="" wire:model="email">
            @error('email')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="">password</label>
            <input type="password" name="" id="" wire:model="password">
            @error('password')
                <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit">Login</button>
    </form>
</div>
