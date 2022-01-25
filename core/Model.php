<?php

namespace app\core;

abstract class Model
{
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
