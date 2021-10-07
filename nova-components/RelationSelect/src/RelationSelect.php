<?php

namespace Aesthetic\RelationSelect;

use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\MorphedByMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class RelationSelect extends Field
{
    private string $relationType;
    private string $resouceName;
    private string $relationLabel;
    private string $relationModel;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'relation-select';

    public function __construct($name, $attribute = null, $resource = null, $relation_type = 'morphToMany')
    {
        parent::__construct($name, $attribute);

        $this->resource = $resource;
        $this->relationType = $relation_type;
        $this->resouceName = $resource::uriKey();
    }

    public function relationLabel($label): RelationSelect
    {
        $this->relationLabel = $label;
        $this->withMeta(['relationLabel' => $label]);
        return $this;
    }

    public function relationModel($model): RelationSelect
    {
        $this->relationModel = $model;
        $this->withMeta(['relationModel' => $model]);
        return $this;
    }

    public function options($options): RelationSelect
    {
        $this->withMeta(['options' => $options]);
        return $this;
    }

    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        $requestValue = $request[$requestAttribute];
        $class = get_class($model);

        $class::saved(function (Model $model) use ($requestValue) {
            $relationModelIds = [];

            if (!empty($requestValue)) {
                foreach (explode(",", $requestValue) as $val) {
                    $relationModelIds[] = $this->relationModel::query()->updateOrCreate([$this->relationLabel => $val])->id;
                }
            }

            $model->{$this->attribute}()->sync($relationModelIds);
            //$model->syncTagsWithType($tagNames, $this->meta()['type'] ?? null);
        });
    }
}
