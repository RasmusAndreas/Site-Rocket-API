<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Website;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // create users
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10) . '@siterocket.com',
            'password' => bcrypt('secret'),
            'apikey' => str_random(35) . time(),
        ]);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10) . '@siterocket.com',
            'password' => bcrypt('secret'),
            'apikey' => str_random(35) . time(),
        ]);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10) . '@siterocket.com',
            'password' => bcrypt('secret'),
            'apikey' => str_random(35) . time(),
        ]);

        // create websites
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'none',
            'reportLink' => 'none',
            'user_id' => 1,
        ]);
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'none',
            'reportLink' => 'none',
            'user_id' => 1,
        ]);
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'none',
            'reportLink' => 'none',
            'user_id' => 2,
        ]);
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'none',
            'reportLink' => 'none',
            'user_id' => 2,
        ]);
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'none',
            'reportLink' => 'none',
            'user_id' => 2,
        ]);
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'none',
            'reportLink' => 'none',
            'user_id' => 3,
        ]);
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'none',
            'reportLink' => 'none',
            'user_id' => 3,
        ]);
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'none',
            'reportLink' => 'none',
            'user_id' => 3,
        ]);
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'none',
            'reportLink' => 'none',
            'user_id' => 3,
        ]);

        // create uptimes
        DB::table('uptimes')->insert([
            'excludeDowntime' => false,
            'statusCode' => 500,
            'websiteID' => 1,
        ]);
        DB::table('uptimes')->insert([
            'excludeDowntime' => false,
            'statusCode' => 500,
            'websiteID' => 2,
        ]);
        DB::table('uptimes')->insert([
            'excludeDowntime' => false,
            'statusCode' => 500,
            'websiteID' => 3,
        ]);
        DB::table('uptimes')->insert([
            'excludeDowntime' => false,
            'statusCode' => 500,
            'websiteID' => 4,
        ]);
        DB::table('uptimes')->insert([
            'excludeDowntime' => false,
            'statusCode' => 500,
            'websiteID' => 5,
        ]);
        DB::table('uptimes')->insert([
            'excludeDowntime' => false,
            'statusCode' => 500,
            'websiteID' => 6,
        ]);
        DB::table('uptimes')->insert([
            'excludeDowntime' => false,
            'statusCode' => 500,
            'websiteID' => 7,
        ]);
        DB::table('uptimes')->insert([
            'excludeDowntime' => false,
            'statusCode' => 500,
            'websiteID' => 8,
        ]);
        DB::table('uptimes')->insert([
            'excludeDowntime' => false,
            'statusCode' => 500,
            'websiteID' => 9,
        ]);

        // create urls
        DB::table('urls')->insert([
            'url' => '/testurl',
            'excludeLoadtimes' => false,
            'htmlToText' => 10.51,
            'wordCount' => 120,
            'metaDescription' => 128,
            'altText' => 2,
            'title' => 45,
            'h1' => 1,
            'h2' => 2,
            'h3' => 3,
            'h4' => 4,
            'h5' => 5,
            'h6' => 6,
            'websiteID' => 1,
        ]);
        DB::table('urls')->insert([
            'url' => '/testurl',
            'excludeLoadtimes' => false,
            'htmlToText' => 10.51,
            'wordCount' => 120,
            'metaDescription' => 128,
            'altText' => 2,
            'title' => 45,
            'h1' => 1,
            'h2' => 2,
            'h3' => 3,
            'h4' => 4,
            'h5' => 5,
            'h6' => 6,
            'websiteID' => 2,
        ]);
        DB::table('urls')->insert([
            'url' => '/testurl',
            'excludeLoadtimes' => false,
            'htmlToText' => 10.51,
            'wordCount' => 120,
            'metaDescription' => 128,
            'altText' => 2,
            'title' => 45,
            'h1' => 1,
            'h2' => 2,
            'h3' => 3,
            'h4' => 4,
            'h5' => 5,
            'h6' => 6,
            'websiteID' => 3,
        ]);
        DB::table('urls')->insert([
            'url' => '/testurl',
            'excludeLoadtimes' => false,
            'htmlToText' => 10.51,
            'wordCount' => 120,
            'metaDescription' => 128,
            'altText' => 2,
            'title' => 45,
            'h1' => 1,
            'h2' => 2,
            'h3' => 3,
            'h4' => 4,
            'h5' => 5,
            'h6' => 6,
            'websiteID' => 4,
        ]);
        DB::table('urls')->insert([
            'url' => '/testurl',
            'excludeLoadtimes' => false,
            'htmlToText' => 10.51,
            'wordCount' => 120,
            'metaDescription' => 128,
            'altText' => 2,
            'title' => 45,
            'h1' => 1,
            'h2' => 2,
            'h3' => 3,
            'h4' => 4,
            'h5' => 5,
            'h6' => 6,
            'websiteID' => 5,
        ]);
        DB::table('urls')->insert([
            'url' => '/testurl',
            'excludeLoadtimes' => false,
            'htmlToText' => 10.51,
            'wordCount' => 120,
            'metaDescription' => 128,
            'altText' => 2,
            'title' => 45,
            'h1' => 1,
            'h2' => 2,
            'h3' => 3,
            'h4' => 4,
            'h5' => 5,
            'h6' => 6,
            'websiteID' => 6,
        ]);
        DB::table('urls')->insert([
            'url' => '/testurl',
            'excludeLoadtimes' => false,
            'htmlToText' => 10.51,
            'wordCount' => 120,
            'metaDescription' => 128,
            'altText' => 2,
            'title' => 45,
            'h1' => 1,
            'h2' => 2,
            'h3' => 3,
            'h4' => 4,
            'h5' => 5,
            'h6' => 6,
            'websiteID' => 7,
        ]);
        DB::table('urls')->insert([
            'url' => '/testurl',
            'excludeLoadtimes' => false,
            'htmlToText' => 10.51,
            'wordCount' => 120,
            'metaDescription' => 128,
            'altText' => 2,
            'title' => 45,
            'h1' => 1,
            'h2' => 2,
            'h3' => 3,
            'h4' => 4,
            'h5' => 5,
            'h6' => 6,
            'websiteID' => 8,
        ]);
        DB::table('urls')->insert([
            'url' => '/testurl',
            'excludeLoadtimes' => false,
            'htmlToText' => 10.51,
            'wordCount' => 120,
            'metaDescription' => 128,
            'altText' => 2,
            'title' => 45,
            'h1' => 1,
            'h2' => 2,
            'h3' => 3,
            'h4' => 4,
            'h5' => 5,
            'h6' => 6,
            'websiteID' => 9,
        ]);

        // create loadtimes
        DB::table('loadtimes')->insert([
            'loadtime' => 4500,
            'urlID' => 1,
        ]);
        DB::table('loadtimes')->insert([
            'loadtime' => 4500,
            'urlID' => 2,
        ]);
        DB::table('loadtimes')->insert([
            'loadtime' => 4500,
            'urlID' => 3,
        ]);
        DB::table('loadtimes')->insert([
            'loadtime' => 4500,
            'urlID' => 4,
        ]);
        DB::table('loadtimes')->insert([
            'loadtime' => 4500,
            'urlID' => 5,
        ]);
        DB::table('loadtimes')->insert([
            'loadtime' => 4500,
            'urlID' => 6,
        ]);
        DB::table('loadtimes')->insert([
            'loadtime' => 4500,
            'urlID' => 7,
        ]);
        DB::table('loadtimes')->insert([
            'loadtime' => 4500,
            'urlID' => 8,
        ]);
        DB::table('loadtimes')->insert([
            'loadtime' => 4500,
            'urlID' => 9,
        ]);
    }
}
