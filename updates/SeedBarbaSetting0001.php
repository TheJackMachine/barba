<?php namespace JackMachine\Barba\Updates;

use Seeder;
use JackMachine\Barba\Models\Settings;


class SeedBarbaSetting0001 extends Seeder
{

    public function run()
    {
        $settings = Settings::instance();
        $settings->default_namespace = 'stdView';
        $settings->load_cdn = false;
        $settings->load_minimal_transition = false;
        $settings->save();
    }

}
