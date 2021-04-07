<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @forelse ($data as $keyData => $valueData)
                <div class="p-2 m-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    
                    <div class="flex flex-wrap justify-center p-2 bg-white border-b border-gray-200">
                        <label class="block text-gray-900 font-bold text-4xl">
                            {{ $keyData }}
                        </label>
                    </div>

                    @forelse ($valueData as $key => $value)
                        <div class="flex flex-wrap justify-center p-2 bg-white border-b border-gray-200">
                            <div class="">
                                <label class="block text-gray-900 font-bold mb-1 md:mb-0 pr-4">
                                    {{ $key }}
                                </label>
                            </div>
                            <div class="">
                                <label class="block text-gray-500 font-bold mb-1 md:mb-0 pr-4">
                                    {{ $value }}
                                </label>
                            </div>
                        </div>
                    @empty
                        <x-label for="name" :value="__('No se obtuvo respuesta')" />
                    @endforelse
                </div>
            @empty
                <x-label for="name" :value="__('No se obtuvo respuesta')" />
            @endforelse
        </div>
    </div>
</x-guest-layout>
