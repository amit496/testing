<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployerOnboardingQuestionnaireRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name'=>'required',
            'physical_address'=>'required',
            'primary_contact'=>'required',
            'primary_email'=>'required',
            'primary_direct_phone_number'=>'required',



            'workplace_dress_policy'=>'required',
            //'workplace_dress_policy_file'=>'required_if:workplace_dress_policy,1',
            'workplace_dress_upto_date'=>'required_if:workplace_dress_policy,1',
            'workplace_dress_communication'=>'required_if:workplace_dress_policy,0',

            'diversity_inclusion_policy'=>'required',
            //'diversity_inclusion_policy_file'=>'required_if:diversity_inclusion_policy,1',
            'diversity_inclusion_policy_upto_date'=>'required_if:diversity_inclusion_policy,1',

            'currently_poor_staff'=>'required',
            'currently_poor_staff_description'=>'required_if:currently_poor_staff,1',

            'percentage_of_emp_believe'=>'required',
            'different_position_business'=>'required',

            

            'appropriate_germents'=>'required',
            'appropriate_germents_description'=>'required_if:appropriate_germents,1',



            
            //'client_facing_team_members_roles_arr'=>'required',

            'more_casual_status'=>'required',
            //'more_casual'=>'required_if:more_casual_status,1',

            'impression_description'=>'required',

            'vision_statement'=>'required',
            //'vision_statement_file'=>'required_if:vision_statement,1',
            'vision_statement_description'=>'required_if:vision_statement,1',

            'additional_info'=>'required',
            //'additional_info_file'=>'required_if:additional_info,1',
            'additional_info_description'=>'required_if:more_casual_status,1',
            
            'hope_description'=>'required_if:additional_info,1',

            'additional_amount_status'=>'required',
            'additional_amount'=>'required_if:vision_statement,1',
        ];
    }
    public function messages()
    {
        return [
            'diversity_inclusion_policy_file.required_if' => 'This diversity inclusion policy file required!',
            'workplace_dress_policy_file.required_if' => 'Select attachment of workplace dress policy',
            
        ];
    }
}
