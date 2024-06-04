<?php

class Time
{
    public function getTime($date){
        return date('H:i - F jS, Y ', strtotime($date));
    }
    function getTimeWithoutYear($date){
        return date('H:i - F jS, ', strtotime($date));
    }
    function getTimeWithoutHours($date){
        return date('F jS, Y', strtotime($date));
    }
    function getTimeOnlyHours($date){
        return date('H:i', strtotime($date));
    }
}