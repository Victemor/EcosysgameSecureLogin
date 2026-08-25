<?php

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SpeciesSeeder extends Seeder
{
    public function run(): void
    {
        $records = json_decode(
            File::get(database_path('data/species.json')),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        foreach ($records as $record) {
            $order = $record['source_order'];
            unset($record['source_order']);

            Species::updateOrCreate(
                ['slug' => Str::slug($record['common_name']).'-'.$order],
                $record,
            );
        }
    }
}
