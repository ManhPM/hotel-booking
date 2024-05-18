<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MessageService
{
    public function numberToLetter($num)
    {
        return chr(64 + $num);
    }

    public function letterToNumber($letter)
    {
        return ord($letter) - 64;
    }

    public function getMessage($messageCode)
    {
        try {
            $spreadsheet = IOFactory::load(__DIR__ . '/message.xlsx');
            $worksheet = $spreadsheet->getActiveSheet();

            $row = $worksheet->getRowIterator(1, 1)->current();

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(TRUE);

            $languages = [];
            foreach ($cellIterator as $cell) {
                if ($cell->getValue() !== null) {
                    $languages[] = $cell->getValue();
                }
            }
            $message = null;
            $language = App::getLocale();
            $highestValue = $this->letterToNumber($worksheet->getHighestColumn());
            for ($rowIndex = 2; $rowIndex <= $highestValue; $rowIndex++) {
                $colLetter = $this->numberToLetter($rowIndex);
                if ($worksheet->getCell($colLetter . '1')->getValue() == $language) {
                    for ($colIndex = 2; $colIndex <= $worksheet->getHighestRow(); $colIndex++) {
                        if (
                            $worksheet->getCell('A' . $colIndex)->getValue() == $messageCode
                        ) {
                            $message = $worksheet->getCell($colLetter . $colIndex)->getValue();
                            break 2;
                        }
                    }
                }
            }
            if (!$message) {
                $message = $this->getMessage('MESSAGE_NOTFOUND');
            }
            return $message;
        } catch (\Exception $error) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message . $error->getMessage()], 500);
        }
    }
}
