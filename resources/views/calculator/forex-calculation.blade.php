<x-app-layout>
    <x-slot name="title">Position Size Calculator</x-slot>

    <div class="container mx-auto px-4 py-8">
        <div class="card-header bg-header-light">
            <h4 class="fw-bold mb-0 text-white">Calculator </h4>
        </div>
        <div class="flex justify-center">
            <div class="w-1/2 bg-white rounded-lg shadow-lg p-6">
                <h1 class="text-center mb-4 text-green-800 text-2xl font-semibold">Position Size Calculator</h1>

                <form method="POST" action="{{ route('calculate') }}">

                    @csrf
                    <div class="mb-4 " >
                        <label for="currency_pair" class="block">Currency Pair:</label>
                        <select class="form-control" id="currency_pair" name="currency_pair" >
                            <option value="" disabled selected>Select a currency pair</option>
                            @foreach ($pairs as $pair)
                                <option value="{{ $pair->id}}">{{ $pair->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="account_currency" class="block">Account Currency:</label>
                        <select class="form-control" id="account_currency" name="account_currency" >
                            <option value="" disabled selected>Select an account currency</option>
                            <option value="AUD">AUD</option>
                            <option value="CAD">CAD</option>
                            <option value="CHF">CHF</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                            <option value="JPY">JPY</option>
                            <option value="NZD">NZD</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>


                    <div class="mb-4">
                        <label for="account_size" class="block">Account Size:</label>
                        <input type="number" class="form-control" id="account_size" name="account_size">
                    </div>

                    <div class="mb-4">
                        <label for="risk_ratio" class="block">Risk Ratio (%):</label>
                        <input type="number" class="form-control" id="risk_ratio" name="risk_ratio" >
                    </div>

                    <div class="mb-4">
                        <label for="stop_loss_pips" class="block">Stop-Loss (Pips):</label>
                        <input type="number" class="form-control" id="stop_loss_pips" name="stop_loss_pips" >
                    </div>

                    <div class="mb-4">
                        <label for="trade_size" class="block">Trade Size (Lots):</label>
                        <input type="number" step="any" class="form-control" id="trade_size" name="trade_size" >
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #02623a; border-color: #02623a;">Calculate</button>
                </form>




    </div>
{{--    @isset($calculatedMoney, $calculatedUnits, $calculatedSizing)--}}

    <div class="w-1/2 bg-white rounded-lg shadow-lg p-6 ml-4">
        <h2 class="text-center mb-4 text-green-800 text-2xl font-semibold">Results</h2>
        <div class="row">
            <div class="col-md-4">
                <h4>Money:</h4>
         @isset($calculatedMoney)
<p>{{ number_format($calculatedMoney ,2) }} € </p>
                @endisset

            </div>
<div class="col-md-4">
<h4>Units:</h4>
    @isset($units)
        <p>{{ number_format($units, 2) }}</p>    @endisset

</div>
<div class="col-md-4">
<h4>Sizing:</h4>
    @isset($sizing)
<p>{{  number_format($sizing, 2) }} lots </p>
    @endisset

</div>
</div>
</div>
{{--@endisset--}}
</div>
</div>

<x-slot name="scripts">
<script src="https://cdn.jsdelivr.net/npm/adminlte@3.2/dist/js/adminlte.min.js"></script>
</x-slot>
</x-app-layout>
