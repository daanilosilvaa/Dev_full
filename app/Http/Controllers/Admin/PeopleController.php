<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\People;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

class PeopleController extends Controller
{

    private $repository ;

    public function __construct(People $people)
    {
        $this->repository = $people;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::paginate();
        return view('pages.people.index', [
            'people' => $people,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('pages.people.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->except('_token');

       $remov = array(".", "-", "/", " ",);
        $data['document'] = str_replace($remov, "", $data['document']);

       if($data['type'] == "F"){
        $data['fantasy_name'] = null;      
       }


       $this->repository->create($data);

        return redirect()->route('people.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$people = $this->repository->where('id', $id)->with('contacts')->with('phones')->first()){
            return redirect()->back();
        }

        return view('pages.people.show',compact(['people']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$people = $this->repository->latest()->find($id)){
            return redirect()->back();
        }
  
        return view('pages.people.edit',compact('people'));
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
        if(!$people = $this->repository->latest()->find($id)){
            return redirect()->back();
        }

        $data = $request->except('_token');

       $remov = array(".", "-", "/", " ",);
        $data['document'] = str_replace($remov, "", $data['document']);

       if($data['type'] == "F"){
        $data['fantasy_name'] = null;      
       }
       


        $people->update($data);
        return redirect()->route('people.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if(!$people = $this->repository->find($id)){
          redirect()->back();
      }
      

      $people->delete();
      return redirect()->route('people.index');

    }

    /**
     * Search results
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $filters = $request->only('filter');

        $people = $this->repository
                                ->where(function($query) use ($request){
                                    if($request->filter) {
                                        $query->orWhere('document', 'LIKE', "%{$request->filter}%");
                                        $query->orWhere('name', 'LIKE', "%{$request->filter}%"); 
                                    }
                                })
                                ->latest()
                                ->paginate();
        return view('pages.people.index',compact('people', 'filters'));
    }
}
