<?php

namespace Starmoozie\DynamicPermission\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
                    'nama' => 'required|max:20|regex:/^[a-z_]*$/|unique:permission,nama',
                ];
                break;

            case 'PUT':

                $id = $this->get('id') ?? request()->route('id');

                return [
                    'nama' => 'required|max:20|regex:/^[a-z_]*$/|unique:permission,nama,'.$id
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
