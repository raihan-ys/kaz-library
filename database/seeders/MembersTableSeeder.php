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
				'full_name' => 'John Doe',
				'type_id' => '1',
				'address' => 'Jl. Purnama Sari, Cluster Taman Sari, Kec. Tangkerang Selatan',
				'phone' => '+62-819-9057-6161',
				'email' => 'johndoe@gmail.com',
			]);
      Member::create([
				'full_name' => 'Jane Sue',
				'type_id' => '2',
				'address' => 'Jl. Delima, Kec. Tangkerang Utara',
				'phone' => '+62-812-7638-356',
				'email' => 'janesue@gmail.com',
			]);
			Member::create([
				'full_name' => 'Arnold Arn',
				'type_id' => '3',
				'address' => 'Jl. Melur, Kec. Sukajadi',
				'phone' => '+62-819-2255-4411',
				'email' => 'arnoldarn	@gmail.com',
			]);
    }
}
