<?php

namespace AlbertoBottarini\NovaExclusiveFields;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExclusiveBoolean extends Boolean
{
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        parent::fillAttributeFromRequest($request, $requestAttribute, $model, $attribute);

        $model::saved(function ($model) use ($attribute) {
            $model::where($model->getKeyName(), '<>', $model->getKey())
                ->update([$attribute => $this->falseValue]);
        });
    }
}
