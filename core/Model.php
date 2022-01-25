<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MAX = 'max';
    public const RULE_MIN = 'min';
    public const RULE_MATCH = 'match';

    public array $errors = [];


    public function loadData(array $getBody)
    {

        //  property_exists == clasda biz kiritgan property bor yoki yo'qligin tekwiradi
        foreach ($getBody as $key => $item) {
            if (property_exists($this, $key)) {

                $this->{$key} = $item;
            }


        }


    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};  // loadData() orqali qiymat olgan child modelning properetiysining qiymati
            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (!is_string($rule)) {
                    $ruleName = key($rule);
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) { // agar formada inputga malumot kirilmagan bolsa
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);

                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_MATCH && $value > $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule, $rule);
                }
            }

        }
        return empty($this->errors);
    }

    abstract public function rules(): array;

    private function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMesages()[$rule] ?? '';

        foreach ($params as $key => $param) {
            $message = str_replace("{{$key}}", $param, $message);
        }
        $this->errors[$attribute][] = $message;

    }

    private function errorMesages()
    {
        return [
            self::RULE_REQUIRED => 'malumot kiritilishi shart',
            self::RULE_EMAIL => 'email xato kitildi',
            self::RULE_MIN => 'malumot uzunligi {min} dan kam bo\'lmasligi kerak',
            self::RULE_MAX => 'malumot uzunligi {max} dan ko\'p bo\'lmasligi kerak',
            self::RULE_MATCH => 'malumot {match} bilan bir xil bo\'lishi kerak'
        ];
    }

    public function hasErrors($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }

}
