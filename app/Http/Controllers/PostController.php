<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (\Auth::check())
        {
            //Set errors to false since we do not know if the request contains
            //valid data.
            $errors = false;
            $data = $request;
            
            //Input Rules for processing the HTML Form data
            $rules = [
                'post_name'     => 'required',
                'post_content'     => 'required',
                'pcat' => 'required'
                
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

            //Construct the search query field
            $dt = date("Y-m-d");
            $sd = date('m.d.Y');
            $month = date("F");
            $t_name = str_replace(',', '', $request->post_name);
            $t_tags = str_replace(',', ' ', $request->post_tags);
            $search_query = $t_name . ' ' . $t_tags . ' ' . $request->post_category . ' ' . $month . ' ' . $sd;
        
            //Update the post with the information from the request.
            $user = \Auth::user();
            $uid = \Auth::user()->id;
            $post = \App\Posts::create([
                'user_id'          => $uid,
                'post_name'        => $request->post_name,
                'post_content'     => $request->post_content,
                'post_category'    => $request->pcat,
                'post_tags'        => $request->post_tags,
                'search_query'     => $search_query,
                'post_date'        => $dt,
            ]);

            $post->save();

            $search = '';
            $posts = \App\Posts::paginate(12);
            

            //DASHBOARD LOGIC
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
        $success = 'Post was successfully created!';
        return view('dashboard.home', compact('user', 'posts', 'search', 'document_category', 'success', 
                                                'schedule_current_week', 'schedule_next_week', 'phone_list',
                                                'emergencies', 'pay_dates'));
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
        //
        $user = \Auth::user();
        $uid = \Auth::user()->id;
        $post = \App\Posts::find($id);
        $message = 0;
        return view('dashboard.posts.edit')->with(compact('user', 'post', 'message'));
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
        //
        if (\Auth::check())
        {
            //Set errors to false since we do not know if the request contains
            //valid data.
            $errors = false;
            $data = $request;
            
            //Input Rules for processing the HTML Form data
            $rules = [
                'post_name'     => 'required',
                'post_content'     => 'required',
                'pcat' => 'required'
                
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

            $post = \App\Posts::find($id);
            //Construct the search query field
            $dt = $post->post_date;
            $t_name = str_replace(',', '', $request->post_name);
            $t_tags = str_replace(',', ' ', $request->post_tags);
            $search_query = $t_name . ' ' . $t_tags . ' ' . $request->pcat . ' ' . $dt;
        
            //Update the post with the information from the request.
            $user = \Auth::user();
            $uid = \Auth::user()->id;
                $post->post_name = $request->post_name;
                $post->post_content = $request->post_content;
                $post->post_category = $request->pcat;
                $post->post_tags = $request->post_tags;
                $post->search_query = $search_query;

            $post->save();

            $search = '';
            $posts = \App\Posts::paginate(12);
            

            //DASHBOARD LOGIC
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
        $success = 'Post was successfully updated!';
        return view('dashboard.home', compact('user', 'posts', 'search', 'document_category', 'success',
                                                'schedule_current_week', 'schedule_next_week', 'phone_list',
                                                'emergencies', 'pay_dates'));
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
    public function destroy($id)
    {
        //This is for deleting a single picture from a listing
        //First we must specify the listing picture we would like to delete
         $post = \App\Posts::find($id);

         //Save the changes to the listing and delete the record for the picture from the
         //database.
         $user = \Auth::user();
         $uid = \Auth::user()->id;
         $search= '';
         $post->delete();

         $success = 'Post was successfully deleted.';
         
         //DASHBOARD LOGIC
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
        return view('dashboard.home', compact('user', 'posts', 'search', 'document_category', 'success',
                                                'schedule_current_week', 'schedule_next_week', 'phone_list',
                                                'emergencies', 'pay_dates')); 
    }
}
