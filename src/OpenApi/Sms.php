<?php

namespace Zkeys\OpenApi;

use Zkeys\OpenApi\helps\CurlHelper;
use Zkeys\OpenApi\options\SmsOption;

class Sms extends Base
{
    const SENDER   = 'cloud.sms.sender';
    const SCONTENT = 'cloud.sms.content';
    const SQUERY   = 'cloud.sms.query';

    /**
     * 发送短信(短信模板形式)
     *
     * @param SmsOption $smsOption
     *
     * @return array|bool|mixed
     */
    public function tplSend(SmsOption $smsOption)
    {
        $bizContent = array(
            'mobiles'    => $smsOption->getMmobiles(),
            'tpl_code'   => $smsOption->getTplCode(),
            'tpl_params' => $smsOption->getTplParams(),
            'sign_name'  => $smsOption->getSignName(),
        );

        $accessToken = $smsOption->getAccessToken();
        if (empty($accessToken)) {
            $this->error = 'access_token 不能为空';

            return false;
        }

        $data         = array(
            'app_id'       => $smsOption->getAppId(),
            'access_token' => $accessToken,
            'method'       => self::SENDER,
            'sign_type'    => 'md5',
            'version'      => 'v201903',
            'biz_content'  => json_encode($bizContent),
            'timestamp'    => time(),
        );
        $str          = $this->buildQuery($data);
        $data['sign'] = $this->getSign($str, $smsOption->getSecretKey());

        $result = CurlHelper::post(self::AUTH_URL . self::GATEWAY, $data);

        return $this->handleResult($result);
    }

    /**
     * 发送短信(短信内容形式)
     *
     * @param SmsOption $smsOption
     *
     * @return bool
     */
    public function contentSend(SmsOption $smsOption)
    {
        $bizContent = array(
            'mobiles'      => $smsOption->getMmobiles(),
            'type'         => $smsOption->getType(),
            'send_content' => $smsOption->getSendContent(),
            'sign_name'    => $smsOption->getSignName(),
        );

        $accessToken = $smsOption->getAccessToken();
        if (empty($accessToken)) {
            $this->error = 'access_token 不能为空';

            return false;
        }

        $data         = array(
            'app_id'       => $smsOption->getAppId(),
            'access_token' => $accessToken,
            'method'       => self::SCONTENT,
            'sign_type'    => 'md5',
            'version'      => 'v201903',
            'biz_content'  => json_encode($bizContent),
            'timestamp'    => time(),
        );
        $str          = $this->buildQuery($data);
        $data['sign'] = $this->getSign($str, $smsOption->getSecretKey());

        $result = CurlHelper::post(self::AUTH_URL . self::GATEWAY, $data);

        return $this->handleResult($result);
    }

    /**
     * 查询短信发送情况
     *
     * @param SmsOption $smsOption
     *
     * @return bool
     */
    public function query(SmsOption $smsOption)
    {
        $bizContent = array(
            'mobiles' => $smsOption->getMmobiles(),
            'biz_id'  => $smsOption->getBizId(),
        );

        $accessToken = $smsOption->getAccessToken();
        if (empty($accessToken)) {
            $this->error = 'access_token 不能为空';

            return false;
        }

        $data         = array(
            'app_id'       => $smsOption->getAppId(),
            'access_token' => $accessToken,
            'method'       => self::SQUERY,
            'sign_type'    => 'md5',
            'version'      => 'v201903',
            'biz_content'  => json_encode($bizContent),
            'timestamp'    => time(),
        );
        $str          = $this->buildQuery($data);
        $data['sign'] = $this->getSign($str, $smsOption->getSecretKey());

        $result = CurlHelper::post(self::AUTH_URL . self::GATEWAY, $data);

        return $this->handleResult($result);
    }
}