<?php

namespace App\Console\Commands\Debug;

use Illuminate\Console\Command;

use App\Models\User;

class MakeAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:make-account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default admin account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Default admin credentials
        $email = "admin@admin.com";
        $password = "admin";

        // Check if admin account already exists
        $admin = User::where('email', $email)->first();

        if ($admin) {
            $this->info('Admin account already exists');
            return;
        }

        // Create admin account
        $admin = User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->info('Admin account created');
        $this->info('Email: ' . $email);
        $this->info('Password: ' . $password);
    }
}
