<?php

namespace App\Http\Requests\Video;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends StoreRequest
{

    public function rules(): array
    {
        return array_merge(Parent::rules(),[
            'slug' => ['required', Rule::unique('videos')->ignore($this->video),'alpha_dash:ascii'],
            'file' => 'file|mimetypes:video/mp4|nullable',    
        ]);
    }


}
