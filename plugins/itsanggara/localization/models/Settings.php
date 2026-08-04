<?php namespace ItsAnggara\Localization\Models;

use Model;

class Settings extends Model
{
    public $implement = ['\System\Behaviors\SettingsModel'];

    public $settingsCode = 'itsanggara_localization_settings';

    public $settingsFields = 'fields.yaml';
}
