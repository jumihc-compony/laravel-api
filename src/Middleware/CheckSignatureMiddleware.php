<?php
/**
 * User: YL
 * Date: 2020/07/01
 */

namespace Jmhc\Restful\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jmhc\Restful\Contracts\RequestParamsInterface;
use Jmhc\Restful\Exceptions\ResultException;
use Jmhc\Restful\Traits\ResultThrowTrait;
use Jmhc\Restful\Utils\Signature;
use Jmhc\Support\Traits\RedisHandlerTrait;
use Jmhc\Support\Utils\Log;

/**
 * 检测签名中间件
 * @package Jmhc\Restful\Middleware
 */
class CheckSignatureMiddleware
{
    use RedisHandlerTrait;
    use ResultThrowTrait;

    public function handle(Request $request, Closure $next)
    {
        if (! config('jmhc-api.signature.check')) {
            return $next($request);
        }

        // 读取配置
        $timeout = config('jmhc-api.signature.timestamp_timeout', 60);
        $checkTimestamp = config('jmhc-api.signature.check_timestamp', true);

        // 判断时间戳是否超时
        $timestamp = $request->originParams['timestamp'] ?? 0;
        $time = time();
        $this->validateTimestamp($checkTimestamp, $time, $timestamp, $timeout);

        // 判断随机数是否有效
        $nonce = $request->originParams['nonce'] ?? '';
        $this->validateNonce($nonce, $timestamp, $timeout);

        // 验证签名是否正确
        $sign = $request->originParams['sign'] ?? '';
        $data = app()->get(RequestParamsInterface::class)->toArray();
        $data['timestamp'] = $timestamp;
        $data['nonce'] = $nonce;
        $key = config('jmhc-api.signature.key', '');
        if (! Signature::verify($sign, $data, $key)) {
            // 签名验证失败记录
            Log::save(
                'signature.error',
                $this->getSignatureErrorMsg($request, $sign, $data, $key)
            );
            $this->error('签名验证失败~');
        }

        return $next($request);
    }

    /**
     * 验证时间戳
     * @param bool $checkTimestamp
     * @param int $time
     * @param int $timestamp
     * @param int $timeout
     * @throws ResultException
     */
    protected function validateTimestamp(bool $checkTimestamp, int $time, int $timestamp, int $timeout)
    {
        if (! $checkTimestamp) {
            return;
        }

        if ($timestamp > ($time + $timeout)) {
            $this->error('请求时间过大~');
        }

        if (($timestamp + $timeout) < $time) {
            $this->error('请求已过期~');
        }
    }

    /**
     * 验证随机数
     * @param string $nonce
     * @param int $timestamp
     * @param int $timeout
     * @throws ResultException
     */
    protected function validateNonce(string $nonce, int $timestamp, int $timeout)
    {
        if (empty($nonce)) {
            $this->error('请求随机数不存在~');
        }

        // 保存的随机数
        $nonce .= $timestamp;

        // redis操作句柄
        $handler = $this->getPhpRedisHandler();
        // 缓存标识
        $cacheKey = 'nonce-list-' . $timeout;

        // 获取已缓存随机数列表
        $list = $handler->lrange($cacheKey, 0, -1);
        if (in_array($nonce, $list)) {
            $this->error('请求随机数已存在~');
        }

        // 添加随机数
        $handler->lpush($cacheKey, $nonce);

        // 设置过期时间
        if ($handler->ttl($cacheKey) == -1) {
            $handler->expire($cacheKey, $timeout);
        }
    }

    /**
     * 获取签名错误消息
     * @param Request $request
     * @param string $sign
     * @param array $data
     * @param string $key
     * @return string
     */
    protected function getSignatureErrorMsg(Request $request, string $sign, array $data, string $key)
    {
        // 签名数据
        $signData = Signature::sign($data, $key, false);
        $origin = json_encode($signData['origin'], JSON_UNESCAPED_UNICODE);
        $sort = json_encode($signData['sort'], JSON_UNESCAPED_UNICODE);

        return <<<EOL
ip: {$request->ip()}
url: {$request->fullUrl()}
method: {$request->method()}
源数据: {$origin}
排序后数据: {$sort}
构造签名字符串: {$signData['build']}
待签名数据: {$signData['wait_str']}
签名结果: {$signData['sign']}
请求签名: {$sign}
EOL;
    }
}
