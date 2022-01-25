<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED='required';
    public const RULE_EMAIL='email';
    public const RULE_MAX='max';
    public const RULE_MIN='min';
    public const RULE_MATCH='match';

    abstract public function rules():array;

    public function loadData(array $getBody)
    {

        //  property_exists == clasda biz kiritgan property bor yoki yo'qligin tekwiradi
            foreach ($getBody as $key => $item) {
                if (property_exists($this, $key)){

                    $this->{$key}=$item;
                }


            }


    }

    public function validate()
    {
    }





}
