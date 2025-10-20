<?php

namespace App\Service;

class MessageGenerator
{
public function getHappyMessage():string
{
    $message=[
        'believe you can and you are halfway there',
        'the best way to predict the future is to create it ',
        'every day may not be good ... but theres something good in everyday!',

    ];
    $index=array_rand($message);
    return $message[$index];
}
}