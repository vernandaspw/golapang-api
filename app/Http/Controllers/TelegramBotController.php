<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramBotController extends Controller
{
    public function send(Request $request)
    {
        try {
            $text = 'tes bot pesan telegram';
            $chatId = '-1001828296476';

            $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
            $chat_id = $chatId;
            $message = $text;

            $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $message,
            ]);
            return response()->json(['message' => 'Notification sent successfully.']);

        } catch (\Throwable$e) {
            return response()->json($e->getMessage());
        }
    }
}
