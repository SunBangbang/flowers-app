<template>
  <div class="classification">
    <van-nav-bar
      :title="this.title"
      left-text=""
      left-arrow
      @click-left="onClickLeft"
    />
    <!-- vant组件 tab标签页 -->
    <van-tabs
      swipeable
      style="border-bottom: 1px gray solid; padding-bottom: 2px"
    >
      <van-tab title="综合"> </van-tab>
      <van-tab title="销量"> </van-tab>
      <van-tab title="价格"> </van-tab>
      <van-tab title="新品"> </van-tab>
    </van-tabs>
    <!-- 商品 -->
    <div class="goods"  >
      <div class="goods-box" v-for="item in list" :key="item.id" @click="toDetail(item.id)">
        <div class="imgbox">
          <img :src="item.coverImage | dalImg" alt=""   />
        </div>
        <p class="goods-name" >{{ item.name }}</p>
        <p class="price">￥{{ item.price.toFixed(2) }}</p>
      </div>
    </div>
    <!-- 下面是占位用的 -->
    <div class="none" v-show="isShow" style="display:float;width: 45vw; height: 65vw"></div>
  </div>
</template>

<script>
import { Toast } from "vant";
import { loadProductsAPI } from "../services/products";
export default {
  data() {
    return {
      title: "",
      list: [],
      isShow: false,
    };
  },
  methods: {
    onClickLeft() {
      Toast("返回");
      this.$router.push({ name: "Home" });
      console.log(this.list);
    },
    beforeChange(index) {
      // 返回 false 表示阻止此次切换
      if (index === 1) {
        return false;
      }
      console.log(this.list);
    },
    loadTitle() {
      return this.title;
    },
    toDetail(id){
    
      this.$router.push({name:"Detail",params:{id}})
      // console.log("成功了吗")
     
    }
  },
  async created() {
    this.title = this.$route.query.title;
    const query = {
      category: this.$route.query.tid,
    };
    console.log(this.$route.query);
    await loadProductsAPI(query).then((res) => {
      this.list = res.data;
      // //   这个if判断之后要删掉,是为了解决display:flex带来的影响,本来一行显示两个,但是如果是奇数的话,最后一个商品会居中显示,无法和上面的对齐
      //   if(this.list.length%2 !== 0){ // 如果商品总数是奇数的话,再新增一个和最后一个商品一样的商品,让商品总数变成偶数
      //     this.list.push(this.list[this.list.length-1])
      //     this.list[this.list.length-1].id=10000
      //   }
      if (this.list.length % 2 !== 0) {
        this.isShow = true;
      }
    });

    // console.log(this.list);
  },
};
</script>

<style>
* {
  margin: 0;
  padding: 0;
}
.goods {
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  flex-wrap: wrap;
  font-size: 12px;
}
.goods-box {
  width: 45vw;
  height: 65vw;
  background: antiquewhite;
  border: 1px solid slategray;
  border-radius: 8px;
  background: #e7e7e7;
  margin-top: 10px;
  position: relative;
}
.goods-box img {
  display: block;
  width: 40vw;
  margin: 3px auto;
}
.goods p {
  margin-left: 10px;
}
.goods .price {
  color: red;
  font-size: 16px;
  position: absolute;
  bottom: 0;
}
</style>