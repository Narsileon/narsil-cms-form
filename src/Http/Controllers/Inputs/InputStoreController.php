<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Narsil\Cms\Enums\ModelEventEnum;
use Narsil\Cms\Form\Contracts\FormRequests\InputFormRequest;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Form\Services\Models\InputService;
use Narsil\Cms\Http\Controllers\RedirectController;
use Narsil\Cms\Services\ModelService;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputStoreController extends RedirectController
{
    #region PUBLIC METHODS

    /**
     * @param InputFormRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(InputFormRequest $request): RedirectResponse
    {
        $attributes = $request->validated();

        $input = Input::create($attributes);

        $input
            ->validation_rules()
            ->sync(Arr::get($attributes, Input::RELATION_VALIDATION_RULES, []));

        InputService::syncInputOptions($input, Arr::get($attributes, Input::RELATION_OPTIONS));

        return $this
            ->redirect(route('inputs.index'), $input)
            ->with('success', ModelService::getSuccessMessage(Input::class, ModelEventEnum::CREATED));
    }

    #endregion
}
