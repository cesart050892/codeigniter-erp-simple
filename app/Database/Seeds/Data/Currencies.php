<?php

namespace App\Database\Seeds\Data;

use CodeIgniter\Database\Seeder;

class Currencies extends Seeder
{
    public function run()
    {
        //
        $model = model('App\Models\Currencies');

        $data = array(
            array(
                "id" => "1",
                "name" => "US Dollar",
                "code" => "USD",
                "symbol" => "$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "2",
                "name" => "British Pound",
                "code" => "GBP",
                "symbol" => "£",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "3",
                "name" => "Euro",
                "code" => "EUR",
                "symbol" => "€",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "1",
            ),
            array(
                "id" => "4",
                "name" => "South African Rand",
                "code" => "ZAR",
                "symbol" => "R",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "5",
                "name" => "Danish Krone",
                "code" => "DKK",
                "symbol" => "kr",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "1",
            ),
            array(
                "id" => "6",
                "name" => "Israeli Shekel",
                "code" => "ILS",
                "symbol" => "NIS ",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "7",
                "name" => "Swedish Krona",
                "code" => "SEK",
                "symbol" => "kr",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "1",
            ),
            array(
                "id" => "8",
                "name" => "Kenyan Shilling",
                "code" => "KES",
                "symbol" => "KSh ",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "9",
                "name" => "Kuwaiti Dinar",
                "code" => "KWD",
                "symbol" => "KWD ",
                "precision" => "3",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "10",
                "name" => "Canadian Dollar",
                "code" => "CAD",
                "symbol" => "C$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "11",
                "name" => "Philippine Peso",
                "code" => "PHP",
                "symbol" => "P ",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "12",
                "name" => "Indian Rupee",
                "code" => "INR",
                "symbol" => "₹",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "13",
                "name" => "Australian Dollar",
                "code" => "AUD",
                "symbol" => "$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "14",
                "name" => "Singapore Dollar",
                "code" => "SGD",
                "symbol" => "S$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "15",
                "name" => "Norske Kroner",
                "code" => "NOK",
                "symbol" => "kr",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "1",
            ),
            array(
                "id" => "16",
                "name" => "New Zealand Dollar",
                "code" => "NZD",
                "symbol" => "$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "17",
                "name" => "Vietnamese Dong",
                "code" => "VND",
                "symbol" => "₫",
                "precision" => "0",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "18",
                "name" => "Swiss Franc",
                "code" => "CHF",
                "symbol" => "Fr.",
                "precision" => "2",
                "thousand_separator" => "\'",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "19",
                "name" => "Guatemalan Quetzal",
                "code" => "GTQ",
                "symbol" => "Q",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "20",
                "name" => "Malaysian Ringgit",
                "code" => "MYR",
                "symbol" => "RM",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "21",
                "name" => "Brazilian Real",
                "code" => "BRL",
                "symbol" => "R$",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "22",
                "name" => "Thai Baht",
                "code" => "THB",
                "symbol" => "฿",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "23",
                "name" => "Nigerian Naira",
                "code" => "NGN",
                "symbol" => "₦",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "24",
                "name" => "Argentine Peso",
                "code" => "ARS",
                "symbol" => "$",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "25",
                "name" => "Bangladeshi Taka",
                "code" => "BDT",
                "symbol" => "Tk",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "26",
                "name" => "United Arab Emirates Dirham",
                "code" => "AED",
                "symbol" => "DH ",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "27",
                "name" => "Hong Kong Dollar",
                "code" => "HKD",
                "symbol" => "HK$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "28",
                "name" => "Indonesian Rupiah",
                "code" => "IDR",
                "symbol" => "Rp",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "29",
                "name" => "Mexican Peso",
                "code" => "MXN",
                "symbol" => "$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "30",
                "name" => "Egyptian Pound",
                "code" => "EGP",
                "symbol" => "E£",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "31",
                "name" => "Colombian Peso",
                "code" => "COP",
                "symbol" => "$",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "32",
                "name" => "West African Franc",
                "code" => "XOF",
                "symbol" => "CFA ",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "33",
                "name" => "Chinese Renminbi",
                "code" => "CNY",
                "symbol" => "RMB ",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "34",
                "name" => "Rwandan Franc",
                "code" => "RWF",
                "symbol" => "RF ",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "35",
                "name" => "Tanzanian Shilling",
                "code" => "TZS",
                "symbol" => "TSh ",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "36",
                "name" => "Netherlands Antillean Guilder",
                "code" => "ANG",
                "symbol" => "NAƒ",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "37",
                "name" => "Trinidad and Tobago Dollar",
                "code" => "TTD",
                "symbol" => "TT$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "38",
                "name" => "East Caribbean Dollar",
                "code" => "XCD",
                "symbol" => "EC$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "39",
                "name" => "Ghanaian Cedi",
                "code" => "GHS",
                "symbol" => "‎GH₵",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "40",
                "name" => "Bulgarian Lev",
                "code" => "BGN",
                "symbol" => "Лв.",
                "precision" => "2",
                "thousand_separator" => " ",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "41",
                "name" => "Aruban Florin",
                "code" => "AWG",
                "symbol" => "Afl. ",
                "precision" => "2",
                "thousand_separator" => " ",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "42",
                "name" => "Turkish Lira",
                "code" => "TRY",
                "symbol" => "TL ",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "43",
                "name" => "Romanian New Leu",
                "code" => "RON",
                "symbol" => "RON",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "44",
                "name" => "Croatian Kuna",
                "code" => "HRK",
                "symbol" => "kn",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "45",
                "name" => "Saudi Riyal",
                "code" => "SAR",
                "symbol" => "‎SِAR",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "46",
                "name" => "Japanese Yen",
                "code" => "JPY",
                "symbol" => "¥",
                "precision" => "0",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "47",
                "name" => "Maldivian Rufiyaa",
                "code" => "MVR",
                "symbol" => "Rf",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "48",
                "name" => "Costa Rican Colón",
                "code" => "CRC",
                "symbol" => "₡",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "49",
                "name" => "Pakistani Rupee",
                "code" => "PKR",
                "symbol" => "Rs ",
                "precision" => "0",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "50",
                "name" => "Polish Zloty",
                "code" => "PLN",
                "symbol" => "zł",
                "precision" => "2",
                "thousand_separator" => " ",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "1",
            ),
            array(
                "id" => "51",
                "name" => "Sri Lankan Rupee",
                "code" => "LKR",
                "symbol" => "LKR",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "1",
            ),
            array(
                "id" => "52",
                "name" => "Czech Koruna",
                "code" => "CZK",
                "symbol" => "Kč",
                "precision" => "2",
                "thousand_separator" => " ",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "1",
            ),
            array(
                "id" => "53",
                "name" => "Uruguayan Peso",
                "code" => "UYU",
                "symbol" => "$",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "54",
                "name" => "Namibian Dollar",
                "code" => "NAD",
                "symbol" => "$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "55",
                "name" => "Tunisian Dinar",
                "code" => "TND",
                "symbol" => "‎د.ت",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "56",
                "name" => "Russian Ruble",
                "code" => "RUB",
                "symbol" => "₽",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "57",
                "name" => "Mozambican Metical",
                "code" => "MZN",
                "symbol" => "MT",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "1",
            ),
            array(
                "id" => "58",
                "name" => "Omani Rial",
                "code" => "OMR",
                "symbol" => "ر.ع.",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "59",
                "name" => "Ukrainian Hryvnia",
                "code" => "UAH",
                "symbol" => "₴",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "60",
                "name" => "Macanese Pataca",
                "code" => "MOP",
                "symbol" => "MOP$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "61",
                "name" => "Taiwan New Dollar",
                "code" => "TWD",
                "symbol" => "NT$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "62",
                "name" => "Dominican Peso",
                "code" => "DOP",
                "symbol" => "RD$",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "63",
                "name" => "Chilean Peso",
                "code" => "CLP",
                "symbol" => "$",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "64",
                "name" => "Serbian Dinar",
                "code" => "RSD",
                "symbol" => "RSD",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "65",
                "name" => "Kyrgyzstani som",
                "code" => "KGS",
                "symbol" => "С̲ ",
                "precision" => "2",
                "thousand_separator" => ".",
                "decimal_separator" => ",",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "66",
                "name" => "Iraqi Dinar",
                "code" => "IQD",
                "symbol" => "ع.د",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "67",
                "name" => "Peruvian Soles",
                "code" => "PEN",
                "symbol" => "S/",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            ),
            array(
                "id" => "68",
                "name" => "Moroccan Dirham",
                "code" => "MAD",
                "symbol" => "DH",
                "precision" => "2",
                "thousand_separator" => ",",
                "decimal_separator" => ".",
                "swap_currency_symbol" => "0",
            )

        );

        foreach ($data as $result) {
            $entity = new \App\Entities\Currencies($result);
            $model->insert($entity);
        }
    }
}