<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Country;
use App\Models\State;


class UniqueStateNameInCountry implements Rule
{
    public function __construct($countryId)
    {
        $this->countryId = $countryId;
    }

    public function passes($attribute, $value)
    {
        // Check if the city name is unique within the given state
        $existingState = State::where('name', $value)
                            ->where('country_id', $this->countryId)
                            ->first();

        return !$existingState;
    }

    public function message()
    {
        return 'The state name must be unique within the selected country.';
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
