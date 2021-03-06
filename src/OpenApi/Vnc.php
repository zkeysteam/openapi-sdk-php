<?php

namespace Zkeys\OpenApi;

use Zkeys\OpenApi\helps\CurlHelper;
use Zkeys\OpenApi\options\VncOption;

class Vnc extends Base
{
    const VNC = 'cloud.vnc.get';

    /**
     * 获取VNC地址
     *
     * @param VncOption $vncOption
     *
     * @return bool
     */
    public function getVncUrl(VncOption $vncOption)
    {
        $bizContent = array(
            'ip'   => $vncOption->getIp(),
            'port' => $vncOption->getPort(),
            'lang' => 'zh-cn',
        );

        $accessToken = $vncOption->getAccessToken();
        if (empty($accessToken)) {
            $this->error = 'access_token 不能为空';

            return false;
        }

        $data         = array(
            'app_id'       => $vncOption->getAppId(),
            'access_token' => $accessToken,
            'method'       => self::VNC,
            'sign_type'    => 'md5',
            'version'      => 'v201903',
            'biz_content'  => json_encode($bizContent),
            'timestamp'    => time(),
        );
        $str          = $this->buildQuery($data);
        $data['sign'] = $this->getSign($str, $vncOption->getSecretKey());

        $result = CurlHelper::post(self::AUTH_URL . self::GATEWAY, $data);

        return $this->handleResult($result);
    }
}