<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeederSettingDefaults extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'type'  => 'checkbox',
                'key'   => 'notify_email',
                'name'  => 'Notify by email',
                'value' => false,
                'description' => 'Send notifications by email'
            ],[
                'type'  => 'text',
                'key'   => 'email_username',
                'name'  => 'Email account',
                'value' => 'account@email.com',
                'description' => 'Email account'
            ],[
                'type'  => 'text',
                'key'   => 'email_password',
                'name'  => 'Email password',
                'value' => 'password',
                'description' => 'Email account password'
            ],[
                'type'  => 'checkbox',
                'key'   => 'notify_telegram',
                'name'  => 'Notify by Telegram',
                'value' => true,
                'description' => 'Send notifications by Telegram'
            ]
        ];

        foreach($settings as $field){
            DB::table('setting')->updateOrInsert([
                'key'   => $field['key'],
                'value' => $field['value'],
            ], [
                'type'  => $field['type'],
                'key'   => $field['key'],
                'name'  => $field['name'],
                'value' => $field['value'],
                'description' => $field['description']
            ]);
        }
    }
}
