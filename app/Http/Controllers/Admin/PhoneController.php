<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\People;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    private $phone, $people ;

    public function __construct(Phone $phone, People $people)
    {
        $this->phone = $phone;
        $this->people = $people;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idPeople = $request['idPeople'];

        if (!$people = People::where('id', $idPeople)->first()) {
            return redirect()->back();
          }
        

        $phones = $this->phone->where('people_id', $people->id)->paginate();
        $people = People::where('id', $idPeople)->first();


        return view('pages.phones.index',compact(['people','phones']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $idPeople = $request['idPeople'];
        $people = People::where('id', $idPeople)->first();

        return view('pages.phones.create',compact(['people']));
    
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
        $idPeople = $request['idPeople'];
        $people = People::where('id', $idPeople)->first();

       $data['people_id'] = $people->id;

       $this->phone->create($data);
       $phones = Phone::where('people_id', $people->id)->paginate();

       return view('pages.phones.index',compact(['people','phones']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idPhone = $request['idPhone'];
        $idPeople = $request['idPeople'];

        if(!$phone = $this->phone->where('id', $idPhone)->first()){
            return redirect()->back();
        }
        $people = People::where('id', $idPeople)->first();

        return view('pages.phones.show',compact(['phone','people']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        
        $idPhone = $request['idPhone'];
        $idPeople = $request['idPeople'];

        if(!$phone = $this->phone->latest()->find($idPhone)){
            return redirect()->back();
        }

        $people = People::where('id', $idPeople)->first();
  
        return view('pages.phones.edit',compact(['phone','people']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idPhone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idPhone)
    {
        $idPhone = $request['idPhone'];
        $idPeople = $request['idPeople'];

        if(!$phone = $this->phone->latest()->find($idPhone)){
            return redirect()->back();
        }

        
        $data = $request->except('_token');
        $data['people_id'] = $request['idPeople'];
        

        $phone->update($data);

        $people = People::where('id', $idPeople)->with('contacts')->first();


        return view('pages.phones.index',compact(['people']));
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {

        $idPhone = $request['idPhone'];
        $idPeople = $request['idPeople'];

        if(!$phone = $this->phone->find($idPhone)){
            return redirect()->back();
        }
        $people = People::where('id', $idPeople)->first();

        $phone->delete();

        return view('pages.phones.index',compact(['people']));


      
    }
}
