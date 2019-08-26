<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BbsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'name01',
            'comment' => 'TESTTESTTEST01',
        ];
        DB::table('bbs')->insert($param);

        $param = [
            'name' => 'name02',
            'comment' => 'TESTTESTTEST02',
        ];
        DB::table('bbs')->insert($param);

        $param = [
            'name' => 'name03',
            'comment' => 'TESTTESTTEST03',
        ];
        DB::table('bbs')->insert($param);
    }
}
