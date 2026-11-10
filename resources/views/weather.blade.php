
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Weather search
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('weather.index') }}" method="GET">
                    <div class="flex gap-2">
                        <x-text-input
                            type="text"
                            name="city"
                            placeholder="Enter a city..."
                            class="flex-1"
                            :value="$city"
                            required
                        />

                        <x-primary-button>
                            Search
                        </x-primary-button>
                    </div>
                </form>

                @if ($coordinates && $weather)
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">
                            {{ $coordinates['name'] }}, {{ $coordinates['country'] }}
                        </h3>

                        <p>
                            Temperature: {{ $weather['main']['temp'] }} °C
                        </p>

                        <p>
                            Feels like: {{ $weather['main']['feels_like'] }} °C
                        </p>

                        <p>
                            Humidity: {{ $weather['main']['humidity'] }} %
                        </p>

                        <p>
                            Weather: {{ $weather['weather'][0]['description'] }}
                        </p>
                    </div>
                @elseif ($city)
                    <p class="mt-6">
                        City not found.
                    </p>
                @endif

                @if ($forecast)
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">
                            5-day forecast
                        </h3>

                        @foreach ($forecast as $date => $item)
                            <div class="mt-4">
                                <h4 class="font-semibold">
                                    {{ $date }}
                                </h4>

                                <p>
                                    Time: {{ substr($item['dt_txt'], 11, 5) }}
                                </p>

                                <p>
                                    Temperature: {{ $item['main']['temp'] }} °C
                                </p>

                                <p>
                                    Feels like: {{ $item['main']['feels_like'] }} °C
                                </p>

                                <p>
                                    Weather: {{ $item['weather'][0]['description'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
