<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use App\Models\State;
use App\Models\City;

class UniqueCityNameInState implements Rule
{
    public function __construct($stateId)
    {
        $this->stateId = $stateId;
    }

    public function passes($attribute, $value)
    {
        // Check if the city name is unique within the given state
        $existingCity = City::where('name', $value)
                            ->where('state_id', $this->stateId)
                            ->first();

        return !$existingCity;
    }

    public function message()
    {
        return 'The city name must be unique within the selected state.';
    }

     /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
