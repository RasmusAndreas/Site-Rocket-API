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
            'email' => 'rasmus.andreas96@gmail.com',
            'password' => bcrypt('secret'),
            'apikey' => str_random(35) . time(),
        ]);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'post@jdanet.dk',
            'password' => bcrypt('secret'),
            'apikey' => str_random(35) . time(),
        ]);
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'r@rasmusandreas.dk',
            'password' => bcrypt('secret'),
            'apikey' => str_random(35) . time(),
        ]);

        // create websites
        DB::table('websites')->insert([
            'websiteName' => str_random(10),
            'domain' => 'https://' . str_random(10) . '.com',
            'featureSettings' => 'uptime:0;seo:0;loadtime:0',
            'reportLink' => 'none',
            'user_id' => 1,
        ]);
        DB::table('websites')->insert([
            'websiteName' => 'Randiplatz',
            'domain' => 'http://randiplatz.dk',
            'featureSettings' => 'uptime:1;seo:0;loadtime:0',
            'reportLink' => 'none',
            'user_id' => 1,
        ]);
        DB::table('websites')->insert([
            'websiteName' => 'Rasmusandreas.dk',
            'domain' => 'http://www.rasmusandreas.dk',
            'featureSettings' => 'uptime:1;seo:1;loadtime:1',
            'reportLink' => 'none',
            'user_id' => 2,
        ]);
        DB::table('websites')->insert([
            'websiteName' => 'JDAnet',
            'domain' => 'http://jdanet.dk',
            'featureSettings' => 'uptime:0;seo:1;loadtime:0',
            'reportLink' => 'none',
            'user_id' => 2,
        ]);
        DB::table('websites')->insert([
            'websiteName' => 'Rytmisk Musik Vejen',
            'domain' => 'http://www.Rytmiskmusikvejen.dk',
            'featureSettings' => 'uptime:0;seo:1;loadtime:1',
            'reportLink' => 'none',
            'user_id' => 2,
        ]);
        DB::table('websites')->insert([
            'websiteName' => 'Brørup Medie Net',
            'domain' => 'http://bafnet.dk',
            'featureSettings' => 'uptime:1;seo:0;loadtime:0',
            'reportLink' => 'none',
            'user_id' => 3,
        ]);
        DB::table('websites')->insert([
            'websiteName' => 'Snippets JDAnet',
            'domain' => 'http://snippets.jdanet.dk',
            'featureSettings' => 'uptime:1;seo:0;loadtime:0',
            'reportLink' => 'none',
            'user_id' => 3,
        ]);
        DB::table('websites')->insert([
            'websiteName' => 'DWP',
            'domain' => 'http://http://cms.rasmusandreas.dk',
            'featureSettings' => 'uptime:0;seo:0;loadtime:1',
            'reportLink' => 'none',
            'user_id' => 3,
        ]);
        DB::table('websites')->insert([
            'websiteName' => 'Alvabio',
            'domain' => 'http://alvabio.rasmusandreas.dk/',
            'featureSettings' => 'uptime:0;seo:1;loadtime:0',
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
