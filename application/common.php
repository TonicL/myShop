<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

if (!function_exists('encrypt_password')){
    function encrypt_password($password){
        $salt='~~~ILOVEPM20120403~~~';
        return md5(md5($password).$salt);
    }
}
if (!function_exists('getTree')) {
    function getTree($list, $pid = 0, $level = 0)
    {
        static $tree = [];
        foreach ($list as $row) {
            if ($row['pid'] == $pid) {
                $row['level'] = $level;
                $tree[] = $row;
                getTree($list, $row['id'], $level + 1);
            }
        }
        return $tree;
    }
}



if (!function_exists('send_email')) {
    //使用PHPMailer发送邮件
    function send_email($email, $subject, $body){
        //实例化PHPMailer类  不传参数（如果传true，表示发生错误时抛异常）
        $mail = new \PHPMailer\PHPMailer\PHPMailer();
//        $mail->SMTPDebug = 2;                                 // 调试时，开启过程中的输出
        $mail->isSMTP();                                      // 设置使用SMTP服务
        $mail->Host = config('email.host');                 // 设置邮件服务器的地址
        $mail->SMTPAuth = true;                               // 开启SMTP认证
        $mail->Username = config('email.email');                 // 设置邮箱账号
        $mail->Password = config('email.password');            // 设置密码（授权码）
        $mail->SMTPSecure = 'tls';                            //设置加密方式 tls   ssl
        $mail->Port = 25;                                    // 邮件发送端口
        $mail->CharSet = 'utf-8';                           //设置字符编码
        //Recipients
        $mail->setFrom(config('email.email'));//发件人
        $mail->addAddress($email);     // 收件人
//        $mail->addReplyTo('info@example.com', 'Information'); //添加回复人
//        $mail->addCC('cc@example.com');   //添加抄送人
//        $mail->addBCC('bcc@example.com'); //添加密送人

        //Attachments 添加附件
//        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // 设置邮件内容为html格式
        $mail->Subject = $subject; //主题
        $mail->Body    = $body;//邮件正文
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if ($mail->send()) {
            return true;
        }
        return $mail->ErrorInfo;
//        $mail->ErrorInfo
    }
}

    if (!function_exists('curl_request')) {
        //使用curl函数库发送请求
        function curl_request($url, $post = false, $params = [], $https = false)
        {
            //使用curl_init初始化会话请求
            $ch = curl_init($url);
            //使用curl_setopt函数设置一些请求选项
            if ($post) {
                //post 请求 需要设置请求方式、请求参数
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            }
            if ($https) {
                //禁止从服务器验证本地证书
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            }
            //使用curl_exec发送请求
            //将执行的结果数据直接返回。
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $res = curl_exec($ch);
            //关闭请求会话
            curl_close($ch);
            return $res;
        }
    }

    if (!function_exists('sendmsg')) {
        function sendmsg($phone, $msg)
        {
            //从配置文件读取接口信息
            $gateway = config('msg.gateway');
            $appkey = config('msg.appkey');
            //准备请求地址
            $url = $gateway . "?appkey=" . $appkey . "&mobile=" . $phone . "&content=" . $msg;
            //发送请求 比如get方式  https请求
            $res = curl_request($url, false, [], true);

            if (!$res) {
                return "请求发送失败";
            }
            //请求发送成功，返回值json格式字符串
            $arr = json_decode($res, true);
            if ($arr['code'] == 10000) {
                return true;
            }
            return $arr['msg'];
        }
    }

    if (!function_exists('encrypt_phone')) {
        //加密手机号
        function encrypt_phone($phone)
        {
            return substr($phone, 0, 3) . '****' . substr($phone, 7);
        }
    }
