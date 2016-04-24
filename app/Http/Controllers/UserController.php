<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (\Auth::check()) //Check to see if the user is logged in.
        {
            $user = \Auth::user();
            return view('dashboard.users.create', compact('user'));
        }
        else
        {
            return view('errors.autherror');
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::check()) //Check to see if the user is logged in.
        {
            $errors = false;
            $data = $request;
            //Input Rules for processing the HTML Form data
            $rules = [
                'email'         => 'required|email|unique:users',
                'password'      => 'required|confirmed|min:8',
                'fname'         => 'required|alpha',
                'lname'         => 'required|alpha',
                'privilege'     => 'required',
                'birthday'      => 'date',
                'phone_number'  => 'digits_between:10,11',
                'fax_number'    => 'digits_between:10,11',
                'active'        => 'required',
                'description'   => 'max:255'
            ];

            //Validate the input for all of the fields.
                $this->validate($data, $rules);

            //If there are no error skip, returning them
            //If errors are found return the infomation as well as the information
            //filled out to the previous form.
                if ($errors != false) {
                    if ($errors->fails())
                    {
                        return redirect()->back()->withInput()->withErrors($errors);
                    }
                }

            \App\User::create([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'password'      => bcrypt($request['password']),
                'fname'         => $request['fname'],
                'lname'         => $request['lname'],
                'priviledge'    => $request['privilege'],
                'birthday'      => $request['birthday'],
                'phone_number'  => $request['phone_number'],
                'fax_number'    => $request['fax_number'],
                'description'   => $request['description'],
                'pics_id'       => bcrypt($request['email']),
                'active'        => $request['active'],
            ]);
            return redirect()->action('DashboardController@getUsers');
        }
        else
        {
            return view('errors.autherror');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::check()) //Check to see if the user is logged in.
        {
            $user = \Auth::user();
            $edituser = \App\User::find($id);
            return view('dashboard.users.edit', compact('user', 'edituser'));
        }
        else
        {
            return view('errors.autherror');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

          if (\Auth::check())
        {
            $errors = false;
            $data = $request;
        
            //Input Rules for processing the HTML Form data
            $rules = [
            'email'         => 'required|email',
            //'password'      => 'required|min:8|'
            //'new_password'  => 'required|confirmed|min:8'
            'fname'         => 'required|alpha',
            'lname'         => 'required|alpha',
            'birthday'      => 'date',
            'phone_number'  => 'digits_between:10,11',
            'fax_number'    => 'digits_between:10,11',
            'active'        => 'required',
            'description'   => 'max:255',
            'file'          => 'mimes:png,jpg,jpeg|max:1'
            ];

            //Validate the input for all of the fields.
            $this->validate($data, $rules);

            //If there are no error skip, returning them
            //If errors are found return the infomation as well as the information
            //filled out to the previous form.
            if ($errors != false) {
                if ($errors->fails())
                {
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            }


            //Profile Picture Upload logic
            if ($request->file != null)
            {
                $file = $request->file('file');
                $filetype = $request->file('file')->getClientOriginalExtension();
                $newfilename = 'profile_pic.' . $filetype;
                $edituser->pic_id = $newfilename;
                $file->move(public_path().'/uploads/user/'. $edituser->id .'/' , $newfilename);  
            }
            

            $edituser = \App\User::find($id);
            $edituser->email = $request['email'];
            $edituser->fname= $request['fname'];
            $edituser->lname = $request['lname'];
            $edituser->birthday = $request['birthday'];
            $edituser->phone_number = $request['phone_number'];
            $edituser->fax_number = $request['fax_number'];
            $edituser->description = $request['description'];
            $edituser->active = $request['active'];
            //$edituser->privilege = $request['privilege'];
            //$user->type = $request['type'];
            //$user->bedrooms = $request['bedrooms'];
            //$user->bathrooms = $request['bathrooms'];
            //$user->description = $request['description'];
            $edituser->save();
            return redirect()->action('DashboardController@getDashboard');
        }
        else
        {
            return view('errors.autherror');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Delete the user with the specified id.
        //If the user has any properties that are in their name you will be able to transfer
        //to another user or delete them.
        $user = \App\User::find($id);
        $ulistings = DB::select('select * from listings where user_id =' . $id, [1]);

        if ($transfer != 0)
        {
            //transfer other listing to another user
            foreach ($ulisting as $ul)
            {
                $ul->user_id = $request->tid;
                $ul->save();
            }
        }
        else
        {
            //Delete all the listing that this user made.
            foreach ($ulistings as $ul)
            {
                $filenames = DB::select('select * from listing_pictures where listing_id =' . $ul->id, [1]);
                return view($filenames);
                //Delete the files found in storage with the associated filenames
                Storage::delete($filenames);
       
                //Delete the records in the ListingPics table associated with the particular listing
                DB::table('listing_pictures')->whereIn('listing_id', $listing['id'])->delete(); 

                //Delete the listing from the database.
                $ul->delete();
            }
        }


        $user->delete();
        return redirect()->action('DashboardController@getUsers'); 
    }
}
