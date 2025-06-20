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
				'full_name' => 'Arnold Arn',
				'type_id' => '1',
				'address' => 'Jl. Melur, Kec. Sukajadi, Pekanbaru, Riau',
				'phone' => '+62-111-1111-1111',
				'email' => 'arndoldarn@gmail.com',
			]);
      Member::create([
				'full_name' => 'Jane Sue',
				'type_id' => '2',
				'address' => 'Jl. Pasir Putih, Kec. Tangkerang Utara, Pekanbaru, Riau',
				'phone' => '+62-222-2222-2222',
				'email' => 'janesue@gmail.com',
			]);
			Member::create([
				'full_name' => 'John Doe',
				'type_id' => '3',
				'address' => 'Jl. Purnama Sari, Cluster Taman Sari, Kec. Tangkerang Selatan, Pekanbaru, Riau',
				'phone' => '+62-333-3333-3333',
				'email' => 'johndoe@gmail.com',
			]);
    }
}
