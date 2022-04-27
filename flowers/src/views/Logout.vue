<template>
  <div class="logout">
    <van-nav-bar
      title="更多"
      left-text=""
      left-arrow
      @click-left="onClickLeft"
    />
    <div class="logoutBox">
      <van-cell-group>
        <van-switch-cell
          v-model="checked"
          title="WIFI下自动升级客户端"
          primary
          style="background: white; padding: 0 1rem; margin: 0; height: 2.5rem"
        />
      </van-cell-group>
      <van-swipe-cell>
        <van-cell
          :border="false"
          title="清除本地缓存"
          value="37.32kB >"
          style="background: white"
        />
      </van-swipe-cell>
    </div>
    <br />
    <p>当前版本号：V1.1</p>
    <br />
    <van-button round type="info" block @click="logout">退出登录</van-button>
  </div>
</template>

<script>
import { removeToken } from "../utils/tools";
import { loginoutAPI } from "../services/auth";
export default {
  data() {
    return {
      checked: true,
			name: ""
    };
  },
  methods: {
    onClickLeft() {
      this.$router.go(-1);
    },
    async logout() {
			await loginoutAPI({name});
      removeToken();
			sessionStorage.clear();
      this.$router.replace({
        name: "Home",
      });
    },
  },
};
</script>

<style scoped>
.logoutBox {
  background: #e7e7e7;
  padding: 0.5rem 0;
}
p {
  text-align: center;
}
.van-button--info {
  width: 90%;
  background-color: #ff5733;
  border: none;
  margin: 0 auto;
  /* e7e7e7 */
}
</style>