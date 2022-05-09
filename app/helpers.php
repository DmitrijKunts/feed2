<?php

if (!function_exists('genConst')) {
    function genConst($val, $noise = '')
    {
        return $val == 0 ? 0 : hexdec(substr(sha1($noise), 0, 15)) % $val;
    }
}

if (!function_exists('constSort')) {
    function constSort($items, $noise = '')
    {
        $useArray = gettype($items) == 'array';
        if ($useArray) $items = collect($items);
        $size = $items->count();
        $items = $items->sortBy(function ($item) use ($size, $noise) {
            if (gettype($item) == 'array') {
                return genConst($size, (string)serialize($item) . $noise);
            } else {
                return genConst($size, (string)$item . $noise);
            }
        });
        if ($useArray) return array_values($items->all());
        return $items->values();
    }
}

if (!function_exists('constOne')) {
    function constOne($items, $noise = '')
    {
        return collect(constSort($items, $noise))->first();
    }
}

if (!function_exists('deDouble')) {
    function deDouble($str): string
    {
        // $str = (string)Str::replace('""', '"', $str);
        $str = (string)Str::of($str)->replaceMatches('~"{2,}~s', '"');
        while (true) {
            $t = (string)Str::of($str)->replaceMatches('~\b(\S+?)\b\s+?\b(\1)\b|west-west-~isu', '\1');
            if ($t == $str) return Str::squish($t);
            $str = $t;
        }
    }
}

if (!function_exists('permutation')) {
    function permutation($str, $noise = '')
    {
        if (preg_match_all('~\{([^\{}]+)\}~isu', $str, $m)) {
            foreach ($m[1] as $seq) {
                $parts = explode('|', $seq);
                $partsCount = count($parts);
                if ($partsCount == 1) {
                    $str = str_replace('{' . $seq . '}', $parts[0], $str);
                } else {
                    $ind = genConst($partsCount, $noise . $seq);
                    $str = str_replace('{' . $seq . '}', $parts[$ind], $str);
                }
            }
        }

        return deDouble($str);
    }
}

if (!function_exists('getULP')) {
    function getULP($url)
    {
        $parts = parse_url(trim($url));
        parse_str($parts['query'], $query);
        return trim($query['ulp']);
    }
}
