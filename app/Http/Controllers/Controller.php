<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sentSuccessResponse($data, $message = 'success', $status)
    {
        if ($data === '') {
            return \response()->json([
                'message' => $message
            ], $status);
        } else {
            return \response()->json([
                'data' => $data,
                'message' => $message
            ], $status);
        }
    }

    public function changeLanguage(Request $request)
    {
        $language = $request->lang;
        $cookie = Cookie::make('website_language', $language, 72000);
        $message = $this->getMessage('CHANGE_LANGUAGE_SUCCESS');
        return response()->json(['message' => $message . $language])->withCookie($cookie);
    }

    public function test()
    {
        $message = $this->getMessage('MESSAGE_NOTFOUND');
        return response()->json(['message' => $message], 200);
    }

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
                print($message);
                $message = $this->getMessage('MESSAGE_NOTFOUND');
            }
            return $message;
        } catch (\Exception $error) {
            $message = $this->getMessage('INTERNAL_SERVER_ERROR');
            return response()->json(['message' => $message . $error->getMessage()], 500);
        }
    }
}
