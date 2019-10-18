<?php
/**
 * User: YL
 * Date: 2019/10/17
 */

namespace Jmhc\Restful\Contracts;

interface ConstAttribute
{
    const YES = 1;
    const NO = 0;

    const DEFAULT_OFFSET    = 0;
    const DEFAULT_LIMIT     = 10;
    const DEFAULT_PAGE      = 1;
    const DEFAULT_PAGE_SIZE = 10;
    const DEFAULT_DIRECTION = 'asc';
}
