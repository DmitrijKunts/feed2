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
            ],
        ],
        'eastar' => [ //деактивирован 31 марта 2022 года.
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=21829&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b~i',
            'extdata' => [
                'description' => ['extdata/eastar/desc_multiparaphrases',],
            ],
        ],
        //MUSICAL


        'banggood' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=19353&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike~i',
            'extdata' => [
                'description' => ['extdata/banggood/desc_multiparaphrases',],
            ],
        ],

        'dhgate4' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20281&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike~i',
            'extdata' => [
                'description' => ['extdata/dhgate/desc_multiparaphrases',],
            ],
        ],
        'dhgate6' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20282&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike~i',
            'extdata' => [
                'description' => ['extdata/dhgate/desc_multiparaphrases',],
            ],
        ],
        'dhgate8' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20283&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike~i',
            'extdata' => [
                'description' => ['extdata/dhgate/desc_multiparaphrases',],
            ],
        ],
        'dhgate15' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20284&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike~i',
            'extdata' => [
                'description' => ['extdata/dhgate/desc_multiparaphrases',],
            ],
        ],

        'tomtop' => [
            'ln' => 'english',
            'geo' => 'en',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=14723&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b|\bcycling|\bbicycle|\bmotobicycle|\bbike~i',
            'extdata' => [
                'description' => ['extdata/tomtop/desc_multiparaphrases',],
            ],
        ],

        // ============UKRAINIAN================
        'touch' => [
            'ln' => 'russian',
            'geo' => 'ua',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20724&format=xml',
            'filter_cat' => [
                2978, 3107, 312, 760,
                149, //Гаджеты и электротранспорт
                // 160, //Электротранспорт
            ],
            'extdata' => [
                'description' => ['extdata/touch/desc_multiparaphrases',],
            ],
            'post_processing' => [
                'name' => ['~ \[\d+?\]~', ''],
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

        // fishki.ua ждем выгрузки
        //itmag
        //ITsell

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
            ],
            'extdata' => [
                'description' => ['extdata/pleer/desc_multiparaphrases',],
            ],
        ],
    ],
];
