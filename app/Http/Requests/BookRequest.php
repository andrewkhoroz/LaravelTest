<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BookRequest extends Request
{

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
	        'title' => 'required|string',
	        'author_id' => 'required|integer|exists:authors,id',
	        'year' => 'required|integer',
	        'isbn' => 'required|string',
		];
	}
}
