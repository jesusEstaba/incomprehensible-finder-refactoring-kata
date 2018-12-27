<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class Finder
{
    private $_personList;
    private $_birthDateCompareList;

    public function __construct(array $personList) {
        $this->_personList = $personList;
    }

    public function find(int $diference): BirthDateCompare {
        $this->_birthDateCompareList = $this->getBirthDateCompareList();
        
        if (!count($this->_birthDateCompareList)) {
            return new BirthDateCompare();
        }

        return $this->getBirthdateCompareBy($diference);
    }
    
    private function getBirthdateCompareBy($diference) {
        $firstBirthDateCompare = $this->_birthDateCompareList[0];

        foreach ($this->_birthDateCompareList as $birthdayCompare) {
            switch ($diference) {
                case Diference::NEAR:
                    if ($birthdayCompare->diferenceDays < $firstBirthDateCompare->diferenceDays) {
                        $firstBirthDateCompare = $birthdayCompare;
                    }
                    break;

                case Diference::FAR:
                    if ($birthdayCompare->diferenceDays > $firstBirthDateCompare->diferenceDays) {
                        $firstBirthDateCompare = $birthdayCompare;
                    }
                    break;
            }
        }
        
        return $firstBirthDateCompare;
    }
    
    private function getBirthDateCompareList() {
        $birthDate = [];
        
        $personNumbers = count($this->_personList);
        
        for ($i = 0; $i < $personNumbers; $i++) {
            for ($j = $i + 1; $j < $personNumbers; $j++) {
                $birthDate[] = new BirthDateCompare($this->_personList[$i], $this->_personList[$j]);
            }
        }
        
        return $birthDate;
    }
}
