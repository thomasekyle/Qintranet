<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Listing;
use App\SiteSettings;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}

class UserTableSeeder extends Seeder 
{
    public function run() 
    {
        //Clear the user database
        DB::table('users')->delete();
        DB::table('listings')->delete();
        DB::table('password_resets')->delete();
        DB::table('site_settings')->delete();

        //Create the first user for an Administrator
        $user1 = User::create(array(
            'fname' => 'Web',
            'lname' => 'Admin',
            'birthday'  => '1956-01-10',
            'phone_number' => '704-999-6255',
            'fax_number'   => '704-999-6599',
            'email' => 'webadmin@yourdomain.com',
            'password' => bcrypt('password'),
            'description' => 'This is the account you may use to administrate this web interface.',
            'active' => '1'

            ));
        
        $this->command->info('Users Succesfully created.');
    

        
        // Create the default site settings
        $site_settings = SiteSettings::create(array(
            'id' => '1',
            'users' => '4',
            'post' => '4',
            'company_name' => 'Temp Company Name',
            'company_street_number' => '1234',
            'company_street_name' => 'Coporate Lane',
            'company_city' => 'Charlotte',
            'company_state' => 'North Carolina',
            'company_zip' => '28213',
            'http_link' => 'http://localhost:8000',
            'http_link2' => 'http://localhost',
        )); 
    }
}

