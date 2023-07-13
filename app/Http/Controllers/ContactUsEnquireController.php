<?php

namespace App\Http\Controllers;

use App\Models\ContactUsEnquire;
use App\Http\Requests\StoreContactUsEnquireRequest;
use App\Http\Requests\UpdateContactUsEnquireRequest;
use App\Traits\ApiResponse;
use App\Traits\ManagesFiles;

class ContactUsEnquireController extends Controller
{
    use ApiResponse, ManagesFiles;
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquires=ContactUsEnquire::orderBy('id','desc')->get();
        return $this->successResponse($enquires);
    }
    
    public function store(StoreContactUsEnquireRequest $request) 
    {        
        $data = $request->validated(); 
        if($request->hasFile('file')) {
           $data['file'] = $this->uploadFile($request->file('file'), ContactUsEnquire::PATH); 
        }
       $enquire= ContactUsEnquire::create($data);
        return $this->successResponse($enquire);
    }
    
    public function show(ContactUsEnquire $contactUsEnquire)
    {
       return $this->successResponse($contactUsEnquire);
    }
    
    public function destroy(ContactUsEnquire $contactUsEnquire)
    {
        if($contactUsEnquire->file) {
            $this->deleteFile($contactUsEnquire->file);
        }
        $contactUsEnquire->delete();
        return $this->customResponse([], 'Enquiry deleted!');  
    }

}