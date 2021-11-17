<?php

namespace App\Http\Requests\Contact;

use App\Models\Contact;
use App\Models\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Inertia\Inertia;
use Inertia\Response;

class SubmitContactFormRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'gender' => 'required|in:' . implode(',', $this->genders()),
            'content' => 'required',
        ];
    }

    /**
     * Get a list of available genders.
     *
     * @return array
     */
    private function genders()
    {
        return Gender::select('alias')->get()->pluck('alias')->toArray();
    }

    /**
     * Submit form.
     *
     * @return \Inertia\Response
     */
    public function persist() : Response
    {
        /** create contact record. */
        $this->addRecord();

        /** redirect back. */
        return Inertia::render('Index', [
            'status' => 'Your form has been submitted'
        ]);
    }

    /**
     * Add a new contact form record.
     *
     * @return \App\Models\Contact
     */
    private function addRecord() : Contact
    {
        return Contact::create([
            'gender_id' => Gender::where('alias', $this->input('gender'))->first()->id,
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'content' => $this->input('content'),
        ]);
    }
}
