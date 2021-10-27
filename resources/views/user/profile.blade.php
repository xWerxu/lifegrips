<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil klienta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ dump($user) }}
                    <h1>
                        Oto twoje dane
                    </h1>
                    <form action="{{route('user.profile')}}" method=POST>
                        <div>
                            <x-label for="first_name" :value="__('Imię')" />

                            <x-input id="first_name" type="text" name="first_name" class="block mt-1 w-full" value="{{$user->first_name}}"/> 
                        </div>
                        <div>
                            <x-label for="last_name" :value="__('Nazwisko')" />

                            <x-input id="last_name" type="text" name="last_name" class="block mt-1 w-full" value="{{$user->last_name}}"/>
                        </div>
                        <div>
                            <x-label for="phone_number" :value="__('Numer Telefonu')"/>

                            <x-input id="phone_number" type="text" name="phone_number" class="block mt-1 w-full" value="{{$user->phone_number}}"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
