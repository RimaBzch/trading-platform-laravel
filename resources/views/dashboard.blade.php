<x-app-layout>
    <x-slot name="header"><div class="col">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('') }}
        </h2>

        <div class="card">
            <div class="card-header bg-header-light">
                <h4 class="fw-bold mb-0 text-white">RSI Screener Settings</h4>
            </div>
            <div class="card-body">
                <div class="row">
{{--                    <form action="{{ route('datatable.index', 1) }}" method="POST">--}}
{{--                    <form action="{{ action([\App\Http\Controllers\IndicatorAnalysisController::class, 'update'], [1]) }}" method="PUT">--}}
                    <form action="{{ route('indicator_analyses.update', 1) }}" method="POST">

                    @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="card mt-3 mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Select Pairs</h5>
                                    </div>
                                    <div class="card-body p-4 h-96">
                                        <div class="col-auto pe-0" id="pairs_list">
                                            @php
                                                $pairs = \App\Models\Pair::all();
                                            @endphp
                                            <div class="row row-cols-4" id="pairs_list">
                                                @foreach ($pairs as $pair)
                                                    <div class="col">
                                                        <div class="form-check form-check-inline pair-item">
                                                            <input class="form-check-input" name="pairs[]" value="{{ $pair }}" type="checkbox" id="pairsCheckbox{{ $pair->id }}">
                                                            <label class="form-check-label" for="pairCheckbox{{ $pair->id }}">{{ $pair->pair_name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="card mt-3 mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Select Timeframes</h5>
                                    </div>
                                    <div class="card-body">
                                        <?php $timeframes = ['M1', 'M5', 'M15', 'M30', 'H1', 'H2', 'H4', 'H6', 'H8', 'H12', 'D1', 'W1', 'MN']; ?>
                                        <div class="row" id="timeframes">
                                            @foreach ($timeframes as $key => $timeframe)
                                                <div class="col-3 col-lg-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name="timeframes[]" value="{{ $timeframe }}" type="checkbox" id="timeframeCheckbox{{ $key }}">
                                                        <label class="form-check-label" for="timeframeCheckbox{{ $key }}">{{ $timeframe }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-3 mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">Set RSI Parameters</h5>
                                    </div>

                                    <div class="card-body p-4 h-40">
                                        <div class="row g-2">
                                            <div class="col-lg-12">
                                                <label for="overbought" class="form-label text-900">Overbought:</label>
                                                <input type="number" name="seuil" class="form-control" placeholder="Overbought" value="70" step="0.1" pattern="[0-9]+([,\\.][0-9]+)?">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-3 text-center mt-3 mb-3">
                                <button type="submit" class="btn btn-primary btn-block" id="rsi_analyzer_btn" style="background-color: #02623a; border-color: #02623a; display: flex; align-items: center; justify-content: center;">
                                    <svg class="svg-inline--fa fa-search-dollar fa-w-16 me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search-dollar" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" style="width: 16px; height: 16px;">
                                        <path fill="currentColor" d="M505.04 442.66l-99.71-99.69c-4.5-4.5-10.6-7-17-7h-16.3c27.6-35.3 44-79.69 44-127.99C416.03 93.09 322.92 0 208.02 0S0 93.09 0 207.98s93.11 207.98 208.02 207.98c48.3 0 92.71-16.4 128.01-44v16.3c0 6.4 2.5 12.5 7 17l99.71 99.69c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.59.1-33.99zm-297.02-90.7c-79.54 0-144-64.34-144-143.98 0-79.53 64.35-143.98 144-143.98 79.54 0 144 64.34 144 143.98 0 79.53-64.35 143.98-144 143.98zm27.11-152.54l-45.01-13.5c-5.16-1.55-8.77-6.78-8.77-12.73 0-7.27 5.3-13.19 11.8-13.19h28.11c4.56 0 8.96 1.29 12.82 3.72 3.24 2.03 7.36 1.91 10.13-.73l11.75-11.21c3.53-3.37 3.33-9.21-.57-12.14-9.1-6.83-20.08-10.77-31.37-11.35V112c0-4.42-3.58-8-8-8h-16c-4.42 0-8 3.58-8 8v16.12c-23.63.63-42.68 20.55-42.68 45.07 0 19.97 12.99 37.81 31.58 43.39l45.01 13.5c5.16 1.55 8.77 6.78 8.77 12.73 0 7.27-5.3 13.19-11.8 13.19h-28.1c-4.56 0-8.96-1.29-12.82-3.72-3.24-2.03-7.36-1.91-10.13.73l-11.75 11.21c-3.53 3.37-3.33 9.21.57 12.14 9.1 6.83 20.08 10.77 31.37 11.35V304c0 4.42 3.58 8 8 8h16c4.42 0 8-3.58 8-8v-16.12c23.63-.63 42.68-20.54 42.68-45.07 0-19.97-12.99-37.81-31.59-43.39z"></path>
                                    </svg>
                                    <span style="flex: 1;">Analyze now</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </x-slot>
</x-app-layout>
