<?php

return [
    App\Importers\Admitad::class => [
        //============ENGLISH================

        //MUSICAL
        'donner' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=21506&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b~i',
            'extdata' => [
                'description' => ['extdata/donner/desc_multiparaphrases',],
                'summary' => ['extdata/donner/desc_multisummary',],
                'alt' => ['extdata/donner/name_multiparaphrases',],
                'pics' => ['extdata/donner/pics',],
            ],
        ],
        'eastar' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=21829&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b~i',
            'extdata' => [
                'description' => ['extdata/eastar/desc_multiparaphrases',],
                'summary' => ['extdata/eastar/desc_multisummary',],
                'alt' => ['extdata/eastar/name_multiparaphrases',],
                'pics' => ['extdata/eastar/pics',],
            ],
        ],
        //MUSICAL


        'banggood' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=19353&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike|fishing|b\rc\b|remote\s+?control|plane|copter~i',
            'extdata' => [
                'description' => ['extdata/banggood/desc_multiparaphrases',],
                'summary' => ['extdata/banggood/desc_multisummary',],
                'alt' => ['extdata/banggood/name_multiparaphrases',],
                'pics' => ['extdata/banggood/pics',],
            ],
        ],

        'dhgate4' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20281&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike|fishing|b\rc\b|remote\s+?control|plane|copter~i',
            'extdata' => [
                'description' => ['extdata/dhgate/desc_multiparaphrases',],
                'summary' => ['extdata/dhgate/desc_multisummary',],
                'alt' => ['extdata/dhgate/name_multiparaphrases',],
                'pics' => ['extdata/dhgate/pics',],
            ],
        ],
        'dhgate6' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20282&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike|fishing|b\rc\b|remote\s+?control|plane|copter~i',
            'extdata' => [
                'description' => ['extdata/dhgate/desc_multiparaphrases',],
                'summary' => ['extdata/dhgate/desc_multisummary',],
                'alt' => ['extdata/dhgate/name_multiparaphrases',],
                'pics' => ['extdata/dhgate/pics',],
            ],
        ],
        'dhgate8' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20283&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike|fishing|b\rc\b|remote\s+?control|plane|copter~i',
            'extdata' => [
                'description' => ['extdata/dhgate/desc_multiparaphrases',],
                'summary' => ['extdata/dhgate/desc_multisummary',],
                'alt' => ['extdata/dhgate/name_multiparaphrases',],
                'pics' => ['extdata/dhgate/pics',],
            ],
        ],
        'dhgate15' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20284&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike|fishing|b\rc\b|remote\s+?control|plane|copter~i',
            'extdata' => [
                'description' => ['extdata/dhgate/desc_multiparaphrases',],
                'summary' => ['extdata/dhgate/desc_multisummary',],
                'alt' => ['extdata/dhgate/name_multiparaphrases',],
                'pics' => ['extdata/dhgate/pics',],
            ],
        ],

        'tomtop' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=14723&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike|fishing|b\rc\b|remote\s+?control|plane|copter~i',
            'extdata' => [
                'description' => ['extdata/tomtop/desc_multiparaphrases',],
                'summary' => ['extdata/tomtop/desc_multisummary',],
                'alt' => ['extdata/tomtop/name_multiparaphrases',],
                'pics' => ['extdata/tomtop/pics',],
            ],
        ],

        // ============UKRAINIAN================
        'touch' => [
            'ln' => 'russian',
            'geo' => 'ua',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20724&format=xml',
            'filter_cat' => [
                2978, //Одежда и аксессуары
                760, //Техника для красоты и здоровья
                312, //Зарядные устройства
                3107, //Товары для кухни
                149, //Гаджеты и электротранспорт
                3197, //Экшн-камеры и стедикамы

                617, //Ноутбуки

                131, //Планшеты
                3003, //Аксессуары для планшетов
            ],
            'extdata' => [
                'description' => ['extdata/touch/desc_multiparaphrases',],
                'summary' => ['extdata/touch/desc_multisummary',],
                'alt' => ['extdata/touch/name_multiparaphrases',],
                'pics' => ['extdata/touch/pics',],
            ],
            'post_processing' => [
                'name' => ['~ \[\d+?\]~', ''],
            ],
        ],

        'itmag' => [
            'ln' => 'russian',
            'geo' => 'ua',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=22581&format=xml',
            'filter_or' => '~держат|тримач|стед[иі]кам~iu',
            'filter_cat' => [
                57, 168, 178, //Зарядные устройства
                193, 224, //Экшн-камеры

                118, //Ноутбуки

                128, //Планшети
                175, //Для планшетів
                4021, //Ноутбуки и планшеты
            ],
            'extdata' => [
                'description' => ['extdata/itmag/desc_multiparaphrases',],
                'summary' => ['extdata/itmag/desc_multisummary',],
                'alt' => ['extdata/itmag/name_multiparaphrases',],
                'pics' => ['extdata/itmag/pics',],
            ],
            'post_processing' => [
                'url' => ['~ua%2Fua%2Fcatalog%2~', 'ua%2Fcatalog%2'],
            ],
        ],

        'itsell' => [
            'ln' => 'russian',
            'geo' => 'ua',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=22578&format=xml',
            'filter_cat' => [
                '3377be9f15', '8a7526dfbc', 'c9d4873229', '117bdd1606', //Зарядные устройства
            ],
            'extdata' => [
                'description' => ['extdata/itsell/desc_multiparaphrases',],
                'summary' => ['extdata/itsell/desc_multisummary',],
                'alt' => ['extdata/itsell/name_multiparaphrases',],
                'pics' => ['extdata/itsell/pics',],
            ],
            'post_processing' => [
                'url' => ['~itsell\.ua%2Fuk%2F~', 'itsell.ua%2F'],
            ],
        ],
        // 'avtmarket' => [
        //     'ln' => 'russian',
        //     'geo' => 'ua',
        //     'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=18829&format=xml',
        //     'extdata' => [
        //         'description' => ['extdata/avtmarket/desc_multiparaphrases',],
        //     ],
        // ],
        // 'agromarket' => [
        //     'ln' => 'russian',
        //     'url' => 'http://export.admitad.com/ru/webmaster/websites/2173558/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=16930&format=xml',
        //     'filter_cat' => [1025],
        //     'extdata' => [
        //         'description' => ['extdata/agromarket/desc_multiparaphrases',],
        //     ],
        // ],


        // ============RUSSIAN================
        'pleer' => [
            'ln' => 'russian',
            'geo' => 'ru',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=14498&format=xml',
            'filter_cat' => [
                4887, //фильтры для воды
                3262, //Принадлежности для пикника и туризма

                5164, //Для любителей кофе - подарки
                4892, //Для приготовления кофе
                4973, //Для чая и кофе - посуда

                6179, 6183, 391, 4875, 2167, 387, 58, 6487, 2549, 3634, 3216, //Зарядные устройства

                3445, 1136, 3643, // зонт
                2411, 1680, 1681, 1682, 1923, // Сушилки
                1225, // Перчатки

                4904, // Здоровье и уход за собой

                2922, 4338, 4426, 5694, 2683, 6478, 3374, 4391, 4389, // Электро

                995, //Экшн-камера
                1178, //Аксессуары для экшн камер
                4907, //Стедикам
                2504, //Монопод
                1335, //штативы
                998, //стедикамы, тележки, слайдеры и другое оборудование

                2485, //Все для рыбалки
                5351, //Зимняя рыбалка
                3018, //Зимняя рыбалка
                4530, //Все для рыбалки
                5805, //Рыбалка

                845, //Ноутбук
                5564, //Игровые ноутбуки

                1840, //Планшет
                1572, //Планшеты и аксессуары
                3214, //Графические планшеты и аксессуары
                1059, //Графический планшет
            ],
            'extdata' => [
                'description' => ['extdata/pleer/desc_multiparaphrases',],
                'summary' => ['extdata/pleer/desc_multisummary',],
                'alt' => ['extdata/pleer/name_multiparaphrases',],
                'pics' => ['extdata/pleer/pics',],
            ],
        ],
    ],
];
