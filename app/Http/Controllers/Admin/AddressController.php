<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\People;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    private $repository ;

    public function __construct(Contact $contact)
    {
        $this->repository = $contact;
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
        

        $addresses = Contact::where('people_id', $people->id)->paginate();
        $people = People::where('id', $idPeople)->first();


        return view('pages.addresses.index',compact(['people','addresses']));
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
    
      
        return view('pages.addresses.create',compact(['people']));
    
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
        
       $data['people_id'] = $request['idPeople'];

       $this->repository->create($data);
       $person  = $request['idPeople'];



       return redirect()->route('people.show', compact(['person']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $idAddress = $request['idAddress'];
        $idPeople = $request['idPeople'];

        if(!$address = $this->repository->where('id', $idAddress)->first()){
            return redirect()->back();
        }
        $people = People::where('id', $idPeople)->first();

        return view('pages.addresses.show',compact(['address','people']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        
        $idAddress = $request['idAddress'];
        $idPeople = $request['idPeople'];

        if(!$address = $this->repository->latest()->find($idAddress)){
            return redirect()->back();
        }

        $people = People::where('id', $idPeople)->first();
  
        return view('pages.addresses.edit',compact(['address','people']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idAddress)
    {
        $idAddress = $request['idAddress'];
        $person = $request['idPeople'];

        if(!$address = $this->repository->latest()->find($idAddress)){
            return redirect()->back();
        }

        
        $data = $request->except('_token');
        $data['people_id'] = $request['idPeople'];
        

        $address->update($data);


        return redirect()->route('people.show', compact(['person']));
    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {

        $idAddress = $request['idAddress'];
        $person = $request['idPeople'];

        if(!$address = $this->repository->find($idAddress)){
            return redirect()->back();
        }

        $address->delete();

        return redirect()->route('people.show', compact(['person']));


      
    }
}
