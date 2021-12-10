<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Dziękujemy za założenie konta! Zanim przejdziesz dalej, czy mógłbyś potwierdzić swój adres email klikając w link poniżej? Jeżeli nie dostałeś maila z potwierdzeniem, możemy wysłać nowego.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('Nowa wiadomość została wysłana na maila, który został podany przy rejestracji.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Wyślij ponownie') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Wyloguj się') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
