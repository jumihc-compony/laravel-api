<?php
/**
 * User: YL
 * Date: 2019/10/17
 */

namespace Jmhc\Restful\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Jmhc\Restful\Traits\InstanceTrait;

/**
 * 主键倒序作用域
 * @package Jmhc\Restful\Scopes
 */
class PrimaryKeyDescScope implements Scope
{
    use InstanceTrait;

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderByDesc($model->getKeyName());
    }
}
