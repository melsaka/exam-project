<?php

function create($model, $count = 1, $attributes = [])
{
    $factory = initFactory($model, $count);

    return $factory->create($attributes);
}

function make($model, $count = 1, $attributes = [])
{
    $factory = initFactory($model, $count);

    return $factory->make($attributes);
}

function initFactory($model, $count)
{
    $factory = $model::factory();

    return $count > 1 ? $factory->count($count) : $factory;
}
