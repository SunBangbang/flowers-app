<template>
  <div class="home" style="padding-bottom:60px">
    <!-- 顶部搜索框 -->
    <!-- <van-search v-model="value" placeholder="输入内容" /> -->
    <van-sticky>
      <div class="sousuo">
        <van-search
        shape="round"
        background="#455765"
        placeholder="请输入搜索关键词"
      />
      </div>

      <!-- 商品分类区 :to里面的title:value是路由跳转页面时,对应的页面的标题 -->
    <van-grid :column-num="5">
      <van-grid-item
        v-for="value in categories"
        :key="value.id"
        :icon="value.coverImage | dalImg"
        :text="value.name"
        :to="{
          name: 'Classification',
          query: { tid: value.id, title: value.name },
        }"
      />
    </van-grid>
    </van-sticky>

    <!-- 轮播区域 -->
    <!-- <van-swipe class="my-swipe" :autoplay="3000" indicator-color="white">
      <van-swipe-item v-for="item in banners" :key="item.id">
        <img class="banner_img" :src="item.coverImage | dalImg" alt="轮播图" />
      </van-swipe-item>
    </van-swipe> -->

    <!-- 主页中间的六个标签,分两行显示 用的是ayout组件 -->
    <van-row
      type="flex"
      style="width: 100%; heigth: 30px"
      justify="space-around"
      class="middle_nav"

    >
      <van-col span="8">生日祝福</van-col>
      <van-col span="8">表白/求婚</van-col>
      <van-col span="8">开业/商务</van-col>
      <van-col span="8">周年纪念</van-col>
      <van-col span="8">特价专区</van-col>
      <van-col span="8">人气新品</van-col>
    </van-row>

    <!-- 六个标签下面的5个在同一行的标签 -->
    <!-- <van-row class="nav_two">
      <van-col span="8">爱情鲜花</van-col>
      <van-col span="10">送长辈鲜花</van-col>
      <van-col span="7">永生花</van-col>
      <van-col span="7">礼品</van-col>
      <van-col span="8">蛋糕</van-col>
    </van-row> -->
    <van-card
      v-for="item in goods"
      :key="item.id"
      :price="item.price"
      :desc="item.desc"
      :thumb="item.coverImage | dalImg"
      @click="clickItem(item.id)"
    >
    </van-card>
  </div>
</template>

<script>
import { loadCategoriesAPI } from "../services/categories.js";
// import { loadBannersAPI } from "../services/banners.js";
import { loadProductsAPI } from "../services/list";


export default {
  name: "Home",
  components: {
  },
  data() {
    return {
      value: "",
      categories: [],
      banners: [],
      goods: [],
    };
  },
  methods: {
    clickItem(id) {
			this.$store.commit("setDetailId", id);
      this.$router.push({name:"Detail"})
    },
  },
  async created() {
    // 获取商品分类
    const resCategories = await loadCategoriesAPI();
    // console.log(resCategories.data);
    // 获取到的商品分类过多,把不需要的过滤掉,只留下鲜花App需要的分类
    this.categories = resCategories.data.filter((item) => {
      return item.desc == "鲜花APP";
    });
    // console.log(this.categories)
    // 获取轮播图
    // const resBanners = await loadBannersAPI();
    // console.log(resBanners);
    // this.banners = resBanners.data.filter((item) => {
    //   return item.id >= 9 && item.id <= 11;
    // });
    // console.log(this.banners);
    await loadProductsAPI().then((res) => {
      this.goods = res.data;
      console.log(this.goods);
    });
  },

  //
};
</script>

<style scoped>

/* .van-grid-item {
  color: black;
} */

.sousuo{
  background-color: #455765;

}
.van-search .van-cell{
  padding: 8px 10px;
}
/* 设置Home页面中间6个标签*/
.van-col {
  width: 28%;
  height: 30px;
  line-height: 30px;
  border-radius: 5px;
  text-align: center;
  margin-top: 10px;
  background-color: pink;
  color: #fff;
  font-size: 14px;
}
.van-row{
  padding: 0 0 10px 0;
}
.van-grid{
  border-bottom: 2px solid #ccc;
}
/* 6个标签每隔一个换一个背景色 */
.van-row--flex :nth-child(2n-1) {
  background: #455765;
}

.nav_two {
  margin-top: 20px;
  border: 1px solid #ccc;
  height: 30px;
}
/* 五个在同一行显示的标签 */
.nav_two .van-col {
  display: block;
  width: 20%;
  height: 30px;
  line-height: 30px;
  margin-top: 0;
  background-color: #5b5b5b;
  font-size: 5px;
  border-radius: 0;
  border: none !important;
}
.nav_two .van-col:hover {
  background: orangered;
}
.van-card{
  border-radius: 15px;
  background-color: rgb(233, 233, 233);
}
.van-card__content{
  justify-content: space-around;
}
</style>
