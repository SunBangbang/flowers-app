<?php

//公共函数
//获取用户信息
function getlogin($name, $token) {

    if (empty($token) || empty($name)) {
        return false;
    }

    $User = M("user");

    $result = $User->where(" token =  '" . $token . "' and name = '" . $name . "'")->find();
    if (empty($result)) { //不存在说明该用户目前不是登陆状态 或者登录token 已修改
        return false;
    } else {
        return true;
    }
}
