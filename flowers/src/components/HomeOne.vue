<template>
  <div>
    <!-- 导航区域 -->
    <van-sticky>
      <div class="top">
        <van-icon name="service-o" color="#fff" size="30" />
        <span class="top_one">For You Flower</span>
        <van-icon name="chat-o" color="#fff" size="30" />
      </div>

      <van-search
        shape="round"
        background="#455765"
        placeholder="请输入搜索关键词"
      />
      <!-- <van-search v-model="value" shape="round" background="#455765" placeholder="请输入搜索关键词"/> -->
    </van-sticky>
    <!-- 插件 -->
    <home-two />

    <!-- 底部导航栏 -->
    <van-tabbar v-model="active">
      <van-tabbar-item icon="wap-home-o">首页</van-tabbar-item>
      <van-tabbar-item icon="apps-o">分类</van-tabbar-item>
      <van-tabbar-item icon="shopping-cart-o" badge="5">购物车</van-tabbar-item>
      <van-tabbar-item icon="manager-o">我的</van-tabbar-item>
    </van-tabbar>
  </div>
</template>

<script>
// import Vue from "vue";
import "vant/lib/index.css";
// import { Tabbar, TabbarItem, Search, Icon, Sticky } from "vant";
import HomeTwo from "./HomeTwo.vue";

// Vue.use(Tabbar);
// Vue.use(TabbarItem);
// Vue.use(Search);
// Vue.use(Icon);
// Vue.use(Sticky);

export default {
  name: "HomeOne",
  components: {
    // Tabbar,
    // TabbarItem,
    // Search,
    HomeTwo,
    // Icon,
    // Sticky,
  },
  data() {
    return {
      active: 0,
    };
  },
};
</script>


<style scoped>
.top {
  height: 30px;
  display: flex;
  justify-content: space-between;
  padding: 10px 10px 0 10px;
  background-color: #455765;
}
.top_one {
  line-height: 30px;
  color: #fff;
  font-size: 20px;
  font-family: serif;
}
</style>

