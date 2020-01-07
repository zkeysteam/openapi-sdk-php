<?php
namespace Zkeys\OpenApi\demo;

use Zkeys\OpenApi\Auth;
use Zkeys\OpenApi\options\AuthOption;
use Zkeys\OpenApi\options\SmsOption;
use Zkeys\OpenApi\options\VerifyOption;
use Zkeys\OpenApi\options\VncOption;
use Zkeys\OpenApi\Sms;
use Zkeys\OpenApi\Verify;
use Zkeys\OpenApi\Vnc;

class Index
{
    /**
     * 获取 access_token
     *
     * 返回参数说明
     * 参数名          类型          说明
     * access_token    string    Access Token
     * expires_in       int        过期时间
     */
    public function getAccessToken()
    {
        $authOption = new AuthOption();
        $authOption->setSecretId('NuDbL3WsJzfFZR8y');// 设置Secret Id
        $authOption->setSecretKey('JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');// 设置Secret Key
        $auth = new Auth();

        $result = $auth->getToken($authOption);

        if (!$result) {
            echo $auth->getError();
        }

        // 由于以下示例中都有自动获取access_token动作，并将获取的access_token存储到缓存；
        // 如果单独获取access_token，以前的access_token将失效，这里需要删掉缓存，否则会提示认证失败
        $redis = new \Redis();
        $redis->connect('127.0.0.1', '6379');
        $redis->set('token_key', null);
        var_export($result);// 正常返回结果： array ( 'access_token' => '43a759e123477bc9ecbaa7b58ee6fa70', 'expires_in' => 7200 )
    }

    /**
     * 发送短信(短信模板方式)
     *
     * 返回参数说明
     * 参数名        类型        说明
     * fee_count     int        扣费条数
     * send_count    int        发送条数
     * biz_id        string     批次号
     */
    public function sendSms()
    {
        $accessToken = $this->publicGetAccessToken('NuDbL3WsJzfFZR8y', 'JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');

        $smsOption = new SmsOption();
        $smsOption->setAppId('09951617');// 设置appID
        $smsOption->setSecretKey('JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');// 设置Secret Key
        $smsOption->setAccessToken($accessToken);// 设置access_token
        $smsOption->setMmobiles('136****2035');// 设置手机号(多个用英文逗号隔开，或数组)
        $smsOption->setTplCode('SMS_1911132561');// 设置短信模板
        $smsOption->setTplParams(array());// 设置模板参数
        $smsOption->setSignName('testChengxueming');// 设置签名

        $sms = new Sms();

        $result = $sms->tplSend($smsOption);

        if (!$result) {
            echo $sms->getError();
        }

        var_export($result);// 正常返回结果：array ( 'fee_count' => 1, 'send_count' => 1, 'biz_id' => '20200107100742-c94a4d45-b1', )
    }

    /**
     * 发送短信(短信内容形式)
     *
     * 返回参数说明
     * 参数名        类型        说明
     * fee_count     int        扣费条数
     * send_count    int        发送条数
     * biz_id        string     批次号
     */
    public function sendContentSms()
    {
        $accessToken = $this->publicGetAccessToken('NuDbL3WsJzfFZR8y', 'JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');

        $smsOption = new SmsOption();
        $smsOption->setAppId('09951617');// 设置appID
        $smsOption->setSecretKey('JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');// 设置Secret Key
        $smsOption->setAccessToken($accessToken);// 设置access_token
        $smsOption->setMmobiles('136****2035');// 设置手机号(多个用英文逗号隔开，或数组)
        $smsOption->setType(1);// 设置短信类型(1、验证码/通知类 3、营销类)
        $smsOption->setSendContent('测试短信');// 设置短信内容
        $smsOption->setSignName('testChengxueming');// 设置签名

        $sms = new Sms();

        $result = $sms->contentSend($smsOption);

        if (!$result) {
            echo $sms->getError();
        }

        var_export($result);// 正常返回结果：array ( 'fee_count' => 1, 'send_count' => 1, 'biz_id' => '20200107135250-96849999-e5', )
    }

    /**
     * 查询短信发送情况
     *
     * 返回参数说明
     * 参数名    类型        说明
     * mobile    int        查询的号码
     * status    int        1发送成功 2发送失败
     */
    public function querySms()
    {
        $accessToken = $this->publicGetAccessToken('NuDbL3WsJzfFZR8y', 'JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');

        $smsOption = new SmsOption();
        $smsOption->setAppId('09951617');// 设置appID
        $smsOption->setSecretKey('JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');// 设置Secret Key
        $smsOption->setAccessToken($accessToken);// 设置access_token
        $smsOption->setMmobiles('136****2035');// 设置手机号(多个用英文逗号隔开，或数组)
        $smsOption->setBizId('20200107172523-fc74b466-80');// 设置查询时提交的批次号

        $sms = new Sms();

        $result = $sms->query($smsOption);

        if (!$result) {
            echo $sms->getError();
        }

        var_export($result);// 正常返回结果：array ( 0 => array ( 'mobile' => '136****2035', 'status' => 1, ))
    }

    /**
     * 实名认证3元素认证
     *
     * 返回参数说明
     * 参数名    类型        说明
     * msg        int        信息
     * result     int        0认证失败 1认证成功
     */
    public function verifyThree()
    {
        $accessToken = $this->publicGetAccessToken('NuDbL3WsJzfFZR8y', 'JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');

        $verifyOption = new VerifyOption();
        $verifyOption->setAppId('42678135');// 设置appID
        $verifyOption->setSecretKey('JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');// 设置Secret Key
        $verifyOption->setAccessToken($accessToken);// 设置access_token
        $verifyOption->setMobile('136****2035');// 设置手机号码
        $verifyOption->setRealName('王*小');// 设置真实姓名
        $verifyOption->setIdCard('352302********0328');// 设置身份证号码

        $verify = new Verify();

        $result = $verify->bankThreeParams($verifyOption);

        if (!$result) {
            echo $verify->getError();
        }

        var_export($result);// 正常返回结果：array ( 'result' => 1, 'msg' => '一致', )
    }

    /**
     * 实名认证4元素认证
     *
     * 返回参数说明
     * 参数名    类型        说明
     * msg       int        信息
     * result    int        0认证失败 1认证成功
     */
    public function verifyFour()
    {
        $accessToken = $this->publicGetAccessToken('NuDbL3WsJzfFZR8y', 'JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');

        $verifyOption = new VerifyOption();
        $verifyOption->setAppId('64811497');// 设置appID
        $verifyOption->setSecretKey('JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');// 设置Secret Key
        $verifyOption->setAccessToken($accessToken);// 设置access_token
        $verifyOption->setMobile('136****2035');// 设置手机号码
        $verifyOption->setRealName('王*小');// 设置真实姓名
        $verifyOption->setIdCard('352302********0328');// 设置身份证号码
        $verifyOption->setBankAccount('62226**********2444');// 设置银行卡

        $verify = new Verify();

        $result = $verify->bankFourParams($verifyOption);

        if (!$result) {
            echo $verify->getError();
        }

        var_export($result);// 正常返回结果：array ( 'result' => 1, 'msg' => '一致', )
    }

    /**
     * 获取VNC地址
     *
     * 返回参数说
     * 参数名    类型    说明
     * vnc_url    string    VNC URL地址
     * expired    int        失效时间，时间戳
     */
    public function getVncUrl()
    {
        $accessToken = $this->publicGetAccessToken('NuDbL3WsJzfFZR8y', 'JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');

        $vncOption = new VncOption();
        $vncOption->setAppId('64811497');// 设置appID
        $vncOption->setSecretKey('JvPuOlre5ZjA61x8hCyTP2zYvfJnKaRL');// 设置Secret Key
        $vncOption->setAccessToken($accessToken);// 设置access_token
        $vncOption->setIp('192.23.10.2');// 设置VNC服务器IP
        $vncOption->setPort('80');// 设置VNC服务器端口

        $vnc = new Vnc();

        $result = $vnc->getVncUrl($vncOption);

        if (!$result) {
            echo $vnc->getError();
        }

        var_export($result);// 正常返回结果：array ( 'vnc_url' => 'https://vnc.zkeys.com/index.php?vncToken=3fb070b05fea30ae410a3a6573e8b2c0&time=1578386462&token=5a325b96fcb19d3c7ff2c231b3da69b2&line=zkeys&lang=zh-cn', 'expired' => 1578386762, )
    }

    /**
     * 公共获取access_token
     * @param $secretId
     * @param $secretKey
     * @return mixed
     */
    public function publicGetAccessToken($secretId, $secretKey)
    {
        // 判断缓存中是否已经存在 access_token，如存在直接使用（缓存请根据情况自行选择，此处只做为示例使用）
        $redis = new \Redis();
        $redis->connect('127.0.0.1', '6379');
        if ($redis->get('token_key')) {
            $accessToken = $redis->get('token_key');
        } else {
            $authOption = new AuthOption();
            $authOption->setSecretId($secretId);// 设置Secret Id
            $authOption->setSecretKey($secretKey);// 设置Secret Key
            $auth = new Auth();

            $result = $auth->getToken($authOption);

            if (!$result) {
                $auth->getError();
                exit();
            }

            // 缓存存储 access_token ，过期时间预留60秒
            $redis->set('token_key', $result['access_token'], $result['expires_in'] - 60);
            $accessToken = $result['access_token'];
        }

        return $accessToken;
    }
}
