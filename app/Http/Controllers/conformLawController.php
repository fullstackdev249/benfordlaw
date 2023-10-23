<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class conformLawController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function conformLaw(Request $request) {
        $inputDatasetFromRequest = $request->inputDataset;
        $inputDatasetArray = array_map('trim', explode(',', $inputDatasetFromRequest));

        $result = $this->calculateBenfordLaw($inputDatasetArray);
        return view('welcome', ['result' => $result, 'inputDataset' => $inputDatasetFromRequest]);
    }

    private function calculateBenfordLaw($inputNumbers) {
        $totalNumberToConsider = 9;
        $leadingDigitArray = $this->getCountOfLeadingDigit($inputNumbers);
        $isBenfordLawSatisfied = 1;
        $resultArray = array();

        for ($i = 0; $i < $totalNumberToConsider; $i++) {
            $frequencyOfLeadingDigit = $leadingDigitArray[$i];

            if($i > 0 && $leadingDigitArray[$i] > $leadingDigitArray[$i-1]) {
                $isBenfordLawSatisfied = 0;
            }

            $resultArray[$i]['leadingDigit'] = ($i + 1);
            $resultArray[$i]['frequency'] = $frequencyOfLeadingDigit;
            $resultArray[$i]['probability'] = number_format(($frequencyOfLeadingDigit/count($inputNumbers)*100), 2, '.', '');
            $resultArray[$i]['isBenfordLawSatisfied'] = $isBenfordLawSatisfied;
        }
        return $resultArray;
    }

    private function getCountOfLeadingDigit($inputNumbers) {
        $leadingDigitArray = array_fill(0, 9, 0);

        foreach($inputNumbers as $inputNumber) {

            $inputNumber = (string)(int)$inputNumber;
            $leadingDigit =  $inputNumber[0];

            $leadingDigit >= 1 && $leadingDigit <= 9 && $leadingDigitArray[$leadingDigit - 1]++;

        }
        return $leadingDigitArray;
    }
}
