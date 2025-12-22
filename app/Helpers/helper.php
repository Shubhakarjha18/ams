<?php

use App\Models\Company;
use Illuminate\Support\Str;

if(!function_exists('generateCompanyCode')) {
    function generateCompanyCode(string $companyName){
        //clean the name, remove the extra spaces
        $cleanName = trim(preg_replace('/\s+/',' ',$companyName));
        //split name into words
        $words = explode(' ',$cleanName);

        //take first letter of each words
        $baseCode = '';
        foreach($words as $word){
            $baseCode .= Str::upper(Str::substr($word,0,1));
        }

        //check if basecode already exists
        $existingCount = Company::withTrashed()->where('company_code','LIKE',$baseCode.'%')->count();
        
        //if exists append new number
        if($existingCount > 0){
            return $baseCode.'-'.($existingCount+1);
        }
        return $baseCode;
    }
}
