<?php

$symbols = '1234567890'
    .'абвгдеёжзийклмнопрстуфхцчшщъыьэюя'
    .'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'
    .'abcdefghijklmnopqrstuvwxyz'
    .'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

$vowels = 'аеёиоуыэюя'
        .'АЕЁИОУЫЭЮЯ'
        .'aeiouy'
        .'AEIOUY';

$consonants = 'бвгджзйклмнпрстфхцчшщ'
            .'БВГДЖЗЙКЛМНПРСТФХЧЦШЩ'
            .'bcdfghjklmnpqrstvwxz'
            .'BCDFGHJKLMNPQRSTVWXYZ';

$json_str = file_get_contents('php://input');
$json_obj = json_decode($json_str);

$srcArr = preg_split('//u',$json_obj -> text,-1,PREG_SPLIT_NO_EMPTY);

$result = [
    'letter_freq' => [],
    'vowels_freq' => 0,
    'consonants_freq' => 0
];

foreach ($srcArr as $item=>$sym) {
    if (strpos($symbols, $sym)) {
        if(array_key_exists($sym, $result['letter_freq'])) {
            $result['letter_freq'][$sym]++;
        } else {
            $result['letter_freq'][$sym] = 1;
        }
    } 
    
    if(strpos($vowels, $sym) !== false) {
        $result['vowels_freq']++;
    }
    if(strpos($consonants, $sym) !== false) {
        $result['consonants_freq']++;
    }
}

echo json_encode($result);
