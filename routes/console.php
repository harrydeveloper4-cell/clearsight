<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Daily backups at 2 AM
Schedule::command('backup:clean')->daily()->at('02:00');

Schedule::command('backup:run')->weeklyOn(1, '02:30');
// Schedule::command('backup:run')->monthlyOn(1, '02:30');
// Schedule::command('backup:run')->daily()->at('02:30');

Schedule::call(function () {
    $today = Carbon::today();

    // Past dates -> overdue
    Resident::whereNotNull('next_recall_date')
        ->whereDate('next_recall_date', '<', $today)
        ->where('status', '!=', 'overdue')
        ->update(['status' => 'overdue']);

    // Today to +30 days -> due
    Resident::whereNotNull('next_recall_date')
        ->whereDate('next_recall_date', '>=', $today)
        ->whereDate('next_recall_date', '<=', $today->copy()->addDays(30))
        ->where('status', '!=', 'due')
        ->update(['status' => 'due']);

    // More than 30 days -> ok
    Resident::whereNotNull('next_recall_date')
        ->whereDate('next_recall_date', '>', $today->copy()->addDays(30))
        ->where('status', '!=', 'ok')
        ->update(['status' => 'ok']);
})->daily();