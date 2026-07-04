<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@amanprojects.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin@1234'),
                'email_verified_at' => now(),
            ]
        );

        $superAdminRole = Role::where('name', 'super-admin')->first();
        if ($superAdminRole && !$user->roles()->where('role_id', $superAdminRole->id)->exists()) {
            $user->roles()->attach($superAdminRole);
        }

        Profile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'title' => 'Full Stack Developer',
                'bio' => 'Welcome to my portfolio! I am a passionate developer with experience in building modern web applications.',
            ]
        );
    }
}
