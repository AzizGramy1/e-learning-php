<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unity;

class UnitySeeder extends Seeder
{
 /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unity::create([
            'title'     => 'Introduction à Laravel',
            'type'      => 'pdf',
            'content'   => 'storage/unities/intro_laravel.pdf',
            'module_id' => 1,
        ]);

        Unity::create([
            'title'     => 'Composants Angular',
            'type'      => 'video',
            'content'   => 'https://www.youtube.com/watch?v=angular_tutorial',
            'module_id' => 1,
        ]);

        Unity::create([
            'title'     => 'Base de données avec Eloquent',
            'type'      => 'code',
            'content'   => '<?php echo "Hello Database!"; ?>',
            'module_id' => 1,
        ]);

        Unity::create([
            'title'     => 'Services Angular',
            'type'      => 'image',
            'content'   => 'storage/unities/angular_services.png',
            'module_id' => 1,
        ]);
    }
}
