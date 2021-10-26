<?php

namespace App\Http\Repositories;

abstract class Repository
{

    // переменная для сохранения модели
    protected $model;

    // конструктур который принимает модель класса
    public function __construct(){
        $this->model = app($this->getModelClass());
    }

    // с помощью метода который реализуется в потомке (getModelClass) и является абстрактным
    abstract protected function getModelClass();

    //  с помощью метода startCondition мы получаем клонированную модель с которой работаем
    protected function startConditions(){

        return clone $this->model;

    }

}
