<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')"/>
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                          :value="old('first_name')" required autofocus autocomplete="first_name"/>
            <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')"/>
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                          :value="old('last_name')" required autofocus autocomplete="last_name"/>
            <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
        </div>

        <!-- Mobile -->
        <div>
            <x-input-label for="mobile" :value="__('Mobile')"/>
            <x-text-input id="mobile" class="block mt-1 w-full" type="text" name="mobile"
                          :value="old('mobile')" required autofocus autocomplete="mobile"/>
            <x-input-error :messages="$errors->get('mobile')" class="mt-2"/>
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" :value="__('Phone')"/>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                          :value="old('phone')" required autofocus autocomplete="phone"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
        </div>

        <!-- Father_name -->
        <div>
            <x-input-label for="father_name" :value="__('Father Name')"/>
            <x-text-input id="father_name" class="block mt-1 w-full" type="text" name="father_name"
                          :value="old('father_name')" required autofocus autocomplete="father_name"/>
            <x-input-error :messages="$errors->get('father_name')" class="mt-2"/>
        </div>

        <!-- Parent_phone -->
        <div>
            <x-input-label for="parent_phone" :value="__('Parent phone')"/>
            <x-text-input id="parent_phone" class="block mt-1 w-full" type="text" name="parent_phone"
                          :value="old('parent_phone')" required autofocus autocomplete="parent_phone"/>
            <x-input-error :messages="$errors->get('parent_phone')" class="mt-2"/>
        </div>

        <!-- Gender -->
        <div>
            <x-input-label for="gender" :value="__('Gender')"/>

                    <select id="gender" name="gender" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">

                        <option value=""></option>
                        <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">male</option>
                        <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">female</option>
                    </select>

            <x-input-error :messages="$errors->get('gender')" class="mt-2"/>
        </div>
@if($errors->has('this number already exists'))
        <h1>unique</h1>
        @enderror
{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')"/>--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required--}}
{{--                          autocomplete="username"/>--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2"/>--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')"/>--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                          type="password"--}}
{{--                          name="password"--}}
{{--                          required autocomplete="new-password"/>--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2"/>--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                          type="password"--}}
{{--                          name="password_confirmation" required autocomplete="new-password"/>--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>--}}
{{--        </div>--}}

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
