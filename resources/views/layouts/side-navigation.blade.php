<aside class="bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 w-64">
    <div class="flex items-center justify-center h-16">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
    </div>
    <nav class="space-y-2 py-4">
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="nav-link">
            {{ __('Home') }}
        </x-nav-link> 
         <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="nav-link">

{{ __('Rsi Screener') }}

</x-nav-link>
        <x-nav-link :href="route('calculator')" :active="request()->routeIs('calculator')" class="nav-link">
            {{ __('Calculator') }}
        </x-nav-link>
      

<x-nav-link :href="route('vwap.index')" :active="request()->routeIs('vwap.index')" class="nav-link">

{{ __('VWAP Calculator') }}

</x-nav-link>
    </nav>
</aside>
