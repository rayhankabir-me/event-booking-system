<?php

namespace Database\Seeders;

use App\Enum\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin One',
                'email' => 'admin@example.com',
                'phone' => '01643163478',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::ADMIN,
            ],
            [
                'name' => 'Admin Two',
                'email' => 'admin2@example.com',
                'phone' => '01643163477',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::ADMIN,
            ],
            [
                'name' => 'Organizer One',
                'email' => 'organizer@example.com',
                'phone' => '01643163479',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::ORGANIZER,
            ],
            [
                'name' => 'Organizer Two',
                'email' => 'organizer2@example.com',
                'phone' => '01643163476',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::ORGANIZER,
            ],
            [
                'name' => 'Organizer Three',
                'email' => 'organizer3@example.com',
                'phone' => '01643163475',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::ORGANIZER,
            ],
            [
                'name' => 'Customer One',
                'email' => 'customer@example.com',
                'phone' => '01643163480',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Customer Two',
                'email' => 'customer2@example.com',
                'phone' => '01643163481',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Customer Three',
                'email' => 'customer3@example.com',
                'phone' => '01643163482',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Customer Four',
                'email' => 'customer4@example.com',
                'phone' => '01643163483',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Customer Five',
                'email' => 'customer5@example.com',
                'phone' => '01643163484',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Customer Six',
                'email' => 'customer6@example.com',
                'phone' => '01643163485',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Customer Seven',
                'email' => 'customer7@example.com',
                'phone' => '01643163486',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Customer Eight',
                'email' => 'customer8@example.com',
                'phone' => '01643163487',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Customer Nine',
                'email' => 'customer9@example.com',
                'phone' => '01643163488',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Customer Ten',
                'email' => 'customer10@example.com',
                'phone' => '01643163489',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '01643163481',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '01643163482',
                'password' => bcrypt('123456'),
                'role' => UserRoleEnum::CUSTOMER,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
