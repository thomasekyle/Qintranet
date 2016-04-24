<?php

namespace App\Http\Controllers;

use App\User;
use App\Listing;
use App\SiteSettings;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
	////////////////////////////////////////////////////////////////
	//
	//	Site Settings (Contains the methods to return various site
	//	settings and such)
	//
	//////////////////////////////////////////////////////////

	//Returns the setting for the particular website.
	public function siteIndex()
	{
		$sitesettings = SiteSettings::all();
	}

	public function getSiteSettings()
	{
		$sitesettings = SiteSettings::find(1);

	}


    ////////////////////////////////////////////////////////////////
    //
    //	Realtors (If this section grows larger it will be moved to
    //	a different controller in the future)
    //
    /////////////////////////////////////////////////////////


	//Returns all realtors(users) and site settings
    public function realtorIndex() 
    {
        $users = User::paginate(6);
        $sitesettings = SiteSettings::find(1);
        return view('pages.realtors', compact('users', 'sitesettings'));
    }

    //Returns the user with the specified id.
    public function showUsers($id)
    {
        $user = User::find($id);
        return view('pages.realtors')->withUser($user);
    }

    /////////////////////////////////////////////////////////////////
    //
    //	Listings (If this section grows to larger it will be moved to
    //	a different controller in the future)
    //
    ///////////////////////////////////////////////////////

    //Returns all listings and site settings.
    public function listingIndex() 
    {
    	$listings = Listing::paginate(8);
    	$sitesettings = SiteSettings::find(1);
  		return view('pages.listings', compact('listings', 'sitesettings'));
    }

    //Returns a single listing from it's id
    public function showListing($id)
    {
    	$listing = Listing::find($id);
        $listingpics = \App\ListingPic::where('listing_id', $id)->get();
        $fpic = \App\ListingPic::find($listing->featured_pic);
        $rlistings = \App\Listing::all()->random(3);
    	$sitesettings = SiteSettings::find(1);
    	return view('listings.view', compact('listing', 'sitesettings', 'listingpics', 'fpic', 'rlistings'));
    }
}
