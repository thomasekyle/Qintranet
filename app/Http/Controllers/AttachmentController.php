<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AttachmentController extends Controller
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
         $attachment = \App\Attachment::find($id);
         $topic = \App\FiveMinuteTopic::find($attachment->topic_id);
         unlink(public_path() . '/uploads/attachments/' . $attachment->attachment_true_name);
         $attachment->delete();

         $search ='';
         $user = \Auth::user();
         $attachments = \App\Attachment::where('topic_id', $topic->id)->get();
         $id = $topic->id;
            return view('dashboard.5mintopics.view', compact('user', 'topic', 'id', 'search', 'attachments'));
        
        }
        else
        {
            return view('errors.autherror');
        }
    }
}
