<x-app-layout>

    <div class="container">
        <br><br><br>
        <div class="card-header bg-header-light">
            <h4 class="fw-bold mb-0 text-white">RSI Screener </h4>
        </div>
        <table id="datatable" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Symbol</th>
                @foreach ($timeframes as $timeframe)
                    <th>{{ ($timeframe) }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($pairs as $pairName)
                @php
                    $pair = App\Models\Pair::where('pair_name', $pairName)->first();
                @endphp
                @if ($pair)
                    <tr>
                        <td>{{ $pair->pair_name }}</td>
                        @foreach ($timeframes as $timeframe)
                            <td>
                                @foreach ($indicatorAnalyses as $indicatorAnalysis)
                                    @if ($indicatorAnalysis->pair_id == $pair->id && $indicatorAnalysis->tool_id == 1)
                                        {{ $indicatorAnalysis->{strtolower($timeframe) . '_current'} }}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>

</x-app-layout>
