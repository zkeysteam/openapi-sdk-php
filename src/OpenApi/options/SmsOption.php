<?php
/**
 * @link      https://www.niaoyun.com/
 * @copyright Copyright © 2020 NiaoYun.com. All Rights Reserved. 小鸟云 版权所有
 * User: smallfly
 * Date: 2020/1/6
 * Time: 15:10
 */
namespace Zkeys\OpenApi\options;
class SmsOption extends BaseOption
{
    // 手机号码(用英文逗号隔开)
    private $mobiles = '';

    // 短信模板
    private $tplCode = '';

    // 模板参数(数组信息)
    private $tplParams = [];

    // 短信类型 1、验证码/通知类 3、营销类
    private $type = '';

    // 短信内容（不带签名的字符串）
    private $sendContent = '';

    // 查询时提交的批次号
    private $bizId = '';

    /**
     * 设置手机号
     * @param $mobiles
     * @return $this
     */
    public function setMmobiles($mobiles)
    {
        $this->mobiles = is_array($mobiles) ? implode(',', $mobiles) : $mobiles;

        return $this;
    }

    /**
     * 设置短信模板
     * @param $tplCode
     * @return $this
     */
    public function setTplCode($tplCode)
    {
        $this->tplCode = $tplCode;

        return $this;
    }

    /**
     * 设置模板参数
     * @param $tplParams
     * @return $this
     */
    public function setTplParams($tplParams)
    {
        $this->tplParams = $tplParams;

        return $this;
    }

    /**
     * 设置短信类型
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * 设置短信内容
     * @param $sendContent
     * @return $this
     */
    public function setSendContent($sendContent)
    {
        $this->sendContent = $sendContent;

        return $this;
    }

    /**
     * 设置查询时提交的批次号
     * @param $bizId
     * @return $this
     */
    public function setBizId($bizId)
    {
        $this->bizId = $bizId;

        return $this;
    }


    /**
     * 获取手机号
     * @return mixed
     */
    public function getMmobiles()
    {
        return $this->mobiles;
    }

    /**
     * 获取短信模板
     * @return mixed
     */
    public function getTplCode()
    {
        return $this->tplCode;
    }

    /**
     * 获取模板参数
     * @return mixed
     */
    public function getTplParams()
    {
        return $this->tplParams;
    }

    /**
     * 获取短信类型
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * 获取短信内容
     * @return mixed
     */
    public function getSendContent()
    {
        return $this->sendContent;
    }

    /**
     * 获取查询时提交的批次号
     * @return string
     */
    public function getBizId()
    {
        return $this->bizId;
    }
}