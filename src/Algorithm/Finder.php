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
        if ($diference === Diference::NEAR) {
            return $this->getBirthdateCompareByNear();
        }
        
        return $this->getBirthdateCompareByFar();
    }
    
    private function getBirthdateCompareByNear() {
        $firstBirthDateCompare = $this->_birthDateCompareList[0];

        foreach ($this->_birthDateCompareList as $birthdayCompare) {
            if ($birthdayCompare->diferenceDays < $firstBirthDateCompare->diferenceDays) {
                $firstBirthDateCompare = $birthdayCompare;
            }
        }
        
        return $firstBirthDateCompare;
    }
    
    private function getBirthdateCompareByFar() {
        $firstBirthDateCompare = $this->_birthDateCompareList[0];

        foreach ($this->_birthDateCompareList as $birthdayCompare) {
            if ($birthdayCompare->diferenceDays > $firstBirthDateCompare->diferenceDays) {
                $firstBirthDateCompare = $birthdayCompare;
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
