<?php

// 商品

namespace Home\Controller;

use Think\Controller;

class GoodsController extends Controller {

    public function index() {
        echo '';
    }

    //商品列表

    public function list() {
        $_POST['page'] = $_GET['page'];
        $_POST['type'] = $_GET['type'];
        $param = array(
            'page' => $_POST['page'] ? $_POST['page'] : 1,
        );
        $start = ($param['page'] - 1) * 10;
        $Goods = M("goods");
        $str =  '';
        if($_POST['type']){
            $str = ' and type = '.$_POST['type'];
        }
        $result = $Goods->where('counts > 0 '.$str)->limit($start, 10)->select();
        
        if (empty($result)) {
            $data = array(
                'status' => 1,
                'data' => '',
                'meg' => '无更多数据！'
            );
            $this->ajaxReturn($data);
        } else {
            $data = array(
                'status' => 1,
                'data' => $result,
                'meg' => '获取成功！'
            );
            $this->ajaxReturn($data);
        }
    }

    //商品详情
    public function goodsinfo() {
        //$_POST['id'] = $_GET['id'];
        if (empty($_POST['id'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '商品id为空！'
            );
            $this->ajaxReturn($data);
        }

        $goods_id = $_POST['id'];
        $Goods = M("goods");
        $result = $Goods->where('id = ' . $goods_id)->find();
        if (empty($result)) {
            $data = array(
                'status' => 1,
                'data' => '',
                'meg' => '商品id错误！'
            );
            $this->ajaxReturn($data);
        } else {
            $g_imgs = M("goodsimg");
            $imgs = $g_imgs->where('goods_id = ' . $goods_id)->field('img_url')->select();
            $result['imgs'] = $imgs;
            
            
            $g_type = M("goodstype");
            $types= $g_type->where('id = ' . $result['type'])->select();
            $result['type_info'] = $types[0];
            $data = array(
                'status' => 1,
                'data' => $result,
                'meg' => '获取成功！'
            );
            $this->ajaxReturn($data);
        }
    }

    //立即下单 支付完成减库存
    public function pay() {
        //$_POST['goods_counts'] = $_GET['goods_counts'];
        $_POST['goods_counts'] = '{1:10,2:15}';
        if (empty($_POST['goods_counts'])) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '下单信息为空！'
            );
            $this->ajaxReturn($data);
        }
        $goodsinfo = json_decode($_POST['goods_counts'], true);
        //var_dump($goodsinfo);die();
        foreach ($goodsinfo as $k => $v) {

            var_dump($k, $v);
        }
        die();
        //foreach  ^^^^^^^^
        $Goods = M("goods");
        $result = $Goods->where('id = ' . $goods_id)->find();
        if (empty($result)) {
            $data = array(
                'status' => 1,
                'data' => '',
                'meg' => '商品id错误！'
            );
            $this->ajaxReturn($data);
        } else {
            $Goods = M("goodsimg");
            $imgs = $Goods->where('goods_id = ' . $goods_id)->field('img_url')->select();
            $result['imgs'] = $imgs;
            $data = array(
                'status' => 1,
                'data' => $result,
                'meg' => '获取成功！'
            );
            $this->ajaxReturn($data);
        }
    }

    //获取商品分类
    public function gettype() {

        $types = M("goodstype");
        $result = $types->select();
        if (empty($result)) {
            $data = array(
                'status' => 0,
                'data' => '',
                'meg' => '获取失败！'
            );
            $this->ajaxReturn($data);
        } else {
            $data = array(
                'status' => 1,
                'data' => $result,
                'meg' => '获取成功！'
            );
            $this->ajaxReturn($data);
        }
    }

}
