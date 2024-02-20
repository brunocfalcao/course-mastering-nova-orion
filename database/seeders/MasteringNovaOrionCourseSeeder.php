<?php

namespace MasteringNovaOrion\Database\Seeders;

use Eduka\Cube\Models\Chapter;
use Eduka\Cube\Models\Course;
use Eduka\Cube\Models\Order;
use Eduka\Cube\Models\Organization;
use Eduka\Cube\Models\Subscriber;
use Eduka\Cube\Models\User;
use Eduka\Cube\Models\Variant;
use Eduka\Cube\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MasteringNovaOrionCourseSeeder extends Seeder
{
    public function run()
    {
        if (! Organization::exists()) {
            $organization = Organization::create([
                'name' => 'brunofalcao.dev',
                'domain' => env('EDUKA_BACKEND_URL'),
                'provider_namespace' => '\Eduka\Dev\DevServiceProvider',
            ]);
        } else {
            $organization = Organization::find(1);
        }

        $course = Course::create([
            'name' => 'Mastering Nova - Orion ('.env('MN_OR_DOMAIN').')',
            'canonical' => 'course-mastering-nova-orion',
            'domain' => env('MN_OR_DOMAIN'),
            'provider_namespace' => 'MasteringNovaOrion\\MasteringNovaOrionServiceProvider',
            'organization_id' => $organization->id,

            'lemon_squeezy_store_id' => env('LEMON_SQUEEZY_STORE_ID'),
            'lemon_squeezy_api_key' => env('LEMON_SQUEEZY_API_KEY'),
            'lemon_squeezy_hash_key' => env('LEMON_SQUEEZY_HASH_KEY'),

            'prelaunched_at' => now()->subDays(30),
            'launched_at' => now()->subDays(15),

            'meta' => [
                'description' => 'my seo description',
                'author' => 'my seo author',
                'twitter:site' => 'my seo twitter',
            ],
        ]);

        $course->update([
            'filename' => Storage::disk('public')
                ->putFile(__DIR__.
                          '/../assets/social-card.jpg')]);

        $variant = Variant::create([
            'name' => 'Full course',
            'description' => 'Full course from the past',
            'course_id' => $course->id,
            'lemon_squeezy_variant_id' => env('MN_OR_VARIANT_ID'),
            'lemon_squeezy_price_override' => env('MN_OR_PRICE_OVERRIDE'),
        ]);

        // Migrated.
        $oldChapters = DB::connection('mysql-orion')->table('chapters');

        // Migrated.
        $oldGiveawayEmails = DB::connection('mysql-orion')->table('giveaway');

        // Migrated.
        $oldPaddleLog = DB::connection('mysql-orion')->table('paddle_log');

        // Migrated.
        $oldSubscribers = DB::connection('mysql-orion')->table('subscribers');

        //Migrated.
        $oldUsers = DB::connection('mysql-orion')->table('users');

        // Migrated.
        $oldVideos = DB::connection('mysql-orion')->table('videos');

        // Migrated.
        $oldVideosCompleted = DB::connection('mysql-orion')->table('videos_completed');

        /**
         * Add the users and then we can continue to connect to the remaining
         * video properties.
         */
        foreach (clone $oldUsers->get() as $user) {
            User::withoutEvents(function () use ($user) {
                User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => $user->password,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'deleted_at' => $user->deleted_at,
                ]);
            });
        }

        // Additionally add giveaway emails as subscribers, without sending emails.
        foreach (clone $oldGiveawayEmails->get() as $participant) {
            Subscriber::withoutEvents(function () use ($participant, $course) {
                Subscriber::create([
                    'email' => $participant->email,
                    'course_id' => $course->id,
                ]);
            });
        }

        // Add subscribers without calling events (no nobody receives emails).
        foreach (clone $oldSubscribers->get() as $subscriber) {
            Subscriber::withoutEvents(function () use ($subscriber, $course) {
                Subscriber::create([
                    'email' => $subscriber->email,
                    'course_id' => $course->id,
                ]);
            });
        }

        // Create admin user.
        $admin = User::create([
            'name' => 'Bruno Falcao (OR)',
            'email' => env('MN_OR_EMAIL'),
            'password' => bcrypt('password'),
            'course_id_as_admin' => $course->id,
        ]);

        // Image mappings (key=id)
        $oldChapterFilenames = [
            1 => 'the-fundamentals-social-card.jpg',
            2 => 'deep-dive-on-resources-social-card.jpg',
            3 => 'deep-dive-on-ui-components-social-card.jpg',
            4 => 'best-community-packages-social-card.jpg',
        ];

        $oldVideoFilenames = [
            1 => 'installing-nova.jpg',
            2 => 'first-glance-at-the-file-structure.jpg',
            3 => 'what-is-a-resource.jpg',
            4 => 'creating-your-first-resource.jpg',
            5 => 'first-glance-to-the-resource-fields.jpg',
            6 => 'the-beauty-of-filters.jpg',
            7 => 'getting-deeper-on-data-viewing-using-lenses.jpg',
            8 => 'executing-actions-on-your-resources.jpg',
            9 => 'visualizing-data-using-metrics.jpg',
            10 => 'first-glance-at-resource-relationships.jpg',
            11 => 'using-customized-accessors-on-global-search.jpg',
            12 => 'recompiling-nova-assets.jpg',
            13 => 'data-sync-between-server-and-client-ui-components.jpg',
            14 => 'creating-your-first-ui-component-enhanced-field.jpg',
            15 => 'sorting-your-resources-in-the-sidebar.jpg',
            16 => 'the-power-of-abstract-resources.jpg',
            17 => 'loading-resources-from-custom-locations.jpg',
            18 => 'filter-to-select-columns.jpg',
            19 => 'the-full-power-of-resource-policies.jpg',
            20 => 'single-package-creation-for-all-of-your-ui-components.jpg',
            21 => 'customizing-your-resource-visibility.jpg',
            22 => 'how-to-correctly-use-the-index-query.jpg',
            23 => 'using-resource-data-scopes.jpg',
            24 => 'cloning-resources-for-a-better-resource-strategy.jpg',
            25 => 'polymorphic-relationships.jpg',
            26 => 'many-to-many-relationship-with-additional-pivot-columns.jpg',
            27 => 'changing-stub-files.jpg',
            28 => 'configuring-field-groups-for-each-display-context.jpg',
            29 => 'resource-1-o-1-checklist-guidelines.jpg',
            30 => 'what-is-an-ui-component.jpg',
            31 => 'data-flow-between-client-server-client.jpg',
            32 => 'ui-component-properties-you-can-use.jpg',
            33 => 'reusing-nova-ui-components.jpg',
            34 => 'using-emit-events.jpg',
            35 => 'practical-example-2-dropdowns.jpg',
            36 => 'creating-the-composer-package.jpg',
            37 => 'managing-ticket-permissions-and-authorizations.jpg',
            38 => 'creating-a-quick-my-tickets-filter.jpg',
            39 => 'creating-the-assign-to-myself-action.jpg',
            40 => 'creating-the-assign-to-operator-action.jpg',
            41 => 'optimizing-the-assign-to-myself-action.jpg',
            42 => 'creating-another-action-to-unassign-tickets.jpg',
            43 => 'creating-total-ticket-card.jpg',
            44 => 'resource-testing-1-o-1.jpg',
            45 => 'integrating-socialite-for-oauth-authentication.jpg',
            46 => 'search-relations.jpg',
            47 => 'button-field.jpg',
            48 => 'ajax-child-select.jpg',
            49 => 'nova-package-chart-js.jpg',
            50 => 'responsive-package.jpg',
            51 => 'spatie-multitenancy.jpg',
        ];

        foreach (clone $oldChapters->get() as $oldChapter) {
            $newChapter = Chapter::create([
                'course_id' => $course->id,
                'name' => $oldChapter->title,
            ]);

            // Clone the query builder before fetching the videos.
            $videosQueryBuilder = clone $oldVideos;

            $videos = $videosQueryBuilder->where('chapter_id', $oldChapter->id)->get();

            // Add image for SEO.
            if (env('MN_OR_IMPORT_ASSETS') === true) {
                if (array_key_exists($oldChapter->id, $oldChapterFilenames)) {
                    $newChapter->update([
                        'filename' => Storage::disk('public')
                            ->putFile(__DIR__.
                                      '/../assets/'.
                                      $oldChapterFilenames[$oldChapter->id])]);
                }
            }

            foreach ($videos as $oldVideo) {
                $newVideo = Video::create([
                    'old_id' => $oldVideo->id,
                    'name' => $oldVideo->title,
                    'description' => $oldVideo->details,
                    'chapter_id' => $newChapter->id,
                    'course_id' => $course->id,
                    'duration' => $oldVideo->duration,
                ]);

                // Attach video image for SEO.
                if (env('MN_OR_IMPORT_ASSETS') === true) {
                    if (array_key_exists($oldVideo->id, $oldVideoFilenames)) {
                        $newVideo->update([
                            'filename' => Storage::disk('public')
                                ->putFile(__DIR__.
                                          '/../assets/'.
                                          $oldVideoFilenames[$oldVideo->id])]);
                    }
                }
            }

            $completedList = clone $oldVideosCompleted;

            foreach (clone $completedList->get() as $videoCompleted) {
                $user = User::firstWhere('id', $videoCompleted->user_id);
                $video = Video::firstWhere('old_id', $videoCompleted->video_id);

                if ($video && $user) {
                    $video->usersThatSaw()->attach(
                        $user,
                        ['created_at' => $videoCompleted->created_at]
                    );
                }
            }
        }
        // End of $oldChapters loop.

        // Time to sync the orders vs paddle_log
        foreach (clone $oldPaddleLog->get() as $paddleLog) {
            Order::withoutEvents(function () use ($paddleLog, $variant) {

                $user = User::firstWhere('email', $paddleLog->email);

                if ($user) {
                    Order::create([
                        'provider' => 'paddle',
                        'variant_id' => $variant->id,
                        'course_id' => $variant->course->id,
                        'store_id' => $variant->course->lemon_squeezy_store_id,
                        'user_id' => $user->id,
                        'country' => $paddleLog->country,
                        'response_body' => (array) $paddleLog,
                        'custom_data' => $paddleLog->passthrough,
                        'event_name' => $paddleLog->alert_name,
                        'user_name' => $paddleLog->customer_name,
                        'user_email' => $paddleLog->email,
                        'total_usd' => $paddleLog->sale_gross,
                        'price' => $paddleLog->sale_gross,
                        'order_id' => $paddleLog->order_id,
                        'refunded' => false,
                        'receipt' => $paddleLog->receipt_url,
                        'created_at' => $paddleLog->created_at,
                        'updated_at' => $paddleLog->created_at,
                    ]);
                }
            });
        }
    }
}
