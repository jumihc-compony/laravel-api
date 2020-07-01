<?php
/**
 * User: YL
 * Date: 2020/07/01
 */

namespace Jmhc\Restful\Contracts;

/**
 * 版本模型
 * @package Jmhc\Restful\Contracts
 */
interface VersionModelInterface
{
    // 获取最新版本信息
    public function getLastInfo();
}
