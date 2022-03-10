<?php

return [
    App\Importers\Admitad::class => [
        'donner' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=21506&format=xml',
            'filter' => '~drum|percussion~i',
        ],
        'banggood' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=19353&format=xml',
            'filter' => '~drum|percussion~i',
        ],
        'dhgate' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20280&format=xml',
            'filter' => '~drum|percussion~i',
        ],
        'eastar' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=21829&format=xml',
            'filter' => '~drum|percussion~i',
        ],
        'tomtop' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=14723&format=xml',
            'filter' => '~drum|percussion~i',
        ],
    ],
];
