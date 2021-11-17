<?php

namespace App\Repositories;

use App\Exceptions\InvalidRequestException;
use App\Models\Gender;
use App\Traits\HasRequest;
use Illuminate\Http\Request;

class GenderRepository
{
    use HasRequest;

    /**
     * Get gender aliases.
     *
     * @return string[]
     */
    public function aliases() : array
    {
        return Gender::select('alias')->get()->pluck('alias')->toArray();
    }

    /**
     * Get gender id's.
     *
     * @return int[]
     */
    public function ids() : array
    {
        return Gender::select('id')->get()->pluck('id')->toArray();
    }

    /**
     * Find using request.
     *
     * @param string $key
     * @param string $lookupValue
     * @throws InvalidRequestException
     * @return \App\Models\Gender
     */
    public function findBy(string $key, string $lookupValue = 'gender') : Gender
    {
        if (!$this->request || !($this->request instanceof Request)) {
            throw new InvalidRequestException('Request invalid or not set.');
        }

        return Gender::where($key, $this->request->get($lookupValue))->firstOrFail();
    }

    /**
     * Get aliases using request lookup value.
     *
     * @param string $lookupValue
     * @return array $aliases | [$aliases]
     */
    public function aliasesUsing($lookupValue = 'gender') : array
    {
        $aliases =  $this->request->get($lookupValue, 'all') === 'all'
            ? $this->aliases()
            : $this->findBy('alias')->alias;

        return is_array($aliases) ? $aliases : [$aliases];
    }
}
