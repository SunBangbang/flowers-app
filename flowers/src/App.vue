<template>
  <div id="app">
    <router-view class="main" />
    <van-tabbar route v-show="showNav" class="appBottom">
      <van-tabbar-item icon="home-o" :to="{ name: 'Homeshouye' }"
        >首页</van-tabbar-item
      >
      <van-tabbar-item icon="bars" :to="{ name: 'Home' }"
        >列表</van-tabbar-item
      >
      <van-tabbar-item icon="apps-o" :to="{ name: 'List' }"
        >分类</van-tabbar-item
      >
      <van-tabbar-item icon="cart-o" :to="{ name: 'Cart' }"
        >购物车</van-tabbar-item
      >
      <van-tabbar-item icon="user-o" :to="{ name: 'User' }"
        >我的</van-tabbar-item
      > 
    </van-tabbar>
  </div>
</template>
<script>
export default {
  data() {
    return { showNav: true };
  },
  // 监听页面的改变
  watch: {
    $route(v) {
      if (v.meta.hideBottom) {
        this.showNav = false;
      } else {
        this.showNav = true;
      }
    },
  },
};
</script>

<style lang="scss">
.appBottom {
  border-top: 1px solid #e5e5e5;
}

</style>
