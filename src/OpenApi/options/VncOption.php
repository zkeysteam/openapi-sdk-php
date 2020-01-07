<?php
/**
 * @link      https://www.niaoyun.com/
 * @copyright Copyright © 2020 NiaoYun.com. All Rights Reserved. 小鸟云 版权所有
 * User: smallfly
 * Date: 2020/1/7
 * Time: 15:48
 */
namespace Zkeys\OpenApi\options;
class VncOption extends BaseOption
{
    // VNC服务器IP
    private $ip = '';

    // VNC服务器端口
    private $port = '';

    /**
     * 设置VNC服务器IP
     * @param $ip
     * @return $this
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * 设置VNC服务器端口
     * @param $port
     * @return $this
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * 获取VNC服务器IP
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * 获取VNC服务器端口
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }
}