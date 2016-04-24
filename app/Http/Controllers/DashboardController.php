<?php

namespace App\Http\Controllers;

use App\Listing;
use App\User;
use App\SiteSettings;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    ///////////////////////////////////////////////////////////
    //
    // User Dashboard Routes. Any user of the System can see these.
    //
    /////////////////////////////////////////////



    //The main page of the dashboard
    public function getDashboard()
    {
     if (\Auth::check()) //Check to see if the user is logged in.
    {
        $schedule_current_week = \App\Documents::orderBy('id', 'desc')
                                                ->where('document_tags','Current Week')
                                                ->first();
        $schedule_next_week = \App\Documents::orderBy('id', 'desc')
                                                ->where('document_tags','Next Week')
                                                ->first();
        $phone_list = \App\Documents::orderBy('id', 'desc')
                                                ->where('document_tags','Phone List')
                                                ->first();
        $emergencies = \App\Documents::orderBy('id', 'desc')
                                                ->where('document_tags','Emergencies')
                                                ->first();
        $pay_dates = \App\Documents::orderBy('id', 'desc')
                                                ->where('document_tags','Pay Dates')
                                                ->first();                                        
        $document_category = 'schedule';
        $user = \Auth::user();
        $uid = \Auth::user()->id;
        $search = '';
        $posts = \App\Posts::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.home', compact('user', 'posts', 'search', 'document_category', 
                                                'schedule_current_week', 'schedule_next_week', 'phone_list',
                                                'emergencies', 'pay_dates'));
    }
    else
    {
        return view('errors.autherror');
    }
    }

    public function get5MinuteTopics()
    {
        if (\Auth::check())
        {
            $user = \Auth::user();
            $uid = \Auth::user()->id;
            $search = '';
            $topics = \App\FiveMinuteTopic::paginate(12);
            return view('dashboard.5mintopics.all', compact('user', 'topics', 'search'));
        }
        else
        {
            return view('errors.autherror');
        }
    }

    //The Page for the currently logged in user's profile
    public function getProfile()
    {
        if (\Auth::check()) //Check to see if the user is logged in.
    {
        $user = \Auth::user();
        return view('dashboard.profile', compact('user'));
    }
    else
    {
        return view('errors.autherror');
    }
    }

  


    ///////////////////////////////////////////////////////////
    //
    // Admin Dashboard Routes. Only Admins of the System can see these.
    //
    /////////////////////////////////////////////

    //Page to change or update the site settings
    public function getSiteSettings()
    {
        if (\Auth::check())
        {
            $validator;
            $user = \Auth::user();
             $sitesettings = SiteSettings::find(1);
            return view('dashboard.sitesettings' ,compact('sitesettings', 'user', 'validator'));
        }
        else
        {
            return view('errors.autherror');
        }
    }

    //Users page. Admins may add or update user profiles and passwords
    public function getUsers()
    {
        if (\Auth::check())
    {
        $search = '';
        $user = \Auth::user();
         $sitesettings = SiteSettings::find(1);
         $userlist = User::paginate(10);
        return view('dashboard.users' ,compact('sitesettings', 'userlist', 'user', 'search'));
    }
    else
    {
        return view('errors.autherror');
    }
    }

    
}
