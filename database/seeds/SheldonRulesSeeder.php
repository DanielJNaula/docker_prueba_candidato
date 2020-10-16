<?php

use App\Models\SheldonRule;
use Illuminate\Database\Seeder;

class SheldonRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SheldonRule::create(array('option_1' => 'tijeras', 'option_2' => 'papel'));
        SheldonRule::create(array('option_1' => 'papel', 'option_2' => 'roca'));
        SheldonRule::create(array('option_1' => 'roca', 'option_2' => 'lagarto'));

        SheldonRule::create(array('option_1' => 'lagarto', 'option_2' => 'Spock'));
        SheldonRule::create(array('option_1' => 'Spock', 'option_2' => 'tijeras'));
        SheldonRule::create(array('option_1' => 'tijeras', 'option_2' => 'lagarto'));

        SheldonRule::create(array('option_1' => 'lagarto', 'option_2' => 'papel'));
        SheldonRule::create(array('option_1' => 'papel', 'option_2' => 'Spock'));
        SheldonRule::create(array('option_1' => 'Spock', 'option_2' => 'roca'));
        SheldonRule::create(array('option_1' => 'roca', 'option_2' => 'tijeras'));
    }
}
