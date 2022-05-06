<?php

namespace Tests\Feature;

use App\Importers\Admitad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AdmitadTest extends TestCase
{
    use WithFaker;

    private function makeOffer()
    {
        return (object)[
            'code' => $this->faker->bothify('?????-#####'),
            'merchant' => $this->faker->word(),
            'ln' => 'english',
            'geo' => 'en',
            'name' => $this->faker->words(3, true),
            'category' => $this->faker->words(3, true),
            'pictures' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph(),
            'summary' => $this->faker->sentence(),
            'alt' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2),
            'oldprice' => $this->faker->randomFloat(2),
            'currencyId' => 'USD',
            'url' => $this->faker->url(),
            'vendor' => $this->faker->word(),
            'model' => $this->faker->word(),
        ];
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_postProcessing()
    {

        $offer = $this->makeOffer();
        $offer->name .= ' [4545]';
        $data['post_processing'] = [
            'name' => ['~ \[\d+?\]~', ''],
        ];
        Admitad::postProcessing($offer, $data);
        $this->assertNotTrue(Str::contains($offer->name, '[4545]'), $offer->name);
    }

    // public function test_download()
    // {
    //     Storage::fake('xml-test');
    //     Admitad::download(
    //         'http://export.admitad.com/ru/webmaster/websites/866689/products/export_adv_products/?user=traffoLocker&code=285bbf510d&feed_id=21506&format=xml',
    //         "xml/donner-test.xml"
    //     );
    // }
}
