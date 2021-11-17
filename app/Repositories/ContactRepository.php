<?php

namespace App\Repositories;

use App\Exceptions\InvalidRequestException;
use App\Models\Contact;
use App\Models\Gender;
use App\Traits\HasRequest;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class ContactRepository
{
    use HasRequest;

    public function __construct(private GenderRepository $gender) {}

    /**
     * Get paginated contacts list.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function get() : Paginator
    {
        if (!$this->request || !($this->request instanceof Request)) {
            throw new InvalidRequestException('Request invalid or not set.');
        }

        /** get aliases using from the genders table using request lookup value. */
        $aliases = $this->gender->using($this->request)->aliasesUsing('gender');

        /** use search criteria to get results. */
        return Contact::whereHas('gender', fn($gender) => $gender->whereIn('genders.alias', $aliases))
            ->where(function($q) {
                $query = $this->request->get('query', '');

                if($query == '') return $q;

                return $q->where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->simplePaginate(4);
    }
}
