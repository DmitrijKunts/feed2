<?php

namespace App\Actions;

use App\Models\Offer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SearchAction
{

    public function handle(array $validated)
    {
        $query = (string)Str::of($validated['q'])
            ->replaceMatches('~[\?:\'"|!&\(\)\-\+\*<>/\\\\]~', ' ')
            ->replaceMatches('~\b\w{1,2}\b~u', '')
            ->trim()
            ->replaceMatches('~\s+~', '|');

        $rank = $validated['ln'] == 'english' ? 1.3 : 2.0;
        $offers = Offer::selectRaw("offers.*, tsv <=> to_tsquery(ln::regconfig, ?) as rank", [$query])
            ->where('ln', $validated['ln'])
            ->where('geo', $validated['geo'])
            ->whereRaw("tsv <=> to_tsquery(ln::regconfig, ?) < ?", [$query, $rank])
            ->orderBy('rank')
            ->limit($validated['c'] ?? 20)
            ->get();
        return [$offers, $query];
    }
}
