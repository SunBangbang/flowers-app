<template>
  <div>
    <van-tabs v-model="active1">
      <van-tab title="推荐系列">
        <home-three />
      </van-tab>

      <van-tab title="新品鲜花">
        <home-four />
      </van-tab>

      <van-tab title="好物分享">
        <van-empty description="抱歉！该页什么都没有哦~" />
      </van-tab>

      <van-tab title="开业花篮">
        <van-empty description="抱歉！该页什么都没有哦~" />
      </van-tab>

      <van-tab title="服务售后">
        <van-empty description="抱歉！该页什么都没有哦~" />
      </van-tab>
    </van-tabs>
  </div>
</template>

<script>
// import Vue from "vue";
import "vant/lib/index.css";
// import { Tab, Tabs, Empty } from "vant";
import HomeThree from "./HomeThree.vue";
import HomeFour from "./HomeFour.vue";

// Vue.use(Tab);
// Vue.use(Tabs);
// Vue.use(Empty);

export default {
  name: "HomeOne",
  components: {
    // Tab,
    // Tabs,
    // Empty,
    HomeThree,
    HomeFour,
  },
  data() {
    return {
      active1: 0,
    };
  },
};
</script>

<style scoped>
</style>