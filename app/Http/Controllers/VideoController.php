<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideoController extends Controller
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

    public function getVideos($video_category)
    {


        $user = \Auth::user();
        $uid = \Auth::user()->id;
        $search = '';
        $edit = 'false';
        if ($video_category == 'all')
         {
            $videos = \App\Videos::paginate(25);
            return view('dashboard.videos.all', compact('edit', 'user', 'videos', 'search', 'video_category'));
         }
         elseif ($video_category == 'schedule') {
            return redirect('dashboard.dashboard.home');
          } 
         else
         {
         $videos = \App\Videos::where('video_category', $video_category)->paginate(25);
        return view('dashboard.videos.all', compact('edit', 'user', 'videos', 'search', 'video_category'));
   
         }
        
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
        //Check to see if the user is actually logged in.
        if (\Auth::check())
        {
            $errors = false;
            $data = $request;
            
            //Input Rules for processing the HTML Form data
            $rules = [
                'file'     => 'required|max:120000|mimes:mpg,mp4,mpeg,avi,mov,wma',
                'vcat' => 'required'
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

            
            $user = \Auth::user();
            $uid = \Auth::user()->id;
                
                //For each files upload create an entry in the Video table and
                //move the uploaded file to the proper directory.
            if ($request->file[0] != null)
            {
                $files = $request->file;
                foreach ($files as $file) 
                {    
                    $name = $file->getClientOriginalName();
                    $filetype = $file->getClientOriginalExtension();
                    $newfilename = time() . $name;
                    //Populate the search query
                    $t_name = $newfilename . ' ' . $name . ' ' . $filetype;
                    $t_tags = str_replace(',', ' ', $request->video_tags);
                    $search_query = $t_name . ' ' . $t_tags . ' ' . $request->vcat;

                    $newvideo = \App\Videos::create([
                        'user_id'                   => $user['id'],
                        'video_tags'             => $request->video_tags,
                        'video_category'         => $request->vcat,
                        'video_name'             => $name,
                        'video_true_name'        => $newfilename,
                        'video_extension'        => $filetype,
                        'search_query'              => $search_query
                        ]);
                    $file->move(public_path().'/uploads/videos/', $newfilename);
                }
            }
            

              $video_category = $request->vcat;
                $search = '';
                $edit = 'false';
            if ($video_category  == 'schedule')
            {

                $schedule_current_week = \App\Videos::orderBy('id', 'desc')
                                                ->where('video_tags','Current Week')
                                                ->first();
                $schedule_next_week = \App\Videos::orderBy('id', 'desc')
                                                ->where('video_tags','Next Week')
                                                ->first();
                $phone_list = \App\Videos::orderBy('id', 'desc')
                                                ->where('video_tags','Phone List')
                                                ->first();
                $emergencies = \App\Videos::orderBy('id', 'desc')
                                                ->where('video_tags','Emergencies')
                                                ->first();
                $pay_dates = \App\Videos::orderBy('id', 'desc')
                                                ->where('video_tags','Pay Dates')
                                                ->first();                                        
            $video_category = 'schedule';
            $user = \Auth::user();
            $uid = \Auth::user()->id;
            $search = '';
            $posts = \App\Posts::paginate(10);
            $success = 'Your file has been uploaded.';
            return view('dashboard.home', compact('user', 'posts', 'search', 'video_category', 
                                                'schedule_current_week', 'schedule_next_week', 'phone_list',
                                                'emergencies', 'pay_dates', 'success'));
                }
                if ($video_category == 'all')
                {
                    $videos = \App\Videos::paginate(25);
                    return redirect('dashboard/videos/' . $video_category)->with(compact('user', 'videos', 'search', 'video_category', 'edit'));
                 } 
                else
                {
                    $videos = \App\Videos::where('video_category', $video_category)->paginate(25);
                    return redirect('dashboard/videos/' . $video_category)->with(compact('user', 'videos', 'search', 'video_category', 'edit'));
                }
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
        $user = \Auth::user();
        $uid = \Auth::user()->id;
        $video = \App\Videos::find($id);
        $message = 0;
        return view('dashboard.videos.edit')->with(compact('user', 'video', 'message'));
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
        //Check to see if the user is actually logged in.
        if (\Auth::check())
        {
            $errors = false;
            $data = $request;
            
            //Input Rules for processing the HTML Form data
            $rules = [
                'vcat' => 'required'
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

            
            $user = \Auth::user();
            $uid = \Auth::user()->id;
            $editvideo = \App\Videos::find($id);
            $editvideo->video_category = $request->vcat;
            $editvideo->video_tags = $request->video_tags;
            $editvideo->video_text = $request->video_text;
            $search_query = '';

            //Replace the old file with the new one. Old file is deleted from storage.
            if ($request->file != null)
            {
                    unlink(public_path() . '/uploads/videos/' . $video->video_true_name);
                    $name = $file->getClientOriginalName();
                    $filetype = $file->getClientOriginalExtension();
                    $newfilename = time() . $name; 

                    $editvideo->video_name = $name;
                    $editvideo->video_true_name = $newfilename;
                    $editvideo->video_extension = $filetype;
                    
                    $file->move(public_path().'/uploads/videos/', $newfilename);
                    $search_query = $newfilename . ' ' . $name . ' ' . $filetype;
                
            }
                 //Populate the search query
                $t_tags = str_replace(',', ' ', $request->video_tags);
                $search_query .= ' ' . $t_tags . ' ' . $request->vcat;
                $editvideo->search_query = $search_query;

                //Save the video back to the database.    
                $editvideo->save();

                $video_category = $request->video_category;
                $search = '';
                $edit = 'false';
                    $video = \App\Videos::find($id);
                    $success = 'Changes successfully applied!';
                    $videos = \App\Videos::paginate(25);
                    return view('dashboard.videos.all')->with(compact('user', 'video_category','videos', 'video', 'success', 'search'));
                 
                
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
    public function destroy($video_category, $id)
    {
    
        //This is for deleting a single picture from a listing
        //First we must specify the listing picture we would like to delete
         $video = \App\Videos::find($id);


         //Remove the picture from physical storage.
         unlink(public_path() . '/uploads/videos/' . $video->video_true_name);

         //Save the changes to the listing and delete the record for the picture from the
         //database.
         $user = \Auth::user();
         $uid = \Auth::user()->id;
         $search= '';
         $video->delete();
         $success = 'Video was successfully deleted.';
         $videos = \App\Videos::paginate(25);
         return view('dashboard.videos.all')->with(compact('user','videos', 'video', 'success', 'search'));
                
    }
}
