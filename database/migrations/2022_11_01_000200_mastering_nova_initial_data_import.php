<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class MasteringNovaInitialDataImport extends Migration
{
    public function up()
    {
        Artisan::call('db:seed', [
            '--class' => 'MasteringNovaOrion\Database\Seeders\MasteringNovaOrionCourseSeeder',
            '--force' => true,
        ]);
    }

    public function down()
    {
        //
    }
}
