<?php

namespace AlbertoBottarini\NovaExclusiveFields;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExclusiveBoolean extends Boolean
{
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        parent::fillAttributeFromRequest($request, $requestAttribute, $model, $attribute);

        $value = $request[$requestAttribute];

        if ($value == $this->trueValue) {
            $model::saved(function ($model) use ($attribute) {
                $model::where($model->getKeyName(), '<>', $model->getKey())
                    ->where($attribute, $this->trueValue)
                    ->update([$attribute => $this->falseValue]);
            });
        }
    }
}
