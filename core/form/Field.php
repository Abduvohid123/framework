<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const  TYPE_TEXT = 'text';
    public const  TYPE_PASSWORD = 'password';
    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type=self::TYPE_TEXT;
    }




    public function __toString()
    {
        return sprintf('
            <div class="form-group">
            <label >%s</label>
            <input name="%s"
            value="%s"
            class="form-control%s"
            type="%s">
            <div class="invalid-feedback">
                %s
            </div>
        </div>',

            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasErrors($this->attribute) ? ' is-invalid' : '',
            $this->type,
            $this->model->getFirstError($this->attribute)

        );
    }

    public function passwordField(){
        $this->type=self::TYPE_PASSWORD;
        return $this;
    }


}
