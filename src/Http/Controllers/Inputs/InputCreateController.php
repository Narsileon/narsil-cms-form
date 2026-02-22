<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Http\Controllers\RenderController;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Forms\InputForm;
use Narsil\Cms\Form\Models\Input;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputCreateController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request): JsonResponse|Response
    {
        $this->authorize(AbilityEnum::CREATE, Input::class);

        $form = $this->getForm();

        return $this->render('narsil/cms::resources/form', [
            'form' => $form,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getModelLabel(Input::TABLE);
    }

    /**
     * Get the associated form.
     *
     * @return InputForm
     */
    protected function getForm(): InputForm
    {
        $form = app(InputForm::class)
            ->action(route('inputs.store'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.save'));

        return $form;
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel(Input::TABLE);
    }

    #endregion
}
