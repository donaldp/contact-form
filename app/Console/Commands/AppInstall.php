<?php

namespace App\Console\Commands;

use App\Exceptions\DatabaseException;
use App\Models\Gender;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AppInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install application';

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
     * @return int
     */
    public function handle()
    {
        $this->info('Running migrations.');

        if ($this->migrate() !== 0) {
            return $this->error('An error occured while trying to run migrations. \nAbandoning installation.');
        }

        $this->info('Running seeder.');

        if ($this->seed() !== 0) {
            return $this->error('An error occured while trying to run seeders. \nAbandoning installation.');
        }

        $this->info("\n🚀🚀 You have successfully installed the application.\n");

        $this->table(['Page', 'Path'], [
            ['Login Page', '/login'],
            ['Contact Form', '/'],
        ]);

        $this->info('');

        $this->info("💻 Your login email is: \"admin@contact-us.ex\"\n🔐 Your password is:\"p@ssw0rd\"");

        return Command::SUCCESS;
    }

    /**
     * Run database migrations.
     *
     * @return int exit code
     */
    private function migrate()
    {
        return Artisan::call('migrate');
    }

    /**
     * Run database seeders.
     *
     * @return int exit code
     */
    private function seed()
    {
        /** return if seeder has already ran. */
        if (Gender::count() > 0) return 0;

        return Artisan::call('db:seed');
    }
}
