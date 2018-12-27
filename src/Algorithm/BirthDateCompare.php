<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class BirthDateCompare
{
    public $person1;

    public $person2;

    public $diferenceDays;
    
    public function __construct($person1 = null, $person2 = null) {
        if (!$person1 && !$person2) {
            return;
        }
        
        $isTheFirstPersonMinor = $person1->birthDate < $person2->birthDate;
                
        $this->person1 = $isTheFirstPersonMinor ? $person1 : $person2 ;
        $this->person2 = $isTheFirstPersonMinor ? $person2 : $person1;

        $this->diferenceDays = $this->person2->birthDate->getTimestamp() - $this->person1->birthDate->getTimestamp();
    }
}
