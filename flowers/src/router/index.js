import Vue from 'vue'
import VueRouter from 'vue-router'
import Homeshouye from '../views/Homeshouye.vue'
import { isLogined } from "../utils/tools";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Homeshouye',
    component: Homeshouye,
  },
  {
    path: '/Home',
    name: 'Home',
    component: () => import('../views/Home.vue')
  },
  {
    path: '/list',
    name: 'List',
    component: () => import('../views/List.vue')
  },
  {
    path: '/cart',
    name: 'Cart',
    component: () => import('../views/Cart.vue')
  },
  {
    path: '/user',
    name: 'User',
    component: () => import('../views/User.vue')
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('../views/Login.vue'),
    meta: {
      hideBottom: true, // 是否隐藏底部导航栏
    },
  },
  {
    path: '/logout',
    name: 'Logout',
    component: () => import('../views/Logout.vue'),
    meta: {
      hideBottom: true, // 是否隐藏底部导航栏
    },
  },
  {
    path: '/reg',
    name: 'Reg',
    component: () => import('../views/Reg.vue'),
    meta: {
      hideBottom: true, // 是否隐藏底部导航栏
    },
  },
  {

    path: '/modifyinfo',
    name: 'ModifyInfo',
    component: () => import('../views/ModifyInfo.vue'),
    meta: {
      hideBottom: true, // 是否隐藏底部导航栏
    },
  },
  {
    path: '/userinfo',
    name: 'UserInfo',
    component: () => import('../views/UserInfo.vue'),
    meta: {
      hideBottom: true, // 是否隐藏底部导航栏
    },
  },
  {

    path: "/classification",
    name: "Classification", // 商品分类页,不是列表页
    component: () => import("../views/Classification"),
    meta: {
      hideBottom: true
    }
  },
	// 商品详情
  {
    path: "/detail",
    name: "Detail",
    component: () => import("../views/Detail"),
    meta: {
      hideBottom: true
    }
  },
  // 提交订单
  {
    path:"/placeorder",
    name:"Place-order", 
    component:() => import ("../views/Place-order"),
    meta:{
      hideBottom:true
    }
  },
	// 订单列表
  {
    path:"/orders",
    name:"Orders", 
    component:() => import ("../views/Orders"),
    meta:{
      hideBottom:true
    }
  },
	// 添加地址
	{
	  path:"/chooseadress",
	  name:"chooseAdress", 
	  component:() => import ("../views/ChooseAdress"),
	  meta:{
	    hideBottom:true
	  }
	},
	// 订单详情
	{
	  path:"/orderDetail",
	  name:"OrderDetail", 
	  component:() => import ("../views/OrderDetail"),
	  meta:{
	    hideBottom:true
	  }
	},
]

const router = new VueRouter({
  routes
});

router.beforeEach((to, from, next) => {
  if (to.meta.needLogin) {
    if (isLogined()) {
      next();
    } else {
      next({
        name: "Login",
      });
    }
  } else {
    next();
  }
});

export default router;
