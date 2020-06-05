<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/25/2017
 * Time: 2:29 PM
 */

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->insert([
			[
				'email' => 'admin@sendatviet.com.vn',
				'password' => bcrypt('123456'),
				'fullname' => 'Administrator',
			],

			[
				'email' => 'mod@sendatviet.com.vn',
				'password' => bcrypt('123456'),
				'fullname' => 'Moderator',
			],
            [
                'email' => 'karen@gmail.com',
                'password' => bcrypt('123456'),
                'fullname' => 'Karen',
            ],
            [
                'email' => 'vincent@gmail.com',
                'password' => bcrypt('123456'),
                'fullname' => 'Vincent',
            ],
            [
                'email' => 'john@gmail.com',
                'password' => bcrypt('123456'),
                'fullname' => 'John',
            ],
            [
                'email' => 'clackken@gmail.com',
                'password' => bcrypt('123456'),
                'fullname' => 'Clack Ken',
            ],
            [
                'email' => 'marry@gmail.com',
                'password' => bcrypt('123456'),
                'fullname' => 'Marry',
            ],
            [
                'email' => 'autobot@gmail.com',
                'password' => bcrypt('123456'),
                'fullname' => 'Auto bot',
            ],
            [
                'email' => 'jackson@gmail.com',
                'password' => bcrypt('123456'),
                'fullname' => 'Jackson',
            ]
		]);

        DB::table('user_referrals')->insert([
            ['referral_id' => 1,
            'user_id' => 2,
            'email' => '',
            'tries' => 0
            ],
            [
                'referral_id' => 1,
                'user_id' => 3,
                'email' => '',
                'tries' => 0
            ],
            [
                'referral_id' => 2,
                'user_id' => 4,
                'email' => '',
                'tries' => 0
            ],
            [
                'referral_id' => 2,
                'user_id' => 5,
                'email' => '',
                'tries' => 0
            ],
            [
                'referral_id' => 3,
                'user_id' => 6,
                'email' => '',
                'tries' => 0
            ],
            [
                'referral_id' => 3,
                'user_id' => 7,
                'email' => '',
                'tries' => 0
            ],
            [
                'referral_id' => 4,
                'user_id' => 8,
                'email' => '',
                'tries' => 0
            ],
            [
                'referral_id' => 4,
                'user_id' => 9,
                'email' => '',
                'tries' => 0
            ],
            [
                'referral_id' => 5,
                'user_id' => 10,
                'email' => '',
                'tries' => 0
            ]

        ]);

	}
}