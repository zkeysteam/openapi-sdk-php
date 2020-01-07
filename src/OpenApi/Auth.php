<?php

namespace Zkeys\OpenApi;

use Zkeys\OpenApi\helps\CurlHelper;
use Zkeys\OpenApi\options\AuthOption;

class Auth extends Base
{
    /**
     * 获取 access_token
     *
     * @param AuthOption $auth
     *
     * @return bool
     */
    public function getToken(AuthOption $authOption)
    {
        $secretId = $authOption->getSecretId();
        if (empty($secretId)) {
            $this->error = 'Secret Id不能为空';

            return false;
        }

        $secretKey = $authOption->getSecretKey();
        if (empty($secretKey)) {
            $this->error = 'Secret Key不能为空';

            return false;
        }

        $result = CurlHelper::post(self::AUTH_URL . self::GETTOKEN, array(
            'secret_id'  => $secretId,
            'secret_key' => $secretKey,
        ));

        return $this->handleResult($result);
    }
}