<?php

namespace App\Models\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Lacodix\LaravelModelFilter\Filters\Filter;

class CityMunicipalityFilter extends Filter
{
    public function apply(Builder $query): Builder
    {
        $value = is_array($this->values) ? current($this->values) : $this->values;

        return $query->where('city_municipality', 'LIKE', $value.'%');
    }

    public function populate(string|array $values): static
    {
        $this->values = Arr::wrap($values);

        return $this;
    }
}
