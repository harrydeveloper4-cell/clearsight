<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Daily backups at 2 AM
Schedule::command('backup:clean')->daily()->at('02:00');

Schedule::command('backup:run')->weeklyOn(1, '02:30');
// Schedule::command('backup:run')->monthlyOn(1, '02:30');
// Schedule::command('backup:run')->daily()->at('02:30');
