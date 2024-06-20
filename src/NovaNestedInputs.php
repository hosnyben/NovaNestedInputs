<?php

namespace HosnyBEN\NovaNestedInputs;

use Closure;
use Laravel\Nova\Fields\Field;

class NovaNestedInputs extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-nested-inputs';

    public function resolve($resource, $attribute = null)
    {
        parent::resolve($resource, $attribute);
    }

    public function type(string $type)
    {
        if (!in_array($type, ['radio', 'checkbox'])) {
            throw new \Exception('Type must be radio, checkbox');
        }

        return $this->withMeta(['type' => $type]);
    }

    public function options($options)
    {
        return $this->withMeta(['options' => is_array($options) ? $options : call_user_func($options)]);
    }

    public function color(string $color)
    {
        return $this->withMeta(['color' => $color]);
    }
}
