<template>
  <div class="muserinfo">
    <van-nav-bar title="我的账户" left-arrow @click-left="onClickLeft" />
    <van-swipe-cell class="borderTop">
      <van-cell :border="false" title="余额" style="background: white">
        <van-icon name="arrow"
      /></van-cell>
    </van-swipe-cell>
    <van-swipe-cell class="borderTop">
      <van-cell
        :border="false"
        :to="{name:'ModifyInfo'}"
        title="个人资料"
        style="background: white; border-bottom: 2px solid #eee"
      >
        <van-icon name="arrow"
      /></van-cell>
    </van-swipe-cell>
    <van-swipe-cell>
      <van-cell :border="false" title="收货人信息" style="background: white">
        <van-icon name="arrow"
      /></van-cell>
    </van-swipe-cell>
    <van-swipe-cell class="borderTop">
      <van-cell
        :border="false"
        title="修改密码"
        style="background: white; border-bottom: 2px solid #eee"
      >
        <van-icon name="arrow"
      /></van-cell>
    </van-swipe-cell>
    <van-swipe-cell>
      <van-cell :border="false" title="修改用户名" style="background: white">
        <van-icon name="arrow"
      /></van-cell>
    </van-swipe-cell>
    <van-swipe-cell class="borderTop">
      <van-cell :border="false" title="功能反馈" style="background: white">
        <van-icon name="arrow"
      /></van-cell>
    </van-swipe-cell>
  </div>
</template>

<script>
export default {
  methods: {
    onClickLeft() {
      this.$router.push({
        name: "User",
      });
    },
  },
};
</script>

<style scoped>
.modify {
  width: 100%;
  text-align: center;
}
.modify[data-v-10c844d3] {
  text-align: left;
}
.borderTop {
  border-top: 0.7rem solid #eeeeee;
}
</style>