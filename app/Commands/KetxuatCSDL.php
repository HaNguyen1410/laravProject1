<?php

namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use View,
    Response,
    Validator,
    Input,
    Mail,
    Session;
use Carbon\Carbon;

class KetxuatCSDL extends Command implements SelfHandling {

    /**
     * The console command name.
     *
     * @var string
     */
    //Lệnh backup CSDL trong cửa sổ comand-line
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
    public function SaoLuuCSDL() {
        $this->info('Database Backup Started');
 
        $host = Config::get('database.connections.mysql.host');
        $database = Config::get('database.connections.mysql.database');
        $username = Config::get('database.connections.mysql.username');
        $password = Config::get('database.connections.mysql.password');
        $backupPath = "C:\Users\Admin\Downloads\\";
        $backupFileName = $database . "-" . date("Y-m-d-H-i-s") . '.sql';
 
        //Đường dẫn chạy mysqldump trong xampp của MySQL.
        $path = "c:\\xampp\mysql\bin";
 
        //without password
        //$command = $path . " -u " . $username . " " . $database . " > " . $backupPath . $backupFileName;
        //with password
        $command = $path . " -u " . $username . " -p " . $password . " " . $database . " > " . $backupPath . $backupFileName;
        system($command);
        $this->info('Backup File Created At: ' . $backupPath . $backupFileName);
        $this->info('Database Backup Completed');
        
        return view('quantri.sao-luu-phuc-hoi-du-lieu');
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
