<?php


return [

	// add a backup folder in the app/database/ or your dump folder
        // Đường dẫn storage_path() . '/dumps/' file được lưu vào storage/dumps trong laravProject1
        // thư mục /dumps/ được tạo ra khi lần đầu chạy lệnh "php artisan db:backup" Trong cmd
	'path' => storage_path() . '/dumps/',
        //'path' => 'C:/Users/Admin/Downloads/',

	// add the path to the restore and backup command of mysql
        // this exemple is if your are using MAMP server on a mac
        // on windows: 'C:\\...\\mysql\\bin\\'
        // on linux: '/usr/bin/'
        // trailing slash is required
	'mysql' => [
		'dump_command_path' => 'C:\\xampp\\mysql\\bin\\',
		'restore_command_path' => 'C:\\xampp\\mysql\\bin\\',
	],

	// s3 settings
	's3' => [
		'path' => ''
	],

	// Use GZIP compression
    'compress' => false,
];

