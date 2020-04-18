<?php

namespace AlbertoBottarini\NovaExclusiveFields;

use DB;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExclusiveSelect extends Select
{
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        parent::fillAttributeFromRequest($request, $requestAttribute, $model, $attribute);

        $value = $request[$requestAttribute];

        if (!$this->isNullValue($value)) {
            $model::saved(function ($model) use ($attribute, $value) {
                $model::where($model->getKeyName(), '<>', $model->getKey())
                    ->where($attribute, $value)
                    ->update([$attribute => DB::raw('null')]);
            });
        }
    }
}
