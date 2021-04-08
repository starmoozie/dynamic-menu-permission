<?php

namespace Starmoozie\DynamicPermission\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                    'email'    => 'required|email|unique:users,email|max:40',
                    'nip'      => 'required|unique:users,nip|max:30',
                    'nama'     => 'required|max:50|regex:/^[a-zA-Z\s]*$/',
                    'password' => 'required|confirmed|min:8',
                ];
                break;

            case 'PUT':

                $id = $this->get('id') ?? request()->route('id');

                return [
                    'email'    => 'required|email|max:40|unique:users,email,'.$id,
                    'nip'      => 'required|max:30|unique:users,nip,'.$id,
                    'nama'     => 'required|regex:/^[a-zA-Z\s]*$/',
                    'password' => 'confirmed',
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
