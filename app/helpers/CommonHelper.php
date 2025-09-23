<?php
// app/Helpers/CommonHelper.php
namespace App\Helpers;

class CommonHelper
{
    public static function convertNumberToWords($number)
    {
        $words = array(
            0 => '',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety'
        );

        $digits = ['', 'Hundred', 'Thousand', 'Lakh', 'Crore'];

        if ($number == 0) {
            return 'Zero Only';
        }

        $result = '';
        $i = 0;

        while ($number > 0) {
            $divider = ($i == 1) ? 10 : 100;
            $numberPart = $number % $divider;
            $number = (int)($number / $divider);

            if ($numberPart) {
                $str = '';
                if ($numberPart < 21) {
                    $str = $words[$numberPart];
                } else {
                    $str = $words[(int)($numberPart / 10) * 10] . ' ' . $words[$numberPart % 10];
                }
                $result = $str . ' ' . $digits[$i] . ' ' . $result;
            }

            $i += ($divider == 10) ? 1 : 2;
        }

        return 'Rupees ' . trim($result) . ' Only';
    }
}
