<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <a href="index.html">
                <img src="{{asset('images/logo.png')}}">
            </a>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete autofocus/>
            </div>

            <div class="mt-4">
                <x-jet-label for="company" value="{{ __('Firma') }}" />
                <x-jet-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="street" value="{{ __('Straße und Nr') }}" />
                <x-jet-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="city" value="{{ __('PLZ und Stadt') }}" />
                <x-jet-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required/>
            </div>

            <div class="mt-4">
                <x-jet-label for="phoneNumber" value="{{ __('Telefonnummer') }}" />
                <x-jet-input id="phoneNumber" class="block mt-1 w-full" type="text" name="phoneNumber" :value="old('phoneNumber')" required/>
            </div>


            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('Ich stimme den :Nutzungsbedingungen und der :Datenschutzrichtlinie zu.', [
                                        'Nutzungsbedingungen' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Nutzungsbedingungen').'</a>',
                                        'Datenschutzrichtlinie' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Datenschutzrichtlinie').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Schon registriert?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrieren') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
