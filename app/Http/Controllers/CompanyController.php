<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Company\CompanyCreateRequest;
use App\Http\Requests\Company\CompanyUpdateRequest;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($ids)
    {
        $companyIds = explode(',', $ids);
        $validator = Validator::make(['ids' => $companyIds], [
            'ids.*' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $companies = Company::whereIn('id', $companyIds)->get();
        return response()->json($companies);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);
        Company::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'The new company has been added successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $company = Company::find($id);

        if(!$company){
            return response()->json([
                'success' => true,
                'message' => 'Invalid identifier.'
            ]);
        }

        $company->update($validated);
        return response()->json([
            'success' => true,
            'message' => 'The company has been updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    /**
     * foundation
     *
     * @return void
     */
    public function foundation(){

        return Company::getFoundedCompanies('2002-01-01', '2002-12-31');
    }
    
    /**
     * activity
     *
     * @return void
     */
    public function activity(){

        return Company::getCompaniesByActivities();
    }
}
