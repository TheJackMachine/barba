<?php namespace JackMachine\Barba\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'jackmachine_barba_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    public $casts = [
        'load_cdn' => 'boolean',
    ];

}
