<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('update-notification-preferences') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="notification_email" class="inline-flex items-center">
                                    <input type="checkbox" id="notification_email" name="notification_email" class="form-checkbox" {{ $user->notification_email ? 'checked' : '' }}>
                                    <span class="ml-2">Receive notifications by email</span>
                                </label>
                            </div>
                            <div>
                                <label for="notification_telegram" class="inline-flex items-center">
                                    <input type="checkbox" id="notification_telegram" name="notification_telegram" class="form-checkbox" {{ $user->notification_telegram ? 'checked' : '' }}>
                                    <span class="ml-2">Receive notifications by Telegram</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save Preferences
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
