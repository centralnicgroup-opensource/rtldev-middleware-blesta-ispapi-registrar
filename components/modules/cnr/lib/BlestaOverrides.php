<?php
namespace CNR\MODULE\LIB;

class BlestaOverrides
{
    public static function arrayToModuleFields($arr, \ModuleFields $fields = null, $vars = null)
    {
        if ($fields == null) {
            $fields = new \ModuleFields();
        }

        foreach ($arr as $name => $field) {
            $label = isset($field['label']) ? $field['label'] : null;
            $type = isset($field['type']) ? $field['type'] : null;
            $options = isset($field['options']) ? $field['options'] : null;
            $attributes = isset($field['attributes']) ? $field['attributes'] : [];
            $description = isset($field['description']) ? $field['description'] : null;

            $field_id = isset($attributes['id']) ? $attributes['id'] : $name . '_id';

            $field_label = null;
            if ($type !== 'hidden') {
                $field_label = $fields->label($label, $field_id, [], true);
            }

            $attributes['id'] = $field_id;

            switch ($type) {
                default:
                    $value = $options;
                    $type = 'field' . ucfirst($type);
                    $field_label->attach(
                        $fields->{$type}($name, isset($vars->{$name}) ? $vars->{$name} : $value, $attributes),
                    );
                    break;
                case 'hidden':
                    $value = $options;
                    $fields->setField(
                        $fields->fieldHidden($name, isset($vars->{$name}) ? $vars->{$name} : $value, $attributes)
                    );
                    break;
                case 'select':

                    $field_label->attach(
                        $fields->fieldSelect(
                            $name,
                            $options,
                            isset($vars->{$name}) ? $vars->{$name} : null,
                            $attributes
                        )
                    );
                    break;
                case 'checkbox':
                    // No break
                case 'radio':
                    $i = 0;
                    foreach ($options as $key => $value) {
                        $option_id = $field_id . '_' . $i++;
                        $option_label = $fields->label($value, $option_id);

                        $checked = false;
                        if (isset($vars->{$name})) {
                            if (is_array($vars->{$name})) {
                                $checked = in_array($key, $vars->{$name});
                            } else {
                                $checked = $key == $vars->{$name};
                            }
                        }

                        if ($type == 'checkbox') {
                            $field_label->attach(
                                $fields->fieldCheckbox($name, $key, $checked, ['id' => $option_id], $option_label)
                            );
                        } else {
                            $field_label->attach(
                                $fields->fieldRadio($name, $key, $checked, ['id' => $option_id], $option_label)
                            );
                        }
                    }
                    break;
            }
            if ($field_label) {
                $fields->setField($field_label);
                // make sure to add after adding the field label otherwise it will be added before the field label
                if ($description) {
                    // Add the description as a separate label below the field
                    $description_label = $fields->label($description, $field_id, ['class' => 'description'], true);
                    $fields->setField($description_label);
                }
            }
        }

        return $fields;
    }
}
