<?php

namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class KetxuatCSDL extends Command implements SelfHandling {

    /**
     * The console command name.
     *
     * @var string
     */
    //protected $name = 'dump:data';
        protected $name = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a dump.sql in storage path';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $this->info('Database Backup Started');
 
        $host = Config::get('database.connections.mysql.host');
        $database = Config::get('database.connections.mysql.database');
        $username = Config::get('database.connections.mysql.username');
        $password = Config::get('database.connections.mysql.password');
        $backupPath = app_path() . "\storage\backup\\";
        $backupFileName = $database . "-" . date("Y-m-d-H-i-s") . '.sql';
 
        //for linux replace the path with /usr/local/bin/mysqldump (The path might varies).
        $path = "c:\\xampp\mysql\bin\mysqldump";
 
        //without password
        //$command = $path . " -u " . $username . " " . $database . " > " . $backupPath . $backupFileName;
        //with password
        $command = $path . " -u " . $username . " -p " . $password . " " . $database . " > " . $backupPath . $backupFileName;
        system($command);
        $this->info('Backup File Created At: ' . $backupPath . $backupFileName);
        $this->info('Database Backup Completed');
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle() {
        //
    }

// FROM YOUR start/artisan.php
//Artisan::add(new ExportTables);
// FROM YOUR CLI or CMD
//php artisan dump:data
}
