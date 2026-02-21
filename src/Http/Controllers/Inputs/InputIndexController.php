<?php

namespace Narsil\Cms\Form\Http\Controllers\Inputs;

#region USE

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Narsil\Base\Enums\AbilityEnum;
use Narsil\Base\Http\Collections\DataTableCollection;
use Narsil\Base\Services\ModelService;
use Narsil\Cms\Form\Models\Input;
use Narsil\Cms\Http\Controllers\RenderController;

#endregion

/**
 * @version 1.0.0
 * @author Jonathan Rigaux
 */
class InputIndexController extends RenderController
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return JsonResponse|Response
     */
    public function __invoke(Request $request): JsonResponse|Response
    {
        $this->authorize(AbilityEnum::VIEW_ANY, Input::class);

        $collection = $this->getCollection();

        return $this->render('narsil/cms::resources/index', [
            'collection' => $collection,
        ]);
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Get the associated collection.
     *
     * @return DataTableCollection
     */
    protected function getCollection(): DataTableCollection
    {
        $query = Input::query()
            ->with([
                Input::RELATION_VALIDATION_RULES,
            ])
            ->withCount([
                Input::RELATION_VALIDATION_RULES,
            ]);

        return new DataTableCollection($query, Input::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getDescription(): string
    {
        return ModelService::getTableLabel(Input::TABLE);
    }

    /**
     * {@inheritDoc}
     */
    protected function getTitle(): string
    {
        return ModelService::getTableLabel(Input::TABLE);
    }

    #endregion
}
