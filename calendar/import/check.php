				<?php
				require 'vendor/autoload.php';
use Carbon\Carbon;
				$schedule = [
            'start' => '2015-11-18 09:00:00',
            'end' => '2015-11-18 17:00:00',
        ];

        $start = Carbon::instance(new DateTime($schedule['start']));
        $end = Carbon::instance(new DateTime($schedule['end']));

        $events = [
            [
                'created_at' => '2015-11-18 10:00:00',
                'updated_at' => '2015-11-18 13:00:00',
            ],
            [
                'created_at' => '2015-11-18 14:00:00',
                'updated_at' => '2015-11-18 16:00:00',
            ],
        ];

        $minSlotHours = 1;
        $minSlotMinutes = 0;
        $minInterval = CarbonInterval::hour($minSlotHours)->minutes($minSlotMinutes);

        $reqSlotHours = 1;
        $reqSlotMinutes = 0;
        $reqInterval = CarbonInterval::hour($reqSlotHours)->minutes($reqSlotMinutes);

        function slotAvailable($from, $to, $events){
            foreach($events as $event){
                $eventStart = Carbon::instance(new DateTime($event['created_at']));
                $eventEnd = Carbon::instance(new DateTime($event['updated_at']));
                if($from->between($eventStart, $eventEnd) && $to->between($eventStart, $eventEnd)){
                    return false;
                }
            }
            return true;
        }

        foreach(new DatePeriod($start, $minInterval, $end) as $slot){
            $to = $slot->copy()->add($reqInterval);

            echo $slot->toDateTimeString() . ' to ' . $to->toDateTimeString();

            if(slotAvailable($slot, $to, $events)){
                echo ' is available';
            }

            echo '<br />';
        }
?>