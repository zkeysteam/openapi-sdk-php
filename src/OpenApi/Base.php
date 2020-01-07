<?php
/**
 * @link      https://www.niaoyun.com/
 * @copyright Copyright © 2020 NiaoYun.com. All Rights Reserved. 小鸟云 版权所有
 * User: smallfly
 * Date: 2020/1/6
 * Time: 15:10
 */
namespace Zkeys\OpenApi;
class Base
{
    // 接口请求连接
    const AUTH_URL = 'https://local_api.zkeys.com/';

    const GATEWAY = 'gateway.do';

    const GETTOKEN = 'get_token';

    // 错误信息
    protected $error;

    // 错误代码
    protected $code;

    /**
     * 解析接口返回数据
     * @param $data
     * @return bool
     */
    protected function analysis($data)
    {
        if ($data['Code'] == 'Success') {
            return $data['Data'];
        } else {
            $this->error = isset($data['Data'][0]) ? $data['Data'][0] : $data['Message'];
            $this->code  = isset($data['Code']) ? $data['Code'] : '';

            return false;
        }
    }

    /**
     * 查询参数排序 a-z
     * @param $query
     * @return string|null
     */
    protected function buildQuery($query)
    {
        if (!$query) {
            return null;
        }

        //将要 参数 排序
        ksort($query);

        //重新组装参数
        $params = array();
        foreach ($query as $key => $value) {
            $params[] = $key . '=' . $value;
        }
        $data = implode('&', $params);

        return $data;
    }

    /**
     * 获取签名
     * @param $str
     * @param $secretKey
     * @return string
     */
    protected function getSign($str, $secretKey)
    {
        return md5($str . "&secret=" . $secretKey);
    }

    /**
     * 获取错误信息
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * 获取错误代码
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * 处理返回结果
     * @param $result
     * @return bool
     */
    protected function handleResult($result)
    {
        $data = @json_decode($result, true);

        if ($result && $data) {
            return $this->analysis($data);
        } else {
            if (empty($secretKey)) {
                $this->error = '请求接口错误';

                return false;
            }
        }
    }
}