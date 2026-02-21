<?php

namespace Narsil\Cms\Form\Http\Controllers;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Casts\DiffForHumansCast;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Enums\RequestMethodEnum;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Contracts\Forms\FormForm;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Http\Controllers\RenderController;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class FormEditController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Form $form
     *
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request, Form $form): JsonResponse|Response
    {
        $this->authorize(AbilityEnum::UPDATE, $form);

        $data = $this->getData($form);
        $form = $this->getForm($form);

        return $this->render('narsil/cms::resources/form', [
            'data' => $data,
            'form' => $form,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Get the associated data.
     *
     * @param Form $form
     *
     * @return array<string,mixed>
     */
    protected function getData(Form $form): array
    {
        $form->loadMissingCreatorAndEditor();

        $form->loadMissing([
            Form::RELATION_WEBHOOKS,
        ]);

        $form->mergeCasts([
            Form::CREATED_AT => DiffForHumansCast::class,
            Form::UPDATED_AT => DiffForHumansCast::class,
        ]);

        $data = $form->toArrayWithTranslations();

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getModelLabel(Form::TABLE);
    }

    /**
     * Get the associated form.
     *
     * @param Form $form
     *
     * @return FormForm
     */
    protected function getForm(Form $form): FormForm
    {
        $form = app(FormForm::class, ['model' => $form])
            ->action(route('forms.update', $form->{Form::ID}))
            ->id($form->{Form::ID})
            ->method(RequestMethodEnum::PATCH->value)
            ->submitLabel(trans('narsil::ui.update'));

        return $form;
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getModelLabel(Form::TABLE);
    }

    #endregion
}
