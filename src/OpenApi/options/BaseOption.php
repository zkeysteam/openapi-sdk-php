<?php
/**
 * @link      https://www.niaoyun.com/
 * @copyright Copyright © 2020 NiaoYun.com. All Rights Reserved. 小鸟云 版权所有
 * User: smallfly
 * Date: 2020/1/7
 * Time: 14:41
 */
namespace Zkeys\OpenApi\options;
class BaseOption
{
    // appID
    private $appId = '';

    // Secret Id
    private $secretId = '';

    // Secret Key
    private $secretKey = '';

    // access_token
    private $accessToken = '';

    // 签名
    private $signName = '';

    /**
     * 设置appID
     * @param $appID
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;

        return $this;
    }

    /**
     * 设置Secret Id
     * @param $secretId
     * @return $this
     */
    public function setSecretId($secretId)
    {
        $this->secretId = $secretId;

        return $this;
    }

    /**
     * 设置Secret Key
     * @param $secretKey
     * @return $this
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;

        return $this;
    }

    /**
     * 设置access_token
     * @param $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * 设置签名
     * @param $signName
     * @return $this
     */
    public function setSignName($signName)
    {
        $this->signName = $signName;

        return $this;
    }

    /**
     * 获取appID
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * 获取Secret Id
     * @return mixed
     */
    public function getSecretId()
    {
        return $this->secretId;
    }

    /**
     * 获取Secret Key
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * 获取access_token
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * 获取签名
     * @return mixed
     */
    public function getSignName()
    {
        return $this->signName;
    }
}