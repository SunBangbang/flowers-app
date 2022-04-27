<template>
  <div>
      <!-- 顶部滚动条 -->
    <van-notice-bar left-icon="volume-o" :scrollable="false">
      <van-swipe
        vertical
        class="notice-swipe"
        :autoplay="3000"
        :show-indicators="false"
      >
        <van-swipe-item
          >页面滚动时，组件会始终保持在容器范围内。</van-swipe-item
        >
        <van-swipe-item> 属性可以设置组件在吸顶时与顶部的距离。</van-swipe-item>
        <van-swipe-item
          >当组件即将超出容器底部时，会固定在容器的底部。</van-swipe-item
        >
      </van-swipe>
    </van-notice-bar>

  </div>
</template>

<script>
// import Vue from "vue";
import "vant/lib/index.css";
// import { Swipe, SwipeItem, NoticeBar } from "vant";

// Vue.use(Swipe);
// Vue.use(SwipeItem);
// Vue.use(NoticeBar);

export default {
  name: "HomeFour",
  // components: {
  //   Swipe,
  //   SwipeItem,
  //   NoticeBar,
  // },
};
</script>


<style scoped>
.notice-swipe {
  height: 40px;
  line-height: 40px;
}
</style>