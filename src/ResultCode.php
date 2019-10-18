<?php
/**
 * User: YL
 * Date: 2019/10/16
 */

namespace Jmhc\Restful;

class ResultCode
{
    const HTTP_SUCCESS_CODE        = 200;
    const HTTP_ERROR_CODE          = 200;

    const SUCCESS                 = 2000;
    const NO_DATA                 = 2001;
    const MAINTENANCE             = 3000;
    const ERROR                   = 4000;
    const SDL                     = 4001;
    const TOKEN_NO_EXISTS         = 4002;
    const TOKEN_INVALID           = 4003;
    const TOKEN_EXPIRE            = 4004;
    const PROHIBIT_LOGIN          = 4005;
    const SYS_EXCEPTION           = 5000;
    const SYS_ERROR               = 5001;
    const OLD_VERSION             = 6000;
}
