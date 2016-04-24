<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
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



    //Search the listings in the database for keywords in the search query record column
    public function searchDocuments(Request $request)
    {
        $temp_q = 0; $merge = array(); $queries = 0; $querylist=0;
        $querylist = str_replace(',', '', $request->search);
        $queries = explode(' ', $querylist);
        $user = \Auth::user();
        $uid = \Auth::user()->id;
        $temp_list = \App\Documents::all();
 

        foreach ($temp_list as $tl)
        {
            $i = 0;

            foreach ($queries as $q)
            {
                if (stripos($tl->search_query, $q) !== false) $i++;
            }
            //return view($i);
            if (count($queries) == $i) $merge[] = $tl->id;

        }
            $documents = \App\Documents::whereIn('id', $merge)->paginate(25);
        
        
      
        $search = $request->search;

        $document_category = 'search';        
        return view('dashboard.documents.search', compact('documents', 'user', 'search', 'document_category'));

    }

    //Search the listings in the database for keywords in the search query record column
    public function searchTopics(Request $request)
    {
        $temp_q = 0; $merge = array(); $queries = 0; $querylist=0;
        $querylist = str_replace(',', '', $request->search);
        $queries = explode(' ', $querylist);
        $user = \Auth::user();
        $uid = \Auth::user()->id;
        $temp_list = \App\FiveMinuteTopic::all();
 

        foreach ($temp_list as $tl)
        {
            $i = 0;

            foreach ($queries as $q)
            {
                if (stripos($tl->search_query, $q) !== false) $i++;
            }
            //return view($i);
            if (count($queries) == $i) $merge[] = $tl->id;

        }
            $topics = \App\FiveMinuteTopic::whereIn('id', $merge)->paginate(18);
        
        
        
        $search = $request->search;

        
        return view('dashboard.5mintopics.search', compact('topics', 'user', 'search'));

    }

    public function searchUsers(Request $request)
    {
        $temp_q = 0; $merge = array(); $queries = 0; $querylist=0;
        $querylist = str_replace(',', '', $request->search);
        $queries = explode(' ', $querylist);
        $user = \Auth::user();
        $temp_list = \App\User::all();

        foreach ($temp_list as $tl)
        {
            $i = 0;
            foreach ($queries as $q)
            {
                if (stripos($tl->search_query, $q) !== false) $i++;
            }
            if (count($queries) == $i) $merge[] = $tl->id;

        }
            $users = \App\User::whereIn('id', $merge)->paginate(1);
        
        
        
        $search = $request->search;

        
        return view('dashboard.users.search', compact('users', 'user', 'search'));

    }

    //Search the listings in the database for keywords in the search query record column
    public function searchVideos(Request $request)
    {
        $temp_q = 0; $merge = array(); $queries = 0; $querylist=0;
        $querylist = str_replace(',', '', $request->search);
        $queries = explode(' ', $querylist);
        $user = \Auth::user();
        $uid = \Auth::user()->id;
        $temp_list = \App\Videos::all();
 

        foreach ($temp_list as $tl)
        {
            $i = 0;

            foreach ($queries as $q)
            {
                if (stripos($tl->search_query, $q) !== false) $i++;
            }
            //return view($i);
            if (count($queries) == $i) $merge[] = $tl->id;

        }
            $videos = \App\Videos::whereIn('id', $merge)->paginate(25);
        
        
        
        $search = $request->search;
        $edit = 'false';
        $video_category = 'search';        
        return view('dashboard.videos.view', compact('edit', 'videos', 'user', 'search', 'video_category'));

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
    }
}
