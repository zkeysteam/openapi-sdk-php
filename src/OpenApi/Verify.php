<?php
/**
 * @link      https://www.niaoyun.com/
 * @copyright Copyright © 2020 NiaoYun.com. All Rights Reserved. 小鸟云 版权所有
 * User: smallfly
 * Date: 2020/1/7
 * Time: 14:28
 */
namespace Zkeys\OpenApi;

use Zkeys\OpenApi\helps\CurlHelper;
use Zkeys\OpenApi\options\VerifyOption;

class Verify extends Base
{
    const THREE_ELEMENT = 'cloud.verify.by3element';

    const FOUR_ELEMENT = 'cloud.verify.by4element';

    /**
     * 实名认证3元素
     * @param VerifyOption $verifyOption
     * @return bool
     */
    public function bankThreeParams(VerifyOption $verifyOption)
    {
        $bizContent = [
            'mobile'    => $verifyOption->getMobile(),
            'real_name' => $verifyOption->getRealName(),
            'id_card'   => $verifyOption->getIdCard(),
        ];

        $accessToken = $verifyOption->getAccessToken();
        if (empty($accessToken)) {
            $this->error = 'access_token 不能为空';

            return false;
        }

        $data         = [
            'app_id'       => $verifyOption->getAppId(),
            'access_token' => $accessToken,
            'method'       => self::THREE_ELEMENT,
            'sign_type'    => 'md5',
            'version'      => 'v201903',
            'biz_content'  => json_encode($bizContent),
            'timestamp'    => time(),
        ];
        $str          = $this->buildQuery($data);
        $data['sign'] = $this->getSign($str, $verifyOption->getSecretKey());

        $result = CurlHelper::post(self::AUTH_URL . self::GATEWAY, $data);

        return $this->handleResult($result);
    }

    /**
     * 实名认证4元素
     * @param VerifyOption $verifyOption
     * @return bool
     */
    public function bankFourParams(VerifyOption $verifyOption)
    {
        $bizContent = [
            'mobile'       => $verifyOption->getMobile(),
            'real_name'    => $verifyOption->getRealName(),
            'id_card'      => $verifyOption->getIdCard(),
            'bank_account' => $verifyOption->getBankAccount(),
        ];

        $accessToken = $verifyOption->getAccessToken();
        if (empty($accessToken)) {
            $this->error = 'access_token 不能为空';

            return false;
        }

        $data         = [
            'app_id'       => $verifyOption->getAppId(),
            'access_token' => $accessToken,
            'method'       => self::FOUR_ELEMENT,
            'sign_type'    => 'md5',
            'version'      => 'v201903',
            'biz_content'  => json_encode($bizContent),
            'timestamp'    => time(),
        ];
        $str          = $this->buildQuery($data);
        $data['sign'] = $this->getSign($str, $verifyOption->getSecretKey());

        $result = CurlHelper::post(self::AUTH_URL . self::GATEWAY, $data);

        return $this->handleResult($result);
    }
}