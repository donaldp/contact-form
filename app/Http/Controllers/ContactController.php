<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\SubmitContactFormRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    /**
     * Show contact us form.
     *
     * @return \Inertia\Response
     */
    public function index() : Response
    {
        return Inertia::render('Index');
    }

    /**
     * Submit contact form.
     *
     * @param \App\Http\Requests\Contact\SubmitContactFormRequest $request
     * @return \Inertia\Response
     */
    public function store(SubmitContactFormRequest $request) : Response
    {
        return $request->persist();
    }
}
