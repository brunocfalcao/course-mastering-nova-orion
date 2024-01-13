<?php

namespace MasteringNovaOrion\Database\Seeders;

use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Domain;
use Eduka\Cube\Models\User;
use Eduka\Cube\Models\Variant;
use Illuminate\Database\Seeder;

class MasteringNovaOrionCourseSeeder extends Seeder
{
    public function run()
    {
        return;

        $course = Course::create([
            'name' => 'Mastering Nova - Orion',
            'canonical' => 'course-mastering-nova-orion',
            'domain' => env('MN_OR_DOMAIN'),
            'provider_namespace' => 'MasteringNovaOrion\\MasteringNovaOrionServiceProvider',
            'lemon_squeezy_store_id' => env('LEMON_SQUEEZY_STORE_ID'),
            'prelaunched_at' => now()->subHours(1),
            'launched_at' => now()->addDay(365),
            'meta' => [
                'description' => 'my seo description',
                'author' => 'my seo author',
                'twitter:site' => 'my seo twitter',
            ],
        ]);

        return;

        $variant = Variant::create([
            'canonical' => 'mastering-nova-orion',
            'description' => 'Mastering Nova - Orion version',
            'course_id' => $course->id,
            'lemon_squeezy_variant_id' => env('MN_OR_VARIANT_ID'),
        ]);

        $domain = Domain::create([
            'name' => env('MN_OR_DOMAIN'),
            'course_id' => $course->id,
        ]);

        // Create admin user.
        $admin = User::create([
            'name' => 'Bruno Falcao (OR)',
            'email' => env('MN_OR_EMAIL'),
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $admin->variants()->attach($variant->id);

        $admin->courses()->attach($course->id);
    }
}
