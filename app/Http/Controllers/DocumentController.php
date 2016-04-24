<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
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

    public function getDocuments($document_category)
    {


        $user = \Auth::user();
        $uid = \Auth::user()->id;
        $search = '';
        $edit = 'false';
        if ($document_category == 'all')
         {
            $documents = \App\Documents::paginate(25);
            return view('dashboard.documents.all', compact('edit', 'user', 'documents', 'search', 'document_category'));
         }
         elseif ($document_category == 'schedule') {
            return redirect('dashboard.dashboard.home');
          } 
         else
         {
         $documents = \App\Documents::where('document_category', $document_category)->paginate(25);
        return view('dashboard.documents.all', compact('edit', 'user', 'documents', 'search', 'document_category'));
   
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
                'file'     => 'required|max:20000|mimes:doc,docx,pdf,txt,rtf',
                'dcat' => 'required'
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
                
                //For each files upload create an entry in the Document table and
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
                    $t_tags = str_replace(',', ' ', $request->document_tags);
                    $search_query = $t_name . ' ' . $t_tags . ' ' . $request->dcat;

                    $newdocument = \App\Documents::create([
                        'user_id'                   => $user['id'],
                        'document_tags'             => $request->document_tags,
                        'document_category'         => $request->dcat,
                        'document_name'             => $name,
                        'document_true_name'        => $newfilename,
                        'document_extension'        => $filetype,
                        'search_query'              => $search_query
                        ]);
                    $file->move(public_path().'/uploads/documents/', $newfilename);
                }
            }
            

              $document_category = $request->dcat;
                $search = '';
                $edit = 'false';
            if ($document_category  == 'schedule')
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
            $posts = \App\Posts::paginate(10);
            $success = 'Your file has been uploaded.';
            return view('dashboard.home', compact('user', 'posts', 'search', 'document_category', 
                                                'schedule_current_week', 'schedule_next_week', 'phone_list',
                                                'emergencies', 'pay_dates', 'success'));
                }
                if ($document_category == 'all')
                {
                    $documents = \App\Documents::paginate(25);
                    return redirect('dashboard/documents/' . $document_category)->with(compact('user', 'documents', 'search', 'document_category', 'edit'));
                 } 
                else
                {
                    $documents = \App\Documents::where('document_category', $document_category)->paginate(25);
                    return redirect('dashboard/documents/' . $document_category)->with(compact('user', 'documents', 'search', 'document_category', 'edit'));
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
        //
        $user = \Auth::user();
        $uid = \Auth::user()->id;
        $document = \App\Documents::find($id);
        $message = 0;
        return view('dashboard.documents.edit')->with(compact('user', 'document', 'message'));
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
                'dcat' => 'required'
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
            $editdocument = \App\Documents::find($id);
            $editdocument->document_category = $request->dcat;
            $editdocument->document_tags = $request->document_tags;
            $editdocument->document_text = $request->document_text;
            $search_query = '';

            //Replace the old file with the new one. Old file is deleted from storage.
            if ($request->file != null)
            {
                    unlink(public_path() . '/uploads/documents/' . $document->document_true_name);
                    $name = $file->getClientOriginalName();
                    $filetype = $file->getClientOriginalExtension();
                    $newfilename = time() . $name; 

                    $editdocument->document_name = $name;
                    $editdocument->document_true_name = $newfilename;
                    $editdocument->document_extension = $filetype;
                    
                    $file->move(public_path().'/uploads/documents/', $newfilename);
                    $search_query = $newfilename . ' ' . $name . ' ' . $filetype;
                
            }
                 //Populate the search query
                $t_tags = str_replace(',', ' ', $request->document_tags);
                $search_query .= ' ' . $t_tags . ' ' . $request->dcat;
                $editdocument->search_query = $search_query;

                //Save the document back to the database.    
                $editdocument->save();

                $document_category = $request->document_category;
                $search = '';
                $edit = 'false';
                    $document = \App\Documents::find($id);
                    $success = 'Changes successfully applied!';
                    $documents = \App\Documents::paginate(25);
                    return view('dashboard.documents.all')->with(compact('user', 'document_category','documents', 'document', 'success', 'search'));
                 
                
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
         $document = \App\Documents::find($id);


         //Remove the picture from physical storage.
         unlink(public_path() . '/uploads/documents/' . $document->document_true_name);

         //Save the changes to the listing and delete the record for the picture from the
         //database.
         $user = \Auth::user();
         $uid = \Auth::user()->id;
         $search= '';
         $document->delete();
         $success = 'Document was successfully deleted.';
         $documents = \App\Documents::paginate(25);
         return view('dashboard.documents.all')->with(compact('user','documents', 'document', 'success', 'search'));
                 
    }
}
