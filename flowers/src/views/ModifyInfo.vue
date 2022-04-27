<template>
<div class="modify">
    <div class="modify">
    <van-nav-bar
      title="修改个人资料"
      left-text="返回"
      left-arrow
      @click-left="onClickLeft"
    />
    <van-uploader
      style="display: block; margin: 1rem auto"
      :after-read="afterRead"
      v-model="files"
      max-count="1"
    />
    <van-cell-group>
      <van-field v-model="nickName" label="昵称" placeholder="请输入昵称" />
    </van-cell-group>
    <van-button block type="primary" @click="saveHandle">保存</van-button>
  </div>
</div>
  
</template>


<script>
import axios from "axios";
import { modifyUserInfoAPI } from "../services/user";
import { uploadUrl, serverUrl } from "../utils/tools";
export default {
  data() {
    return {
      nickName: "",
      avatar: "",
      files: [],
    };
  },
  methods: {
    onClickLeft() {
      this.$router.go(-1);
    },
    afterRead(file) {
      // 头像文件上传
      const formData = new FormData();
      formData.append("file", file.file);
      axios.post(uploadUrl, formData).then((res) => {
        this.avatar = res.data.data;
        this.files = [{ url: serverUrl + this.avatar }];
      });
    },
    async saveHandle() {
      await modifyUserInfoAPI({
        avatar: this.avatar,
        nickName: this.nickName,
      });
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
  
</style>