<?php
/*
 * The MIT License (MIT)
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace AppBundle\Service;

use Redis;

/**
 * Class RedisService
 * @package AppBundle\Service
 */
class RedisService
{
    /**
     * @var Redis
     */
    private $redis;

    /**
     * RedisService constructor.
     * @param Redis $redis
     */
    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
        $this->redis->connect("redis");

        //var_dump($redis);exit;
        //exit;

        //if($this->connect("redis") === true) {
        //    throw new RedisServiceException("dammm");
        //}
    }

    /**
     * @param null $option
     * @return string
     */
    public function info($option = null)
    {
        return is_null($option) ? $this->redis->info() : $this->redis->info($option);
    }

    public function ping() : string
    {
        return $this->redis->ping();
    }

    /**
     * @param string $key
     * @param int $ttl
     * @param string $value
     * @return bool
     */
    public function setx(string $key, int $ttl, string $value) : bool
    {
        return $this->redis->setex($key, $ttl, $value);
    }

    /**
     * @param string $pattern
     * @return array
     */
    public function keys(string $pattern) : array
    {
        return $this->redis->keys($pattern);
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->redis->close();
    }
}
