<?php

namespace App\Console\Commands;

use App\Models\IndicatorAnalysis;
use App\Models\Pair;
use Illuminate\Console\Command;
use Telegram\Bot\Api;
use GuzzleHttp\Client;

class SendTelegramNotification extends Command
{
    protected $signature = 'telegram:notification';

    protected $description = 'Send notification to Telegram';

    public function handle()
    {
        $indicatorAnalyses = IndicatorAnalysis::all();
        $pairs = Pair::all();

        foreach ($indicatorAnalyses as $indicatorAnalysis) {
            $previousValues = json_decode($indicatorAnalysis->previous_values, true);

            if ($this->hasValueChanged($indicatorAnalysis, $previousValues)) {
                $currentValues = $this->getCurrentValues($indicatorAnalysis);

                foreach ($currentValues as $key => $value) {
                    if (strcmp($previousValues[$key], $value) !== 0 && $value >= 70) {
                        $pair = $pairs->firstWhere('id', $indicatorAnalysis->pair_id);
                        if ($pair !== null) {
                            $message = 'Value has exceeded 70 for ' . $pair->pair_name . ' (' . $key . ')';
                            $this->sendTelegramMessage($message);
                        } else {
                            $message = 'Value has exceeded 70 for ' . $indicatorAnalysis->pair_id . ' (' . $key . ')';
                            $this->sendTelegramMessage($message);
                        }
                    }
                }
            }

            $currentValues = $this->getCurrentValues($indicatorAnalysis);
            $indicatorAnalysis->previous_values = json_encode($currentValues);
            $indicatorAnalysis->save();
        }

        $this->info('Notification sent to Telegram!');
    }


    private function hasValueChanged($indicatorAnalysis, $previousValues)
    {
        if ($previousValues === null) {
            return true; // Treat it as a change since previous values are not available
        }

        $currentValues = $this->getCurrentValues($indicatorAnalysis);


        foreach ($currentValues as $key => $value) {
            if (strcmp($previousValues[$key], $value) !== 0) {

                // dd('previouskey', $previousValues[$key], 'value', $value);

                return true; // Value has changed for the current key
            }
        }


        return false;
    }

    private function getCurrentValues($indicatorAnalysis)
    {
        return [
            'm1' => $indicatorAnalysis->m1,
            'm5' => $indicatorAnalysis->m5,
            'm15' => $indicatorAnalysis->m15,
            'm30' => $indicatorAnalysis->m30,
            'h1' => $indicatorAnalysis->h1,
            'h2' => $indicatorAnalysis->h2,
            'h4' => $indicatorAnalysis->h4,
            'h6' => $indicatorAnalysis->h6,
            'h8' => $indicatorAnalysis->h8,
            'h12' => $indicatorAnalysis->h12,
            'd1' => $indicatorAnalysis->d1,
            'w1' => $indicatorAnalysis->w1,
            'm1_current' => $indicatorAnalysis->m1_current,
            'm5_current' => $indicatorAnalysis->m5_current,
            'm15_current' => $indicatorAnalysis->m15_current,
            'm30_current' => $indicatorAnalysis->m30_current,
            'h1_current' => $indicatorAnalysis->h1_current,
            'h2_current' => $indicatorAnalysis->h2_current,
            'h4_current' => $indicatorAnalysis->h4_current,
            'h6_current' => $indicatorAnalysis->h6_current,
            'h8_current' => $indicatorAnalysis->h8_current,
            'h12_current' => $indicatorAnalysis->h12_current,
            'd1_current' => $indicatorAnalysis->d1_current,
            'w1_current' => $indicatorAnalysis->w1_current,
            'mn_current' => $indicatorAnalysis->mn_current,
            'm1_last_closed_bar' => $indicatorAnalysis->m1_last_closed_bar,
            'm5_last_closed_bar' => $indicatorAnalysis->m5_last_closed_bar,
            'm15_last_closed_bar' => $indicatorAnalysis->m15_last_closed_bar,
            'm30_last_closed_bar' => $indicatorAnalysis->m30_last_closed_bar,
            'h1_last_closed_bar' => $indicatorAnalysis->h1_last_closed_bar,
            'h2_last_closed_bar' => $indicatorAnalysis->h2_last_closed_bar,
            'h4_last_closed_bar' => $indicatorAnalysis->h4_last_closed_bar,
            'h6_last_closed_bar' => $indicatorAnalysis->h6_last_closed_bar,
            'h8_last_closed_bar' => $indicatorAnalysis->h8_last_closed_bar,
            'h12_last_closed_bar' => $indicatorAnalysis->h12_last_closed_bar,
            'd1_last_closed_bar' => $indicatorAnalysis->d1_last_closed_bar,
            'w1_last_closed_bar' => $indicatorAnalysis->w1_last_closed_bar,
            'mn_last_closed_bar' => $indicatorAnalysis->mn_last_closed_bar,
            'm1_fl_current' => $indicatorAnalysis->m1_fl_current,
            'm5_fl_current' => $indicatorAnalysis->m5_fl_current,
            'm15_fl_current' => $indicatorAnalysis->m15_fl_current,
            'm30_fl_current' => $indicatorAnalysis->m30_fl_current,
            'h1_fl_current' => $indicatorAnalysis->h1_fl_current,
            'h2_fl_current' => $indicatorAnalysis->h2_fl_current,
            'h4_fl_current' => $indicatorAnalysis->h4_fl_current,
            'h6_fl_current' => $indicatorAnalysis->h6_fl_current,
            'h8_fl_current' => $indicatorAnalysis->h8_fl_current,
            'h12_fl_current' => $indicatorAnalysis->h12_fl_current,
            'd1_fl_current' => $indicatorAnalysis->d1_fl_current,
            'w1_fl_current' => $indicatorAnalysis->w1_fl_current,
            'mn_fl_current' => $indicatorAnalysis->mn_fl_current,
            'm1_fl_last_closed_bar' => $indicatorAnalysis->m1_fl_last_closed_bar,
            'm5_fl_last_closed_bar' => $indicatorAnalysis->m5_fl_last_closed_bar,
            'm15_fl_last_closed_bar' => $indicatorAnalysis->m15_fl_last_closed_bar,
            'm30_fl_last_closed_bar' => $indicatorAnalysis->m30_fl_last_closed_bar,
            'h1_fl_last_closed_bar' => $indicatorAnalysis->h1_fl_last_closed_bar,
            'h2_fl_last_closed_bar' => $indicatorAnalysis->h2_fl_last_closed_bar,
            'h4_fl_last_closed_bar' => $indicatorAnalysis->h4_fl_last_closed_bar,
            'h6_fl_last_closed_bar' => $indicatorAnalysis->h6_fl_last_closed_bar,
            'h8_fl_last_closed_bar' => $indicatorAnalysis->h8_fl_last_closed_bar,
            'h12_fl_last_closed_bar' => $indicatorAnalysis->h12_fl_last_closed_bar,
            'd1_fl_last_closed_bar' => $indicatorAnalysis->d1_fl_last_closed_bar,
            'w1_fl_last_closed_bar' => $indicatorAnalysis->w1_fl_last_closed_bar,
            'mn_fl_last_closed_bar' => $indicatorAnalysis->mn_fl_last_closed_bar,
            'm1_sl_current' => $indicatorAnalysis->m1_sl_current,
            'm5_sl_current' => $indicatorAnalysis->m5_sl_current,
            'm15_sl_current' => $indicatorAnalysis->m15_sl_current,
            'm30_sl_current' => $indicatorAnalysis->m30_sl_current,
            'h1_sl_current' => $indicatorAnalysis->h1_sl_current,
            'h2_sl_current' => $indicatorAnalysis->h2_sl_current,
            'h4_sl_current' => $indicatorAnalysis->h4_sl_current,
            'h6_sl_current' => $indicatorAnalysis->h6_sl_current,
            'h8_sl_current' => $indicatorAnalysis->h8_sl_current,
            'd1_sl_current' => $indicatorAnalysis->d1_sl_current,
            'w1_sl_current' => $indicatorAnalysis->w1_sl_current,
            'mn_sl_current' => $indicatorAnalysis->mn_sl_current,
            'm1_sl_last_closed_bar' => $indicatorAnalysis->m1_sl_last_closed_bar,
            'm5_sl_last_closed_bar' => $indicatorAnalysis->m5_sl_last_closed_bar,
            'm15_sl_last_closed_bar' => $indicatorAnalysis->m15_sl_last_closed_bar,
            'm30_sl_last_closed_bar' => $indicatorAnalysis->m30_sl_last_closed_bar,
            'h1_sl_last_closed_bar' => $indicatorAnalysis->h1_sl_last_closed_bar,
            'h2_sl_last_closed_bar' => $indicatorAnalysis->h2_sl_last_closed_bar,
            'h4_sl_last_closed_bar' => $indicatorAnalysis->h4_sl_last_closed_bar,
            'h6_sl_last_closed_bar' => $indicatorAnalysis->h6_sl_last_closed_bar,
            'h8_sl_last_closed_bar' => $indicatorAnalysis->h8_sl_last_closed_bar,
            'd1_sl_last_closed_bar' => $indicatorAnalysis->d1_sl_last_closed_bar,
            'w1_sl_last_closed_bar' => $indicatorAnalysis->w1_sl_last_closed_bar,
            'mn_sl_last_closed_bar' => $indicatorAnalysis->mn_sl_last_closed_bar,
            'type_analyse' => $indicatorAnalysis->type_analyse,



        ];
    }

    private function sendTelegramMessage($message)
    {
        $botToken = '5842050626:AAGgD2vK2xKWfL8lREbshQGUBpKDorKu-4k';
        $chatId = '6292399035';

        $telegram = new Api($botToken);
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message
        ]);
    }
}
