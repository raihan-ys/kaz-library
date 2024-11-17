<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
			Member::create([
				'full_name' => 'John Cena',
				'type_id' => '1',
				'address' => 'Jl. Purnama Sari',
				'phone' => '+62-819-9057-6161',
				'email' => 'johncena@wwe.com',
			]);
      Member::create([
				'full_name' => 'Optimus Prime',
				'type_id' => '2',
				'address' => 'Jl. Wono Sari',
				'phone' => '+62-812-7638-356',
				'email' => 'oprime@iacon.com',
			]);
			Member::create([
				'full_name' => 'Megatron',
				'type_id' => '3',
				'address' => 'Jl. Taman Sari',
				'phone' => '+62-819-2255-4411',
				'email' => 'megs@iacon.com',
			]);
    }
}
