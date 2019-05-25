<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Idea;
use DB;

class IdeasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * Display a listing of all the ideas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ideas = Idea::all();
        return view('ideas.index', compact('ideas'));
    }

    /**
     * Show the form for creating a new resource.
     * Show the form for creating a new idea.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     * Store a newly created idea in MySql database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'destination' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'tags' => 'required'
        ]);

        $ideareq = new Idea([
            'title' => $request->get('title'),
            'publisher' => Auth::user()->name,
            'destination' => $request->get('destination'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'tags' => $request->get('tags'),
            'comments_number' => 0
        ]);

        $ideareq->save();

        return redirect("/ideas/$ideareq->id")->with('success', 'Idea Created!');
    }

    /**
     * Display the specified resource.
     * Display the specified idea.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idea = Idea::find($id);
        return view('ideas.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     * Show the form for editing the specified idea.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idea = Idea::find($id);
        return view('ideas.edit')->with('idea', $idea);
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
        $request->validate([
            'title' => 'required',
            'destination' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'tags' => 'required'
        ]);

        $idea = Idea::find($id);
        $idea->title = $request->input('title');
        $idea->destination = $request->input('destination');
        $idea->start_date = $request->input('start_date');
        $idea->end_date = $request->input('end_date');
        $idea->tags = $request->input('tags');
        $idea->save();

        return redirect('/ideas/myidea')->with('success', 'Idea Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idea = Idea::find($id);
        $idea->delete();
        return redirect('/ideas/myidea')->with('success', 'Idea Deleted');
    }

    
    /**
     * Search for ideas
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
		if($request->ajax()) {
            $output = "";
            $ideas = null;
            if ($request->isPartial == "true" && $request->searchway == "Destination") {
                $ideas = DB::table('ideas')->where('destination', 'LIKE', "%".$request->keyword."%")->get();
            }
            if ($request->isPartial == "false" && $request->searchway == "Destination") {
                $ideas = DB::table('ideas')->where('destination', $request->keyword)->get();
            }
            if ($request->isPartial == "true" && $request->searchway == "Tag") {
                $ideas = DB::table('ideas')->where('tags', 'LIKE', "%".$request->keyword."%")->get();
            }
            if ($request->isPartial == "false" && $request->searchway == "Tag") {
                $ideas = DB::table('ideas')->where('tags', $request->keyword)->get();
            }
			if($ideas) {
                $output.='<p>'. count($ideas). ' matched records</p>';
				foreach ($ideas as $key => $idea) {
					$output.='<tr>'.
					'<td><a href="'.route('ideas.show',$idea->id).'">'.$idea->title.'</a></td>'.
					'<td>'.$idea->publisher.'</td>'.
					'<td>'.$idea->destination.'</td>'.
                    '<td>'.$idea->start_date.'</td>'.
                    '<td>'.$idea->end_date.'</td>'.
                    '<td>'.$idea->tags.'</td>'.
                    '<td>'.$idea->comments_number.'</td>'.
					'</tr>';
				}
				return Response($output);
  			}
   		}
    }
    

    /**
     * Display a listing of ideas from a specific user.
     *
     * @return \Illuminate\Http\Response
     */
    public function myidea() {
        $user = Auth::user();
        // $myideas = DB::table('ideas')->where('publisher', $user->id)->get();
        $myideas = Idea::where('publisher', $user->name)->get();
        //$myideas = Idea::all();
        return view('ideas.myidea', compact('myideas'));
    }
    
    /**
     * Store a newly created resource in storage.
     * Store a newly created idea in MySql database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request, $id)
    {
        if($request->ajax()) {
            $request->validate([
                'comments_content' => 'required|max:255'
            ]);

            $idea = Idea::find($id);
            $newcomment = "<p>". Auth::user()->name. ":<br/>";
            $newcomment.= $request->input('comments_content')."</p>";
            $newcomment.= $idea->comments_content;
            $idea->comments_content = $newcomment;
            $idea->comments_number += 1;
            $idea->save();
        }
    }

    public function updateComment(Request $request, $id)
    {
        if($request->ajax()) {
            return Response(Idea::find($id)->comments_number . "##" . Idea::find($id)->comments_content);
        }
    }

}
