<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Tests\TestCase;

class HelperTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_genConst()
    {
        $this->assertTrue(genConst(1000, '123') == genConst(1000, '123'));
        $this->assertNotTrue(genConst(1000, '123') == genConst(1000, '1234'));
    }

    public function test_constSort()
    {
        $this->assertTrue(constSort(range(0, 1000), '123') == constSort(range(0, 1000), '123'));
        $this->assertNotTrue(constSort(range(0, 1000), '123') == constSort(range(0, 1000), '1234'));
    }

    public function test_constOne()
    {
        $this->assertTrue(constOne(range(0, 1000), '123') == constOne(range(0, 1000), '123'));
        $this->assertNotTrue(constOne(range(0, 1000), '123') == constOne(range(0, 1000), '1234'));
    }

    public function test_deDouble()
    {
        $str = '212 Double double dOuble wist-wist- west-west-west-West-west-west-wEst-west- dashdjk "" dfgs """  """" """""""" dtgsdt  " ';
        $res = deDouble($str);

        $this->assertNotTrue(Str::contains($res, '""'), $res);
        $this->assertTrue(Str::contains($res, '"'), $res);

        $this->assertTrue(Str::of($res)->match('~wEst-~i') == '', $res);

        $this->assertTrue(Str::of($res)->match('~Double double dOuble~i') == '', $res);
        $this->assertTrue(Str::of($res)->match('~double~i') != '', $res);

        $this->assertNotTrue(Str::contains($res, '  '), $res);
    }

    public function test_permutation()
    {
        $str = '{' . collect(range(0, 100))->join('|') . '}';

        $this->assertTrue(permutation($str, '123') == permutation($str, '123'));
        $this->assertNotTrue(permutation($str, '123') == permutation($str, '1234'));
    }
}
