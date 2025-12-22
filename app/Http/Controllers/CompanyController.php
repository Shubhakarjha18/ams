<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository) {
        $this->companyRepository = $companyRepository;
    }

    public function index(Request $request){
        try{
            $search = $request->query('search');
            $companies = $this->companyRepository->getAll($search);
            return view('backend.companies.index',compact('companies','search'));
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create(){
        return view('backend.companies.create');
    }

    public function store(Request $request){
       try {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|min:2',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'nullable|max:20|min:5',
            'website' => 'nullable|url',
        ]);
        
         $this->companyRepository->store($validatedData);
         return \back()->with('success', 'Company added successfully');
       } catch (\Throwable $th) {
        dd($th->getMessage());
       }
    }

    public function edit($id){
        $company = Company::findOrFail($id);
        return view('backend.companies.edit',compact('company'));
    }

    public function update(Request $request,$id){
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255|min:2',
                'address' => 'nullable|string|max:255',
                'email' => 'required|email',
                'phone' => 'nullable|max:20|min:5',
                'website' => 'nullable|url',
            ]);
            $this->companyRepository->update($id,$validatedData);
            return back()->with('success','Company Updated successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function destroy($id){
        try {
            $this->companyRepository->delete($id);
            return response()->json([
                'success' => true,
                'message' => 'Company deleted successfully !'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
