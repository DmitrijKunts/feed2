<?php

use App\Models\Offer;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('stat', function () {
    $this->info('Geos');
    $res = Offer::selectRaw('count(*) as c, geo')->groupBy('geo')->get();
    $rows = [];
    foreach ($res as $r) {
        $rows[] = [$r->geo, $r->c];
    }
    $this->table(
        ['Geo', 'Value'],
        $rows
    );

    $this->info('Languages');
    $res = Offer::selectRaw('count(*) as c, ln')->groupBy('ln')->get();
    $rows = [];
    foreach ($res as $r) {
        $rows[] = [$r->ln, $r->c];
    }
    $this->table(
        ['Language', 'Value'],
        $rows
    );
})->purpose('Show statistic.');
