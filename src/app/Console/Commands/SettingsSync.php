<?php

namespace Backpack\Settings\app\Console\Commands;

use Illuminate\Console\Command;
use Backpack\Settings\app\Models\Setting;

class SettingsSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs settings definitions with config/settings.php';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $settings = config('settings');
        foreach ($settings as $index => $setting) {
          // search for existing record
            $record = Setting::where('key', $setting['key'])->first();
            if ($record) {
              // if exists, update all except value
                $record->update([
                'name' => $setting['name'],
                'description' => $setting['description'],
                'field' => $setting['field'],
                'active' => $setting['active'],
                ]);
            } else {
                Setting::insert($setting);
            }
        }

        // purge settings not present in settings.php
        Setting::whereNotIn('key', collect($settings)->pluck('key')->all())
          ->delete();

        $this->info("Settings updated");
    }
}
