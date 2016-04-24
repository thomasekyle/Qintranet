<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FiveMinuteController extends Controller
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
         // 
        if (\Auth::check())
        {
            //Set errors to false since we do not know if the request contains
            //valid data.
            $errors = false;
            $data = $request;
            
            //Input Rules for processing the HTML Form data
            $rules = [
                'topic_name'     => 'required',
                'topic_text'     => 'required',
                'topic_category' => 'required'
                
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
            $t_name = str_replace(',', '', $request->topic_name);
            $t_tags = str_replace(',', ' ', $request->topic_tags);
            $search_query = $t_name . ' ' . $t_tags . ' ' . $request->topic_category . ' ' . $month . ' ' . $sd;
        
            //Update the topic with the information from the request.
            $user = \Auth::user();
            $uid = \Auth::user()->id;
            $topic = \App\FiveMinuteTopic::create([
                'user_id'           => $uid,
                'topic_name'        => $request->topic_name,
                'topic_text'        => $request->topic_text,
                'topic_category'    => $request->topic_category,
                'topic_tags'        => $request->topic_tags,
                'search_query'      => $search_query,
                'topic_date'        => $dt,
            ]);


            $topic->save();

            //Add the attachments to the topic.
            if ($request->file[0] != null)
            {
                $files = $request->file;
                foreach ($files as $file) 
                {
                    $name = $file->getClientOriginalName();
                    $filetype = $file->getClientOriginalExtension();
                    $newfilename = time() . $name;
                    $newattachment = \App\Attachment::create([
                        'topic_id'                       => $topic->id,
                        'attachment_true_name'           => $newfilename,
                        'attachment_name'                => $name,
                        'attachment_category'            => $topic->topic_category,
                        'attachment_tags'                => $topic->topic_tags,
                        'attachment_extension'           => $filetype
                        ]);
                    $file->move(public_path().'/uploads/attachments/', $newfilename);
                }

                
            }

            $search = '';
            $attachments = \App\Attachment::where('topic_id', $topic->id)->get();
            $topics = \App\FiveMinuteTopic::paginate(12);
            return redirect()->back()->with(compact('user', 'topics', 'search', 'attachments'));
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
        if (\Auth::check())
        {
            $user = \Auth::user();
            $uid = \Auth::user()->id;
            $search = '';
            $topic = \App\FiveMinuteTopic::find($id);
            $attachments = \App\Attachment::where('topic_id', $id)->get();
            return view('dashboard.5mintopics.view', compact('user', 'topic', 'attachments', 'search'));
        }
        else
        {
            return view('errors.autherror');
        }
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
                'topic_name'     => 'required',
                'topic_text'     => 'required',
                'topic_category' => 'required'
                
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

            $t_name = str_replace(',', '', $request->topic_name);
            $t_tags = str_replace(',', ' ', $request->topic_tags);
            $search_query = $t_name . ' ' . $t_tags . ' ' . $request->topic_category;


            //Update the topic with the information from the request.
            $user = \Auth::user();
            $topic = \App\FiveMinuteTopic::find($id);
            $topic->topic_name = $request->topic_name;
            $topic->topic_text = $request->topic_text;
            $topic->topic_tags = $request->topic_tags;
            $topic->topic_category = $request->topic_category;
            $topic->search_query = $search_query;
            $topic->save();

            //Add the attachments to the topic.
            if ($request->file[0] != null)
            {
                $files = $request->file;
                foreach ($files as $file) 
                {
                    $name = $file->getClientOriginalName();
                    $filetype = $file->getClientOriginalExtension();
                    $newfilename = time() . $name;
                    $newattachment = \App\Attachment::create([
                        'topic_id'                       => $topic->id,
                        'attachment_true_name'           => $newfilename,
                        'attachment_name'                => $name,
                        'attachment_category'            => $topic->topic_category,
                        'attachment_tags'                => $topic->topic_tags,
                        'attachment_extension'           => $filetype
                        ]);
                    $file->move(public_path().'/uploads/attachments/', $newfilename);
                }

                
            }

            $search = '';
            $attachments = \App\Attachment::where('topic_id', $id)->get();
            return redirect()->back()->with(compact('user', 'topic', 'id', 'search', 'attachments'));
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
        //
        if (\Auth::check())
        {
        $topic = \App\FiveMinuteTopic::find($id);

        $attachments = \App\Attachment::where('topic_id', '=',$id)->get();
        foreach ($attachments as $attachment)
        {
            unlink(public_path() . '/uploads/attachments/' . $attachment->attachment_true_name);
            $attachment->delete();
        }
         $topic->delete();
         

         $search ='';
         $user = \Auth::user();
         $topics = \App\FiveMinuteTopic::paginate(12);
            return redirect('dashboard/5mintopics/all')->with(compact('user', 'topics', 'search'));
        
        }
        else
        {
            return view('errors.autherror');
        }
    }
}
