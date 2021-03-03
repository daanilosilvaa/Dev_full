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
        $idPeople = $request['idPerson'];

        if (!$person = People::where('id', $idPeople)->first()) {
            return redirect()->back();
          }
        

        $addresses = Contact::where('people_id', $person->id)->paginate();
        $person = People::where('id', $idPeople)->first();


        return view('pages.addresses.index',compact(['person','addresses']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $idPeople = $request['idPerson'];
        $person = People::where('id', $idPeople)->first();

        return view('pages.addresses.create',compact(['person']));
    
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
        $idPeople = $request['idPerson'];
        $person = People::where('id', $idPeople)->first();

       $data['people_id'] = $person->id;

       $this->repository->create($data);
       $addresses = Contact::where('people_id', $person->id)->paginate();

       return view('pages.addresses.index',compact(['person','addresses']));
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
        $idPerson = $request['idPerson'];

        if(!$address = $this->repository->where('id', $idAddress)->first()){
            return redirect()->back();
        }
        $people = People::where('id', $idPerson)->first();

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
        $idPerson = $request['idPerson'];

        if(!$address = $this->repository->latest()->find($idAddress)){
            return redirect()->back();
        }

        $person = People::where('id', $idPerson)->first();
  
        return view('pages.addresses.edit',compact(['address','person']));
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
        $idPerson = $request['idPerson'];

        if(!$address = $this->repository->latest()->find($idAddress)){
            return redirect()->back();
        }

        
        $data = $request->except('_token');
        $data['people_id'] = $request['idPerson'];
        

        $address->update($data);

        $person = People::where('id', $idPerson)->with('contacts')->first();


        return view('pages.addresses.index',compact(['person']));
    

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
        $idPerson = $request['idPerson'];

        if(!$address = $this->repository->find($idAddress)){
            return redirect()->back();
        }
        $person = People::where('id', $idPerson)->first();

        $address->delete();

        return view('pages.addresses.index',compact(['person']));


      
    }
}
