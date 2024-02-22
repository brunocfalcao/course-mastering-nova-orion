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
use Illuminate\Support\Str;

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

            'meta_names' => [
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

            $descriptions = [

                1 => 'Learn to install Laravel Nova with local repositories or Composer, and optimize with symlinks',
                2 => 'Explore changes after Nova installation: resources, nova.php config, source files, and API communication',
                3 => "Understand Nova's default Users Resource: basic properties, modifications, and creating your first custom Resource",
                4 => 'Create a Products table and Resource in Nova: learn default properties, field creation, and initial configuration',
                5 => 'Master Nova Fields: configurations, validations, visibility, and extending with custom logic for enhanced functionality',

                6 => 'Create and apply Filters to multiple Nova Resources to manage active statuses, with dynamic header rendering',
                7 => 'Design custom Lenses in Nova to showcase Top Buyers with sortable computed columns, enhancing data presentation',
                8 => 'Implement Actions in Nova for bulk status updates on selected Users Resources, with row-specific execution options',
                9 => 'Explore Metrics in Nova to visualize data with customizable charts across three types for quick insights',
                10 => 'Dive into Nova Relationships, covering common types and detailing Polymorphic 1-to-Many, saving others for future exploration',

                11 => "Integrate computed attributes into Nova's Global Search by creating custom computed columns for enhanced search results",
                12 => 'Customize and recompile Nova assets for UI consistency, including adjusting TextArea fields for width alignment',
                13 => 'Transfer server data to Vue components in Nova, enabling dynamic UI changes like background color adjustments in Text Fields',
                14 => 'Develop custom UI Components in Nova, such as Fields with server-driven icons, for enriched user interfaces',
                15 => "Utilize Nova's undocumented 'priority' attribute to strategically sort Resources in the Sidebar for improved navigation",

                16 => 'Implement Abstract Resources in Nova to consolidate common features like Actions and Lenses, and enable default sorting beyond the ID field',
                17 => "Discover how to configure Nova to load Resources from custom namespaces outside of the default App\Nova",
                18 => 'Enhance Abstract Resources with dynamic Filters to control column visibility in the index view based on the Resource',
                19 => "Utilize Nova's Resource Policies for granular authorization, tailoring access and actions within specific data scopes",
                20 => 'Simplify Nova extension management by consolidating multiple UI components into a single composer package for streamlined development',

                21 => 'Learn to hide specific Resources from the Nova Sidebar while maintaining their usability in Relationships, with optional display authorization',
                22 => 'Implement dynamic model local scopes in Nova to filter data based on user permissions, avoiding index query filters',
                23 => "Utilize Model scopes in Nova to restrict visible and interactable data to match the current user's access rights",
                24 => 'Explore Resource/Model cloning in Nova to categorize data effectively, using a package for cloning with specific scopes',
                25 => 'Dive into advanced Nova relationships by setting up and utilizing polymorphic relationships (MorphTo) with Resources',

                26 => 'Master complex relationships in Nova with access to pivot table fields and custom pivot models for enriched data associations',
                27 => 'Customize Nova by exporting and modifying default stub files for tailored Resource generation and functionality',
                28 => 'Utilize field behavior customization in Nova 3.1.0 to alter field data presentation across different contexts: index, form, and detail',
                29 => 'Develop a comprehensive Resource checklist in Nova to ensure thorough coverage of actions and validations for Resource creation',
                30 => "Understand the structure of Nova's UI components, including Fields, Cards, Lenses, Filters, Metrics, and Tools, for custom UI integration",

                31 => 'Enhance a Nova Tool to exchange data between the frontend and server, demonstrating data transformation and return to the frontend',
                32 => 'Explore Vue properties provided by Nova to leverage in custom tools and extensions for optimal functionality',
                33 => "Integrate existing Nova Vue Components into your custom Tool to utilize Nova's built-in UI elements and avoid redundancy",
                34 => "Utilize Nova's event broadcasting with \$emit to facilitate communication between frontend UI components for dynamic interactions",
                35 => "Demonstrate \$emit in action with a practical example of interlinked dropdowns, where one dropdown's selection influences another",
                36 => 'Begin developing a ticketing system by setting up the foundational composer package for the Nova Tool',
                37 => "Advance the Tool's development with proper authorization and operator permissions, emphasizing the importance of context in permission handling",
                38 => 'Implement a quick filter for Operators in the ticketing system to sort tickets by assignment status, enhancing usability',
                39 => 'Create an Action for Operators within the ticketing system to self-assign tickets, showcasing user-specific functionality',
                40 => 'Develop a Supervisor-exclusive Action in the ticketing system to assign tickets to selectable Operators, demonstrating role-based capabilities',

                41 => "Optimize the 'Assign to Myself' action to display only for tickets without an assigned Operator, streamlining the ticketing system",
                42 => 'Introduce a new action to requeue tickets, showcasing a unique Nova behavior for managing ticket states effectively',
                43 => "Develop a 'Total Tickets' KPI card from scratch for a custom Nova Dashboard, enhancing data visualization",
                44 => "Test Nova Resources efficiently with Brian Dillingham's package for a quick and insightful initial review",
                45 => 'Enable Index View search functionality in relationship columns in Nova with a specialized package for enhanced usability',
                46 => "Incorporate Brian Dillingham's versatile button field in Nova, allowing for customizable actions within Resources",
                47 => 'Link multiple dropdowns in Nova to dynamically update child dropdowns based on parent selections, improving UI interactivity',
                48 => 'Utilize a Nova package for advanced data visualization on dashboards, elevating the presentation of key metrics',
                49 => "Enhance Nova's UI with a responsiveness package, adapting the admin panel for better mobile and tablet usability",
                50 => "Integrate OAuth authentication in Nova's login workflow with third-party providers like GitHub or Twitter for enhanced security and user experience",

                51 => "Implement Spatie's multitenancy package in Nova to manage database connections dynamically based on tenant subdomains, streamlining multi-tenant applications",
            ];

            foreach ($videos as $oldVideo) {

                /**
<meta name="twitter:site" content="@tailwindcss" inertia>
<meta name="twitter:title" content="Tailwind UI - Official Tailwind CSS Components & Templates" inertia>
<meta name="twitter:description" content="Beautiful UI components and templates by the creators of Tailwind CSS." inertia>
<meta name="twitter:image" content="https://tailwindui.com/img/og-default.png" inertia>
<meta name="twitter:creator" content="@tailwindcss" inertia>
<meta property="og:url" content="https://www.tailwindui.com/" inertia>
<meta property="og:type" content="article" inertia>
<meta property="og:title" content="Tailwind UI - Official Tailwind CSS Components & Templates" inertia>
<meta property="og:description" content="Beautiful UI components and templates by the creators of Tailwind CSS." inertia>
<meta property="og:image" content="https://tailwindui.com/img/og-default.png" inertia>
<meta property="description" content="Beautiful UI components and templates by the creators of Tailwind CSS." inertia>
                 */
                $uuid = (string) Str::uuid();

                $newVideo = Video::create([
                    'old_id' => $oldVideo->id,
                    'name' => $oldVideo->title,
                    'uuid' => $uuid,
                    'description' => $oldVideo->details,
                    'chapter_id' => $newChapter->id,
                    'course_id' => $course->id,
                    'duration' => $oldVideo->duration,
                    'is_visible' => $oldVideo->is_visible,
                    'is_active' => $oldVideo->is_active,
                    'is_free' => $oldVideo->is_free,
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

            // Update the SEO metadata for each video.
            foreach (Video::all() as $video) {
                if ($video->old_id) {
                    $video->update([
                        'meta_names' => [
                            'twitter:site' => env('MN_OR_DOMAIN').'/video/'.$video->uuid,
                            'twitter:title' => $video->name,
                            'twitter:description' => $descriptions[$video->old_id],
                            'twitter:image' => env('MN_OR_DOMAIN').'/storage/'.$video->filename,
                            'twitter:creator' => '@'.env('MN_OR_TWITTER'),
                            '',
                        ],
                        'meta_properties' => [
                            'twitter:site' => env('MN_OR_DOMAIN').'/video/'.$video->uuid,
                            'twitter:title' => $video->name,
                            'twitter:description' => $descriptions[$video->old_id],
                            'twitter:image' => env('MN_OR_DOMAIN').'/storage/'.$video->filename,
                            'twitter:creator' => '@'.env('MN_OR_TWITTER'),
                        ],
                    ]);
                }
            }

            foreach (clone $oldVideosCompleted->get() as $videoCompleted) {
                $user = User::firstWhere('id', $videoCompleted->user_id);
                $video = Video::firstWhere('old_id', $videoCompleted->video_id);

                if ($video && $user) {
                    // Delete other lines
                    DB::table('user_video_seen')->where([
                        'user_id' => $user->id,
                        'video_id' => $video->id,
                    ])->delete();

                    DB::table('user_video_seen')->insert([
                        'user_id' => $user->id,
                        'video_id' => $video->id,
                        'created_at' => $videoCompleted->created_at,
                    ]);
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

                    // Attach user to Orion course.
                    $user->courses()->attach($variant->course);

                    // Attach user to course variant.
                    $user->variants()->attach($variant);
                }
            });
        }
    }
}
