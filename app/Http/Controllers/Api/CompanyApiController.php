<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Facades\Validator;

class CompanyApiController extends Controller
{
    public function index()
    {
        $companies = Company::get();

        if ($companies->count() > 0) {
            // return new CompanyResource(true,'List Company', $companies);
            return view('company.index', compact('companies'));
        } else {
            return response()->json(['message' => "No Record Available"], 200);
        }
    }
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'company_description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All Field Must Be Filled!',
                'error' => $validator->messages(),
            ], 422);
        }

        $company = Company::create([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_description' => $request->company_description
        ]);

        return response()->json([
            'data' => new CompanyResource(true, 'Company Added Successfully', $company)
        ], 200);
    }

    public function show(Company $company)
    {
        return new CompanyResource(true, '', $company);
    }

    public function update(Request $request, Company $company)
    {
        $validator =  Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'company_description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'All Field Must Be Filled!',
                'error' => $validator->messages(),
            ], 422);
        }

        $company->update([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_description' => $request->company_description
        ]);

        return response()->json([
            'data' => new CompanyResource(true, 'Company Updated Successfully', $company)
        ], 200);
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json([
            'message' => 'Product Deleted Succesfully!'
        ], 200);
    }
}
