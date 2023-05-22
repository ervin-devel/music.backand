<?php

namespace App\Traits;

trait DateFormat
{
    public function dateTimeRU()
    {
        $timestamp = strtotime($this->created_at);
        $published = date('d.m.Y', $timestamp);

        if ($published === date('d.m.Y')) {
            return trans('date.today', ['time' => date('H:i', $timestamp)]);
        } elseif ($published === date('d.m.Y', strtotime('-1 day'))) {
            return trans('date.yesterday', ['time' => date('H:i', $timestamp)]);
        } else {
            $formatted = trans('date.later', [
                'time' => date('H:i', $timestamp),
                'date' => date('d F' . (date('Y', $timestamp) === date('Y') ? null : ' Y'), $timestamp)
            ]);

            return strtr($formatted, trans('date.month_declensions'));
        }
    }

    public function getDurationToString($noWrapper = false): string
    {
        $time = gmdate('H:i:s', $this->duration);
        $time = ltrim($time, '00:');

        $wrapper = ' (:TIME) ';
        if (!$noWrapper) {
            return str_replace(':TIME', $time, $wrapper);
        }
        return $time;
    }
}
