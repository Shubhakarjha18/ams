<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface {
    public function getAll($search = null){
        $companies = Company::when($search, function($query) use ($search){
                        $query->where('name' , 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('phone', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();
        return $companies;
    }

    public function findById($id){
        return Company::findOrFail($id);
    }

    public function store(array $data){
        $data['company_code'] = generateCompanyCode($data['name']);
        $data['company_key'] = md5($data['name']);
        
        return Company::create($data);
    }

    public function update($id, array $data){
        $company = $this->findById($id);
        $company->update($data);
        return $company;
    }

    public function delete($id){
        $company = $this->findById($id);
        return $company->delete();
    }
}