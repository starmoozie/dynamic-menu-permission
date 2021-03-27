<?php

namespace Starmoozie\DynamicPermission\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return starmoozie_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'nama'        => 'required|max:30|regex:/^[a-zA-Z\s]*$/',
                    'url'         => 'required|max:20|regex:/^[a-z#]*$/',
                    'permission'  => 'required',
                    'for_backend' => 'required'
                ];
                break;

            case 'PUT':
                return [
                    'nama'        => 'required|max:30|regex:/^[a-zA-Z\s]*$/',
                    'url'         => 'required|max:20|regex:/^[a-z#]*$/',
                    'permission'  => 'required',
                    'for_backend' => 'required'
                ];
                break;

            default:
                return [];
                break;
        }
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
