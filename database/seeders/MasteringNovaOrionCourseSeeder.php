<?php

namespace MasteringNovaOrion\Database\Seeders;

use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\User;
use Eduka\Cube\Models\Variant;
use Eduka\Cube\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasteringNovaOrionCourseSeeder extends Seeder
{
    public function run()
    {
        $course = Course::create([
            'name' => 'Mastering Nova - Orion',
            'canonical' => 'course-mastering-nova-orion',
            'domain' => env('MN_OR_DOMAIN'),
            'provider_namespace' => 'MasteringNovaOrion\\MasteringNovaOrionServiceProvider',
            'lemon_squeezy_store_id' => env('LEMON_SQUEEZY_STORE_ID'),
            'prelaunched_at' => now()->subDays(30),
            'launched_at' => now()->subDays(15),
            'meta' => [
                'description' => 'my seo description',
                'author' => 'my seo author',
                'twitter:site' => 'my seo twitter',
            ],
        ]);

        $variant = Variant::create([
            'name' => 'Full course',
            'description' => 'Full course from the past',
            'course_id' => $course->id,
            'lemon_squeezy_variant_id' => env('MN_OR_VARIANT_ID'),
            'lemon_squeezy_price_override' => env('MN_OR_PRICE_OVERRIDE'),
        ]);

        // Import old data.
        $oldChapters = DB::connection('mysql-orion')->table('chapters');
        $oldGiveawayEmails = DB::connection('mysql-orion')->table('giveaway');
        $oldPaddleLog = DB::connection('mysql-orion')->table('paddle_log');
        $oldSubscribers = DB::connection('mysql-orion')->table('subscribers');
        $oldUsers = DB::connection('mysql-orion')->table('users');
        $oldVideos = DB::connection('mysql-orion')->table('videos');
        $oldVideosCompleted = DB::connection('mysql-orion')->table('videos_completed');

        foreach (clone $oldChapters->get() as $oldChapter) {
            $newChapter = Chapter::create([
                'course_id' => $course->id,
                'name' => $oldChapter->title,
            ]);

            // Clone the query builder before fetching the videos.
            $videosQueryBuilder = clone $oldVideos;

            $videos = $videosQueryBuilder->where('chapter_id', $oldChapter->id)->get();

            foreach ($videos as $oldVideo) {
                $newVideo = Video::create([
                    'name' => $oldVideo->title,
                    'description' => $oldVideo->details,
                    'chapter_id' => $newChapter->id,
                    'course_id' => $course->id,
                    'duration' => $oldVideo->duration,
                ]);
            }

            // Attach the video image to the video itself.
        }

        /**
         * Add the users and then we can continue to connect to the remaining
         * video properties.
         */
        foreach (clone $oldUsers->get() as $user) {
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'deleted_at' => $user->deleted_at,
            ]);
        }

        // Create admin user.
        $admin = User::create([
            'name' => 'Bruno Falcao (OR)',
            'email' => env('MN_OR_EMAIL'),
            'password' => bcrypt('password'),
            'course_id_as_admin' => 1,
        ]);

        return;

        $variant = Variant::create([
            'canonical' => 'mastering-nova-orion',
            'description' => 'Mastering Nova - Orion version',
            'course_id' => $course->id,
            'lemon_squeezy_variant_id' => env('MN_OR_VARIANT_ID'),
        ]);
    }
}
