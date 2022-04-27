<?php

// 订单

namespace Home\Controller;

use Think\Controller;

class OrderController extends Controller {

    public function index() {
        echo '';
    }

    public function add() {

        //$_POST['uid'] = $_GET['uid'];
        //$_POST['token'] = $_GET["token"];
        //$_POST['cartids'] = $_GET["cartids"];
        //$_POST['goods_id'] = $_GET["goods_id"];
        $_POST['token'] = $_SERVER['HTTP_TOKEN'];
        if (empty($_POST['cartids']) && empty($_POST['goods_id'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'cartidsgoods_id参数不能都为空！'
            );
            $this->ajaxReturn($data);
        }


        if (empty($_POST['uid']) || empty($_POST['token'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'uid,token,goodsinfo参数不能为空！'
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

        $Goods = M("goods");
        $Order = M("order");
        $Ordersub = M("ordersub");
        $Cart = M("shoppingcart");
        if (!empty($_POST['goods_id'])) {
            $goodsinfo = $Goods->where('id = ' . $_POST['goods_id'])->find();
            if ($goodsinfo['counts'] < 1) {
                $data = array(
                    'status' => 0,
                    'data' => '',
                    'meg' => '立即下单失败，库存不足1！'
                );
                $this->ajaxReturn($data);
            }

            $kucun_data['counts'] = $goodsinfo['counts'] - 1;
            $kucun_data['mtime'] = time();
            $Goods->where('id = ' . $_POST['goods_id'])->save($kucun_data); // 根据条件更新记录

            $order_data = array(
                'uid' => $_POST['uid'],
                'ctime' => time(),
                'mtime' => time(),
                'price' => $goodsinfo['price'],
                'status' => 1,
                'pay_status' => 0,
                'address' => '',
                'phone' => '',
                'name' => '',
                'pay_type' => '',
                'send_type' => '',
            );
            $insert_id = $Order->add($order_data);
            if ($insert_id) {
                $order_sub = array(
                    'goods_id' => $_POST['goods_id'],
                    'counts' => 1,
                    'ctime' => time(),
                    'mtime' => time(),
                    'uid' => $_POST['uid'],
                    'price' => $goodsinfo['price'],
                    'order_id' => $insert_id,
                    'total_price' => $goodsinfo['price'],
                );
                $Ordersub->add($order_sub);
                $order_infos = $Order->where('id =' . $insert_id)->find();

                $data = array(
                    'status' => 1,
                    'data' => $order_infos,
                    'meg' => '立即下单成功！'
                );
                $this->ajaxReturn($data);
            } else {
                $data = array(
                    'status' => 0,
                    'data' => '',
                    'meg' => '立即下单失败！'
                );
                $this->ajaxReturn($data);
            }
        }
        if (!empty($_POST['cartids'])) { //购物车下单
            $cartids_arr = explode(",", $_POST['cartids']);

            $total_price = '';
            foreach ($cartids_arr as $cart_v) {
                $cart_infos = $Cart->where('id = ' . $cart_v)->find();
                $gooods_info = $Goods->where('id = ' . $cart_infos['goods_id'])->find();
                $total_price += $gooods_info['price'] * $cart_infos['counts']; //商品总价
            }

            $order_data = array(
                'uid' => $_POST['uid'],
                'ctime' => time(),
                'mtime' => time(),
                'price' => $total_price,
                'status' => 1,
                'pay_status' => 0,
                'address' => '',
                'phone' => '',
                'name' => '',
                'pay_type' => '',
                'send_type' => '',
            );
            //var_dump($order_data);die();
            $insert_id = $Order->add($order_data);
            //var_dump($Order->getLastSql());die();
            if ($insert_id) {
                foreach ($cartids_arr as $cart_vv) {
                    $order_sub = '';
                    $cart_info = $Cart->where('id = ' . $cart_vv)->find();
                    $godos_info = $Goods->where('id = ' . $cart_info['goods_id'])->find();
                    $order_sub = array(
                        'goods_id' => $cart_info['goods_id'],
                        'counts' => $cart_info['counts'],
                        'ctime' => time(),
                        'mtime' => time(),
                        'uid' => $_POST['uid'],
                        'price' => $godos_info['price'],
                        'order_id' => $insert_id,
                        'total_price' => $godos_info['price'] * $cart_info['counts'],
                    );
                    $Ordersub->add($order_sub);
                    $Cart->where('id = ' . $cart_vv)->delete();
                }
                $order_infos = $Order->where('id =' . $insert_id)->find();
                $data = array(
                    'status' => 1,
                    'data' => $order_infos,
                    'meg' => '立即下单成功！'
                );
                $this->ajaxReturn($data);
            } else {
                $data = array(
                    'status' => 0,
                    'data' => '',
                    'meg' => '11立即下单失败！'
                );
                $this->ajaxReturn($data);
            }
        }
    }

    //支付
    public function pay() {
        //$_POST['uid'] = $_GET['uid'];
        //$_POST['token'] = $_GET["token"];
        //$_POST['order_id'] = $_GET["order_id"];
        //$_POST['address'] = $_GET["address"];
        //$_POST['phone'] = $_GET["phone"];
        //$_POST['name'] = $_GET["name"];
        //$_POST['pay_type'] = $_GET["pay_type"];
        //$_POST['send_type'] = $_GET["send_type"];
        $_POST['token'] = $_SERVER['HTTP_TOKEN'];
        if (empty($_POST['uid']) || empty($_POST['token']) || empty($_POST['order_id'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'uid,token,order_id参数不能为空！'
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


        $order = M("order"); // 订单
        $order_info = $order->where('id = ' . $_POST['order_id'])->find();

        if (empty($order_info)) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '订单ID错误！'
            );
            $this->ajaxReturn($data);
        }

        if ($order_info['uid'] != $_POST['uid']) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '订单ID错误,不属于该用户！'
            );
            $this->ajaxReturn($data);
        }

        if ($order_info['status'] == 0) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '该订单已删除，无法支付！'
            );
            $this->ajaxReturn($data);
        }
        if ($order_info['pay_status'] != 0) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '该订单已支付完成，无法继续支付！'
            );
            $this->ajaxReturn($data);
        }

        $update['pay_status'] = 1;
        $update['address'] = $_POST['address'];
        $update['phone'] = $_POST['phone'];
        $update['name'] = $_POST['name'];
        $update['pay_type'] = $_POST['pay_type'];
        $update['send_type'] = $_POST['send_type'];
        $update['mtime'] = time();
        if ($order->where('id = ' . $_POST['order_id'])->save($update)) {
            $data = array(
                'status' => 1,
                'data' => '',
                'meg' => '订单支付成功！'
            );
            $this->ajaxReturn($data);
        } else {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '该订单失败！'
            );
            $this->ajaxReturn($data);
        }
    }

    //订单列表
    public function list() {
        //$_POST['uid'] = $_GET['uid'];
        //$_POST['token'] = $_GET["token"];
        $_POST['token'] = $_SERVER['HTTP_TOKEN'];
        if (empty($_POST['uid']) || empty($_POST['token'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'uid,token,order_id参数不能为空！'
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


        $order = M("order"); // 订单
        $goods_obj = M("goods"); // shangpin 
        $order_sub_obj = M("ordersub"); // 订单分表
        $order_info = $order->where('uid = ' . $_POST['uid'] ." and status = 1")->select();
        foreach ($order_info as $ok => $ov) {
            $order_sub_infos = $order_sub_obj->where("order_id = " . $ov['id'])->select();
            $img_str = '';
            foreach ($order_sub_infos as $k => $v) {

                $goods_order_info = $goods_obj->where("id = " . $v['goods_id'])->find();
                $goods_info = $v;
                $goods_info['img'] = $goods_order_info['img_url'];
                $goods_info['title'] = $goods_order_info['title'];
                $goods_info['desc'] = $goods_order_info['desc'];
                $order_info[$ok]['goods_infoss'][$k] = $goods_info;
                $img_str .= $goods_order_info['img_url'] . ",";
            }
            $order_info[$ok]['imgs'] = substr($img_str, 0, strlen($img_str) - 1);
            $order_info[$ok]['goods_counts'] = $order_sub_obj->where("order_id = " . $ov['id'])->count();
        }

        if ($order_info) {
            $data = array(
                'status' => 1,
                'data' => $order_info,
                'meg' => '获取成功！'
            );
            $this->ajaxReturn($data);
        }
    }

    //删除订单
    public function delorder() {

        //$_POST['uid'] = $_GET['uid'];
        //$_POST['token'] = $_GET["token"];
        //$_POST['order_id'] = $_GET["order_id"];
        $_POST['token'] = $_SERVER['HTTP_TOKEN'];
        if (empty($_POST['uid']) || empty($_POST['token']) || empty($_POST['order_id'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'uid,token,order_id参数不能为空！'
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


        $order = M("order"); // 订单
        $order_info = $order->where('id = ' . $_POST['order_id'])->find();

        if (empty($order_info)) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '订单ID错误！'
            );
            $this->ajaxReturn($data);
        }

        if ($order_info['uid'] != $_POST['uid']) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '订单ID错误,不属于该用户！'
            );
            $this->ajaxReturn($data);
        }

        if ($order_info['status'] == 0) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '该订单已删除，无法再次删除！'
            );
            $this->ajaxReturn($data);
        }
        if ($order_info['pay_status'] != 0) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '该订单已支付完成，无法删除！'
            );
            $this->ajaxReturn($data);
        }

        $update['status'] = 0;
        $update['mtime'] = time();
        if ($order->where('id = ' . $_POST['order_id'])->save($update)) {
            $data = array(
                'status' => 1,
                'data' => '',
                'meg' => '订单删除成功！'
            );
            $this->ajaxReturn($data);
        } else {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '该订单删除失败！'
            );
            $this->ajaxReturn($data);
        }
    }

    //订单详情
    public function orderinfo() {
        //$_POST['uid'] = $_GET['uid'];
        //$_POST['token'] = $_GET["token"];
        //$_POST['order_id'] = $_GET["order_id"];
        $_POST['token'] = $_SERVER['HTTP_TOKEN'];
        if (empty($_POST['uid']) || empty($_POST['token']) || empty($_POST['order_id'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => 'uid,token,order_id参数不能为空！'
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


        $order = M("order"); // 订单
        $order_info = $order->where('id = ' . $_POST['order_id'])->find();

        if (empty($order_info)) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '订单ID错误！'
            );
            $this->ajaxReturn($data);
        }

        if ($order_info['uid'] != $_POST['uid']) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '订单ID错误,不属于该用户！'
            );
            $this->ajaxReturn($data);
        }

        if ($order_info['status'] == 0) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '该订单已删除，无法获取删除！'
            );
            $this->ajaxReturn($data);
        }

        $goods_obj = M("goods"); // shangpin 
        $order_sub_obj = M("ordersub"); // 订单分表
        $order_sub_infos = $order_sub_obj->where("order_id = " . $order_info['id'])->select();
        $order_info['goods_counts'] = $order_sub_obj->where("order_id = " . $order_info['id'])->count();
        $img_str = '';
        foreach ($order_sub_infos as $k => $v) {
            $goods_order_info = $goods_obj->where("id = " . $v['goods_id'])->find();
            $goods_info = $v;
            $goods_info['img'] = $goods_order_info['img_url'];
            $goods_info['title'] = $goods_order_info['title'];
            $goods_info['desc'] = $goods_order_info['desc'];
            $order_info['goods_infoss'][$k] = $goods_info;
            $img_str .= $goods_order_info['img_url'] . ",";
        }
        $order_info['imgs'] = substr($img_str, 0, strlen($img_str) - 1);


        if ($order_info) {
            $data = array(
                'status' => 1,
                'data' => $order_info,
                'meg' => '获取成功！'
            );
            $this->ajaxReturn($data);
        }
    }

}
