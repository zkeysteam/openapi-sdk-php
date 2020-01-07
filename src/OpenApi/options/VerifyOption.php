<?php

namespace Zkeys\OpenApi\options;

class VerifyOption extends BaseOption
{
    // 手机号码
    private $mobile = '';

    // 真实姓名
    private $realName = '';

    // 身份证号码
    private $idCard = '';

    // 银行卡
    private $bankAccount = '';

    /**
     * 设置手机号码
     *
     * @param $mobile
     *
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * 设置真实姓名
     *
     * @param $realName
     *
     * @return $this
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;

        return $this;
    }

    /**
     * 设置身份证号码
     *
     * @param $idCard
     *
     * @return $this
     */
    public function setIdCard($idCard)
    {
        $this->idCard = $idCard;

        return $this;
    }

    /**
     * 设置银行卡
     *
     * @param $bankAccount
     *
     * @return $this
     */
    public function setBankAccount($bankAccount)
    {
        $this->bankAccount = $bankAccount;

        return $this;
    }


    /**
     * 获取手机号码
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * 获取真实姓名
     * @return string
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * 获取身份证号码
     * @return string
     */
    public function getIdCard()
    {
        return $this->idCard;
    }

    /**
     * 获取银行卡
     * @return string
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }
}