<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="hidden" name="role" id="role" value="eksternal">

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

         <!-- nomor_id -->
         <div class="mt-4">
            <div>
                <x-input-label for="nomor_id" :value="__('Nomor Identitas (NIP/NIK)')" />
                <x-text-input id="nomor_id" class="block mt-1 w-full" type="text" name="nomor_id" :value="old('nomor_id')" required autofocus autocomplete="nomor_id" />
                <x-input-error :messages="$errors->get('nomor_id')" class="mt-2" />
            </div>

        <!-- Instansi -->
        <div class="mt-4">
        <div>
            <x-input-label for="instansi" :value="__('Instansi')" />
            <x-text-input id="instansi" class="block mt-1 w-full" type="text" name="instansi" :value="old('instansi')" required autofocus autocomplete="instansi" />
            <x-input-error :messages="$errors->get('instansi')" class="mt-2" />
        </div>

        <!-- Unit Kerja -->
        <div class="mt-4">
        <div>
            <x-input-label for="unit_kerja" :value="__('Unit Kerja')" />
            <x-text-input id="unit_kerja" class="block mt-1 w-full" type="text" name="unit_kerja" :value="old('unit_kerja')" required autofocus autocomplete="unit_kerja" />
            <x-input-error :messages="$errors->get('unit_kerja')" class="mt-2" />
        </div>

        <!-- Jabatan -->
        <div class="mt-4">
        <div>
            <x-input-label for="jabatan" :value="__('Jabatan')" />
            <x-text-input id="jabatan" class="block mt-1 w-full" type="text" name="jabatan" :value="old('jabatan')" required autofocus autocomplete="jabatan" />
            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
