<?php

namespace Database\Seeders;

use App\Models\CareHome;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Create Admin User ─────────────────────────────────────
        User::create([
            'name'         => 'ClearSight Admin',
            'email'        => 'admin@clearsight.co.uk',
            'password'     => Hash::make('password'),
            'role'         => 'admin',
            'care_home_id' => null,
        ]);

        // ── Create Sample Care Homes ──────────────────────────────
        $homes = [
            [
                'name'         => 'Amberley Care Home',
                'address'      => '23 Oak Lane, Blackpool, FY1 2AB',
                'manager_name' => 'Sarah Collins',
                'email'        => 'sarah@amberley.co.uk',
                'phone'        => '01253 441220',
            ],
            [
                'name'         => 'Lytham Grange',
                'address'      => '7 Clifton Drive, Lytham, FY8 5AB',
                'manager_name' => 'James Whitfield',
                'email'        => 'james@lythamgrange.co.uk',
                'phone'        => '01253 738811',
            ],
            [
                'name'         => 'Rosewood Lodge',
                'address'      => '14 Manor Road, Preston, PR1 3XZ',
                'manager_name' => 'Linda Patel',
                'email'        => 'linda@rosewood.co.uk',
                'phone'        => '01772 552100',
            ],
        ];

        foreach ($homes as $home) {
            CareHome::create($home);
        }

        // ── Create Sample Care Home User ──────────────────────────
        User::create([
            'name'         => 'Sarah Collins',
            'email'        => 'sarah@amberley.co.uk',
            'password'     => Hash::make('password'),
            'role'         => 'carehome',
            'care_home_id' => 1,
        ]);
    }
}
