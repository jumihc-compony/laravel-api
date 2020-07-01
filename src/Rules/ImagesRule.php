<?php
/**
 * User: YL
 * Date: 2020/07/01
 */

namespace Jmhc\Restful\Rules;

use Illuminate\Contracts\Validation\Rule;
use Jmhc\Support\Traits\InstanceTrait;

/**
 * 图片后缀验证规则
 * @package Jmhc\Restful\Rules
 */
class ImagesRule implements Rule
{
    use InstanceTrait;

    protected $images = ['jpeg', 'jpg', 'png', 'bmp', 'gif', 'svg', 'webp'];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $images = array_filter(explode(',', $value));
        if (empty($images)) {
            return false;
        }

        foreach ($images as $v) {
            if (! in_array(pathinfo($v, PATHINFO_EXTENSION), $this->images)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.images');
    }
}
