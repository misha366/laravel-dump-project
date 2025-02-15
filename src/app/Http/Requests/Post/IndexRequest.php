<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class IndexRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'category_id' => 'nullable|integer|exists:categories,id',
            'is_published' => 'nullable|boolean'
        ];
    }

    protected function failedValidation(Validator $validator): never {
        $invalidParams = $validator->errors()->toArray();
        $currentParams = $this->query();

        foreach ($invalidParams as $key => $value) {
            unset($currentParams[$key]);
        }

        $currentParamsStrign = count($currentParams) === 0 ? "" : "?" . http_build_query($currentParams);
        $newUrl = url()->current() . $currentParamsStrign;

        throw new HttpResponseException(redirect($newUrl)->withInput()); 
    }
}
