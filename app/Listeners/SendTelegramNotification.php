<?php

namespace App\Listeners;
use App\Models\Tool;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use App\Events\IndicatorAnalysisUpdated;
use App\Models\Pair;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Telegram\Bot\Api;

class SendTelegramNotification implements ShouldQueue
{
    use InteractsWithQueue;




    public function handle(IndicatorAnalysisUpdated $event)
    {
        $this->indicatorAnalysis = $event->indicatorAnalysis;
        $previousValues = $event->previousValues;
        $currentValues = $this->indicatorAnalysis->getAttributes();
        $pairs = Pair::all();
        $tools = Tool::all();


        foreach ($currentValues as $attribute => $currentValue) {



            if (!in_array($attribute, ['created_at', 'updated_at'])) {
                   $previousValue = $previousValues[$attribute];
                if ($currentValue >= 70 && $currentValue !== $previousValue && $previousValue <70 ) {
                    $pair = $pairs->firstWhere('id', $this->indicatorAnalysis->pair_id);
                    $tool = $tools->firstWhere('id', $this->indicatorAnalysis->tool_id);

                    $message = "The $tool->name_tool value has reached or exceeded 70 in the $pair->pair_name currency pair. This event occurred on the $attribute timeframe.";
                    $this->sendTelegramMessage($message);
                }
            }
        }
    }
    private function sendTelegramMessage($message)
    {
        $botToken = '5842050626:AAGgD2vK2xKWfL8lREbshQGUBpKDorKu-4k';
        $users = User::where('isPremium', true)->get();
        $telegram = new Api($botToken);
        foreach ($users as $user) {
            echo("$user->notification_email");
            if ($user->notification_telegram) {
                $chatId = $user->chat_id;
                if (!$chatId) {
                    $chatId = $this->getChatIdByUsername($telegram, $user->telegram_username);

                    if ($chatId) {
                        $user->chat_id = $chatId;
                        $user->save();
                    }
                }

                if ($chatId) {
                    $telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => $message,
                    ]);
                }
            } 
            if ($user->notification_email) {
                $emailData = [
                    'message' => $message,
                ];

                Mail::to($user->email)->send(new NotificationMail($emailData));
            }
        }

    }

    private function getChatIdByUsername(Api $telegram, $username)
    {
        $url = 'https://api.telegram.org/bot' . $telegram->getAccessToken() . '/getUpdates';
        $json = file_get_contents($url);
        $response = json_decode($json, true);
        if ($response['ok'] && isset($response['result'])) {
            foreach ($response['result'] as $result) {
                if (isset($result['message']['from']['username']) && $result['message']['from']['username'] === $username) {
                    return $result['message']['chat']['id'];
                }
            }
        }

        return null;

    }
}
