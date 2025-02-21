<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    // public function handle()
    // {
    //     $botman = app('botman');

    //     // Automatically greet the user
    //     $botman->hears('{message}', function (BotMan $botman, $message) {
    //         $this->startConversation($botman);
    //     });

    //     $botman->listen();
    // }
    public function handle()
    {
        $botman = app('botman');
   
        $botman->hears('{message}', function(BotMan $botman, $message) {
              $this->askName($botman);
       });
   
        $botman->listen();
    }

    public function askName(BotMan $botman)
    {
        $botman->ask('Hello! What is your Name?', function(Answer $answer, $conversation) use ($botman) {
            $name = $answer->getText();
            $this->say('Nice to meet you, ' . $name);
            
            $conversation->ask('Can you provide your email?', function(Answer $answer, $conversation) use ($botman) {
                $email = $answer->getText();
                
                // Validate the email format
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Use the BotMan instance to reply
                    $botman->reply('Email: ' . $email);
                    
                    $conversation->ask('Confirm if the above email is correct. You can simply reply with yes or no.', function(Answer $answer) use ($email, $botman, $conversation) {
                        $confirmEmail = $answer->getText();
                        if (strtolower($confirmEmail) === 'yes') {
                            $botman->reply('We have got your details: Email confirmed: ' . $email);
                        } elseif (strtolower($confirmEmail) === 'no') {
                            $botman->reply('Okay, let\'s try again.');
                            $this->askName($botman); // Restart the email asking process
                        } else {
                            $botman->reply('I didn\'t understand that. Please reply with yes or no.');
                            $conversation->repeat(); // Repeat the confirmation question
                        }
                    });
                } else {
                    // Provide feedback for invalid email
                    $botman->reply('That doesn\'t seem like a valid email address. Please provide a valid email.');
                    // Repeat the email asking process
                    $conversation->repeat();
                }
            });
        });
    }
}
