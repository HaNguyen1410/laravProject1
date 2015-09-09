<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Config\database;

class KetxuatCSDL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'db:backup';
    protected $signature = 'mysqldump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tạo ra một file dum.sql trong thư mục storage';

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
    static public function handle()
    {
//       $this->info('Bắt đầu sao lưu CSDL! ');       
 
        $host = \Config::get('database.connections.mysql.host');
        $database = \Config::get('database.connections.mysql.database');
        $username = \Config::get('database.connections.mysql.username');
//        $password = \Config::get('database.connections.mysql.password');
        $backupPath = storage_path() . "\dumps\\";
        $backupFileName = $database . "-" . date("Ymd-His") . '.sql';
 
        //Đường dẫn chạy mysqldump trong xampp của MySQL.
        $path = "c:\\xampp\mysql\bin"; 
        
            //without password
                $command = $path . "mysqldump -h " . $host . " -u " . $username . " " . $database .
                        " > " . $backupPath . $backupFileName;
            //with password
            // $command = $path . " -u " . $username . " -p " . $password . " " . $database . " > " . $backupPath . $backupFileName;
                system($command);
//                $this->info('Backup File Created At: ' . $backupPath . $backupFileName);
//                $this->info('Database Backup Completed');

                return redirect('quantri.sao-luu-phuc-hoi-du-lieu');       
    }
    
}
//if ($this->confirm('Do you wish to continue? [y|N]')) {
//}