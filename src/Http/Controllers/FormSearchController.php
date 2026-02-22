<?php

namespace Narsil\Cms\Form\Http\Controllers;

#region USE

use Illuminate\Http\JsonResponse;
use Narsil\Base\Http\Controllers\RedirectController;
use Narsil\Base\Http\Data\OptionData;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Http\Requests\SearchRequest;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormSearchController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param SearchRequest $request
     * @param string $search
     *
     * @return JsonResponse
     */
    public function __invoke(SearchRequest $request): JsonResponse
    {
        $search = $request->validated(SearchRequest::SEARCH);

        $selectOptions = Form::query()
            ->when($search, function ($query) use ($search)
            {
                return $query
                    ->where(Form::SLUG, 'like', "%$search%");
            })
            ->get()
            ->map(function (Form $form)
            {
                return new OptionData(
                    label: $form->{Form::SLUG},
                    value: $form->{Form::ATTRIBUTE_IDENTIFIER},
                );
            })
            ->all();

        return response()
            ->json($selectOptions);
    }

    #endregion
}
