<?php
/**
 * User: YL
 * Date: 2020/07/01
 */

namespace Jmhc\Restful\Contracts;

/**
 * 常用常量属性
 * @package Jmhc\Restful\Contracts
 */
interface ConstAttributeInterface
{
    const YES = 1;
    const NO = 0;

    const DEFAULT_OFFSET    = 0;
    const DEFAULT_LIMIT     = 10;
    const DEFAULT_PAGE      = 1;
    const DEFAULT_PAGE_SIZE = 10;
    const DEFAULT_DIRECTION = 'asc';

    const BOOLEAN_TEXTS = ['否', '是'];
}
