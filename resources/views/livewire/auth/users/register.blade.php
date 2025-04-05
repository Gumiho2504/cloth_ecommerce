<div class="w-full h-full mx-auto my-auto flex justify-center items-center bg-red-200">
    <form action="" wire:submit.prevent="register">
        <div
            class=" flex flex-col space-y-3 mx-auto my-auto w-min h-min p-4 border border-slate-900 justify-start items-start">

            <div>
                <x-input-label value="Name" />
                <x-text-input placeholder="Enter your name" wire:model="name" />
                <x-input-error :messages="$errors->get('name')" />
            </div>
            <div>
                <x-input-label value="Email" />
                <x-text-input placeholder="Enter your email" wire:model="email" />
                @error('email')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <x-input-label value="Name" />
                <x-text-input placeholder="password" wire:model="password" type="password" />
                <x-input-error :messages="$errors->get('password')" />
            </div>
            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" wire:model="password_confirmation"
                    class="border rounded p-2 w-full">
            </div>

            <x-primary-button tyepe="submit">Register</x-primary-button>


        </div>
    </form>

</div>
