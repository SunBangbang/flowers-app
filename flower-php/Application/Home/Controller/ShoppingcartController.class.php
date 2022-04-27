<?php

// 购物车

namespace Home\Controller;

use Think\Controller;

class ShoppingcartController extends Controller {

    public function index() {
        echo '';
    }

    //加入购物车
    public function add() {
        //$_POST['uid'] = $_GET['uid'];
        //$_POST['token'] = $_GET["token"];
        //$_POST['goods_id'] = $_GET["goods_id"];
        //$_POST['counts'] = $_GET["counts"];
        $_POST['token'] = $_SERVER['HTTP_TOKEN'];


        if (empty($_POST['uid']) || empty($_POST['token'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'uid,token参数不能为空！'
            );
            $this->ajaxReturn($data);
        }

        $User = M("user"); // 实例化User对象
        $result = $User->where(" id =  '" . $_POST['uid'] . "'")->find();
        if (empty($result)) {
            $data = array(
                'status' => 2,
                'data' => '',
                'meg' => '不存在该用户！'
            );
            $this->ajaxReturn($data);
        }
        //判断登录是否过期
        if ($_POST['token'] != $result['token']) {
            $data = array(
                'status' => 2,
                'data' => '',
                'meg' => '登录已过期，请重新登录！'
            );
            $this->ajaxReturn($data);
        }

        $goods = M("goods"); // 实例化User对象
        $goods_result = $goods->where(" id =  '" . $_POST['goods_id'] . "'")->find();
        if (empty($goods_result)) {

            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '商品不存在！'
            );
            $this->ajaxReturn($data);
        }
        if ($goods_result['counts'] < $_POST['counts']) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '商品数量不够！'
            );
            $this->ajaxReturn($data);
        }

        $cart = M("shoppingcart"); // 实例化User对象
        $cart_result = $cart->where(" goods_id =  '" . $_POST['goods_id'] . "' and uid = " . $_POST['uid'])->find();
        if (!empty($cart_result)) {
            //修改累加 
            $datas['counts'] = $cart_result['counts'] + $_POST['counts'];
            $datas['mtime'] = time();
            $goods_data['counts'] = $goods_result['counts'] - $_POST['counts'];
            $goods_data['mtime'] = time();
            $cart->where('id=' . $cart_result['id'])->save($datas); // 根据条件更新记录
            $goods->where('id=' . $goods_result['id'])->save($goods_data); // 根据条件更新记录
            $data = array(
                'status' => 1,
                'data' => '',
                'meg' => '添加成功！'
            );
            $this->ajaxReturn($data);
        }
        $param = array(
            'goods_id' => $_POST['goods_id'],
            'counts' => $_POST['counts'],
            'ctime' => time(),
            'mtime' => time(),
            'uid' => $_POST['uid'],
        );

        //保存
        if ($cart->add($param) == false) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '添加失败！'
            );
            $this->ajaxReturn($data);
        } else {
            $goods_data['counts'] = $goods_result['counts'] - $_POST['counts'];
            $goods_data['mtime'] = time();
            $goods->where('id=' . $goods_result['id'])->save($goods_data); // 根据条件更新记录
            $data = array(
                'status' => 1,
                'data' => '',
                'meg' => '添加成功！'
            );
            $this->ajaxReturn($data);
        }
    }

    //购物车列表

    public function cartlist() {
        //$_POST['uid'] = $_GET['uid'];
        //$_POST['token'] = $_GET["token"];
        $_POST['token'] = $_SERVER['HTTP_TOKEN'];
        if (empty($_POST['uid']) || empty($_POST['token'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'uid,token参数不能为空！'
            );
            $this->ajaxReturn($data);
        }

        $User = M("user"); // 实例化User对象
        $result = $User->where(" id =  '" . $_POST['uid'] . "'")->find();
        if (empty($result)) {
            $data = array(
                'status' => 2,
                'data' => '',
                'meg' => '不存在该用户！'
            );
            $this->ajaxReturn($data);
        }
        //判断登录是否过期
        if ($_POST['token'] != $result['token']) {
            $data = array(
                'status' => 2,
                'data' => '',
                'meg' => '登录已过期，请重新登录！'
            );
            $this->ajaxReturn($data);
        }

        $cart = M("shoppingcart"); // 实例化User对象
        $cart_result = $cart->where("uid = " . $_POST['uid'])->select();
        //$cart_info = array();
        $Goods = M("goods");
        $g_imgs = M("goodsimg");
        $g_type = M("goodstype");
        if (!empty($cart_result)) {
            foreach ($cart_result as $k => $v) {

                $goods_infos = $Goods->where('id = ' . $v['goods_id'])->find();
                $cart_result[$k]['goodsinfo'] = $goods_infos;
                $cart_result[$k]['imgs'] = $g_imgs->where('goods_id = ' . $v['goods_id'])->field('img_url')->select();
                $cart_result[$k]['type_info'] = $g_type->where('id = ' . $goods_infos['type'])->select();
            }
        }
        $data = array(
            'status' => 1,
            'data' => $cart_result,
            'meg' => '获取成功！'
        );
        $this->ajaxReturn($data);
    }

    //删除购物车
    public function delcart() {
        //$_POST['uid'] = $_GET['uid'];
        //$_POST['token'] = $_GET["token"];
        //$_POST['cart_id'] = $_GET["cart_id"];
        $_POST['token'] = $_SERVER['HTTP_TOKEN'];
        if (empty($_POST['uid']) || empty($_POST['token']) || empty($_POST['cart_id'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'uid,token,cart_id参数不能为空！'
            );
            $this->ajaxReturn($data);
        }

        $User = M("user"); // 实例化User对象
        $user_info = $User->where(" id =  '" . $_POST['uid'] . "'")->find();
        if (empty($user_info)) {
            $data = array(
                'status' => 2,
                'data' => '',
                'meg' => '不存在该用户！'
            );
            $this->ajaxReturn($data);
        }
        //判断登录是否过期
        if ($_POST['token'] != $user_info['token']) {
            $data = array(
                'status' => 2,
                'data' => '',
                'meg' => '登录已过期，请重新登录！'
            );
            $this->ajaxReturn($data);
        }


        $order = M("shoppingcart"); // 购物车
        $order_info = $order->where('id = ' . $_POST['cart_id'])->find();

        if (empty($order_info)) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '购物车ID错误！'
            );
            $this->ajaxReturn($data);
        }

        if ($order_info['uid'] != $_POST['uid']) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '购物车ID错误,不属于该用户！'
            );
            $this->ajaxReturn($data);
        }

        
        if ($order->where('id = '.$_POST['cart_id'])->delete()) {
            $data = array(
                'status' => 1,
                'data' => '',
                'meg' => '删除成功！'
            );
            $this->ajaxReturn($data);
        } else {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '删除失败！'
            );
            $this->ajaxReturn($data);
        }
    }

}
