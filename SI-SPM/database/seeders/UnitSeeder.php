<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run()
    {
        $unit = [
            'Sub bagian Tata Usaha',
            'Perencanaan dan Evaluasi DAS',
            'RHL',
            'Penguatan Kelembagaan DAS'
        ];

        foreach ($unit as $unit) {
            Unit::create(['nama_unit' => $unit]);
        }
    }
}
