<?php

namespace Narsil\Cms\Form\Http\Controllers\Fieldsets;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Forms\FieldsetForm;
use Narsil\Cms\Form\Models\Fieldset;
use Narsil\Cms\Http\Controllers\RenderController;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FieldsetCreateController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request): JsonResponse|Response
    {
        $this->authorize(AbilityEnum::CREATE, Fieldset::class);

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
        return ModelService::getModelLabel(Fieldset::TABLE);
    }

    /**
     * Get the associated form.
     *
     * @return FieldsetForm
     */
    protected function getForm(): FieldsetForm
    {
        $form = app(FieldsetForm::class)
            ->action(route('fieldsets.store'))
            ->method(RequestMethodEnum::POST->value)
            ->submitLabel(trans('narsil::ui.save'));

        return $form;
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel(Fieldset::TABLE);
    }

    #endregion
}
