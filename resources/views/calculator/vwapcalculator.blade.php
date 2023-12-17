<x-app-layout>
    <div class="inside-article">
        <div class="col">
        <div class="container mx-auto px-4 py-6">


            <div class="flex justify-center">

                <div class="w-1/2 bg-white rounded-lg shadow-lg p-6 ">
                    <h1 class="text-center mb-4 text-green-800 text-2xl font-semibold">Vwap Calculator</h1>
                    <form method="post" action="{{ route('vwap.calculate') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="price" class="text-lg">Price:</label>
                            <input type="number" name="price" id="price" step="any" min="0" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <div class="mb-4">
                            <label for="volume" class="text-lg">Volume:</label>
                            <input type="number" name="volume" id="volume" step="any" min="0" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <div class="mb-4">
                            <label for="total_volume" class="text-lg">Total Volume:</label>
                            <input type="number" name="total_volume" id="total_volume" step="any" min="0" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <div class="mb-4">
                            <label for="start_time" class="text-lg">Start Time:</label>
                            <input type="datetime-local" name="start_time" id="start_time" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <div class="mb-4">
                            <label for="end_time" class="text-lg">End Time:</label>
                            <input type="datetime-local" name="end_time" id="end_time" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" style="background-color: #02623a; border-color: #02623a;">Calculate VWAP</button>
                    </form>
                    <br>
                    <div class="mb-4">
                        <label class="text-lg">VWAP:</label>
                        <p id="vwap" class="text-xl">{{ $vwap ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
</x-app-layout>
