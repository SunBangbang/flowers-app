<?php

// 登录 注册

namespace Home\Controller;

use Think\Controller;

class SignupController extends Controller {

    public function index() {
        echo '';
    }

    //注册
    public function register() {
        if (empty($_POST['name']) || empty($_POST['password']) || empty($_POST['passwords'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '账号、密码、重复密码不能为空！'
            );
            $this->ajaxReturn($data);
        }
        if ($_POST['password'] != $_POST['passwords']) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '两次密码不一致！'
            );
            $this->ajaxReturn($data);
        }
        $param = array(
            'userName' => $_POST['name'],
            'password' => $_POST['password'],
            'ctime' => time(),
            'mtime' => time(),
            'token' => '',
            'avatar' => 'https://img2.baidu.com/it/u=289538718,2137491427&fm=26&fmt=auto',
            'nickName' => $_POST['nickName'],
            'age' => 0,
            'area' => '',
            'isLocked' => '',
            'score' => '',
            'gender' => '',
            'createdAt' => '',
            'birthday' => '',
            'updatedAt' => '',
        );

        $User = M("user"); // 实例化User对象
        $result = $User->where(" userName =  '" . $_POST['name'] . "'")->find();
        if (!empty($result)) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '该用户名已注册！'
            );
            $this->ajaxReturn($data);
        }
        //保存
        if ($User->add($param) == false) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '注册失败！'
            );
            $this->ajaxReturn($data);
        } else {
            $data = array(
                'status' => 1,
                'data' => '',
                'meg' => '注册成功！'
            );
            $this->ajaxReturn($data);
        }
    }

    //登录
    public function login() {

        if (empty($_POST['name']) || empty($_POST['password'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '账号、密码不能为空！'
            );
            $this->ajaxReturn($data);
        }

        $param = array(
            'name' => $_POST['name'],
            'password' => $_POST['password'],
        );

        $User = M("user");
        $result = $User->where(" userName =  '" . $_POST['name'] . "'")->find();
        if (empty($result)) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '用户名错误！'
            );
            $this->ajaxReturn($data);
        }
        if ($result['password'] != $_POST['password']) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '密码错误！'
            );
            $this->ajaxReturn($data);
        }
        $token = md5('liang_' . $result['id'] . time());
        $update['token'] = $token;
        $update['mtime'] = time();
        $User->where('id=' . $result['id'])->save($update); // 根据条件更新记录

        $data = array(
            'status' => 1,
            'data' => array(
                'token' => $token,
                'id' => $result['id'],
            ),
            'meg' => '登录成功！'
        );
        $this->ajaxReturn($data);
    }

    //登出
    public function logout() {
        if (empty($_POST['name'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '账号不能为空！'
            );
            $this->ajaxReturn($data);
        }
        $User = M("user");
        $result = $User->where(" name =  '" . $_POST['name'] . "'")->find();
        if (empty($result)) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '用户名错误！'
            );
            $this->ajaxReturn($data);
        }
        $update['token'] = '';
        $update['mtime'] = time();
        $User->where('id=' . $result['id'])->save($update); // 根据条件更新记录

        $data = array(
            'status' => 1,
            'data' => array(
                'token' => '',
            ),
            'meg' => '登出成功！'
        );
        $this->ajaxReturn($data);
    }

    //个人信息
    public function userinfo() {
        //$_POST['id'] = $_GET["id"];
        $_POST['token'] = $_SERVER['HTTP_TOKEN'];
        //$_POST['token'] = $_GET["token"];
        if (empty($_POST['id']) || empty($_POST['token'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'id,token参数不能为空！'
            );
            $this->ajaxReturn($data);
        }

        $User = M("user"); // 实例化User对象
        $result = $User->where(" id =  '" . $_POST['id'] . "'")->find();
        if (empty($result)) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '不存在该用户！'
            );
            $this->ajaxReturn($data);
        }
        //判断登录是否过期
        if ($_POST['token'] != $result['token']) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '登录已过期，请重新登录！'
            );
            $this->ajaxReturn($data);
        }

        $data = array(
            'status' => 1,
            'data' => $result,
            'meg' => '获取成功！'
        );
        $this->ajaxReturn($data);
    }

}
