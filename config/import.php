<?php

return [
    App\Importers\Admitad::class => [
        //============ENGLISH================
        'donner' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=21506&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b~i',
            'extdata' => [
                'description' => ['extdata/donner/desc_multiparaphrases',],
            ],
        ],
        'banggood' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=19353&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b~i',
            'extdata' => [
                'description' => ['extdata/banggood/desc_multiparaphrases',],
            ],
        ],
        'dhgate' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20280&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b~i',
            'extdata' => [
                'description' => ['extdata/dhgate/desc_multiparaphrases',],
            ],
        ],
        'eastar' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=21829&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b~i',
            'extdata' => [
                'description' => ['extdata/eastar/desc_multiparaphrases',],
            ],
        ],
        'tomtop' => [
            'ln' => 'english',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=14723&format=xml',
            'filter' => '~\bdrums?\b|\bpercussions?\b~i',
            'extdata' => [
                'description' => ['extdata/tomtop/desc_multiparaphrases',],
            ],
        ],

        //============RUSSIAN================
        'touch' => [
            'ln' => 'russian',
            'url' => 'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=20724&format=xml',
            'filter_cat' => [2978],
            'extdata' => [
                'description' => ['extdata/touch/desc_multiparaphrases',],
            ],
            'post_processing' => [
                'name' => ['~ \[\d+?\]~', ''],
            ],
        ],
    ],
];
