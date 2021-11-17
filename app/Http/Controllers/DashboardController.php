<?php

namespace App\Http\Controllers;

use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Instantiate Dashboard controller.
     *
     * @param \App\Repositories\ContactRepository $contacts
     */
    public function __construct(private ContactRepository $contacts) {}

    /**
     * Show most recent messages.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) : Response
    {
        return Inertia::render('Dashboard', [
            'contacts' => $this->contacts->using($request)->get(),
            'filters' => [
                'gender' => $request->query('gender', 'all'),
                'query' => $request->query('query', '')
            ]
        ]);
    }
}
