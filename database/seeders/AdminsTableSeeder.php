<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $password = Hash::make('Sufi*1234');
        $entry = [
            ['id'=>1,'name'=>'muhammad','type'=>'admin','mobile'=>'03558117754','image'=>'','email'=>'muhammad@gmail.com','password'=>$password,'status'=>1],
             ['id'=>2,'name'=>'sufyan','type'=>'admin','mobile'=>'03224124179','image'=>'','email'=>'sufyan@gmail.com','password'=>$password,'status'=>1],
        ];
        Admin::insert($entry);
    }
}
