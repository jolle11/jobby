<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
	 */
	public function rules(): array
	{
		return [
			'name' => ['required', 'string', 'max:55'],
			'company' => ['required', 'string', 'max:55'],
			'description' => ['required', 'string', 'max:1000'],
			'city' => ['required', 'string', 'max:55'],
			'applications' => ['boolean'],
		];
	}
}
