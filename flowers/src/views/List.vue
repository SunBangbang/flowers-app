<template>
  <div class="list">
    <!-- 顶部搜索框 -->
    <van-search v-model="txt" placeholder="输入内容" />
    <div class="list">
      <van-tree-select
        height="100vh"
        :items="items"
        :main-active-index.sync="active"
        @click-nav="loadGoods"
      >
        <!-- 左侧导航右边的商品信息 -->
        <template #content>
          <van-card
            v-for="item in newGoods"
            :key="item.id"
            :price="item.price.toFixed(2)"
            :desc="item.name"
            :thumb="item.coverImage | dalImg"
            @click="clickItem(item.id)"
          >
          </van-card>
          <van-card
            v-for="item in newGoods"
            :key="item.id"
            :price="item.price.toFixed(2)"
            :desc="item.name"
            :thumb="item.coverImage | dalImg"
            @click="clickItem(item.id)"
          >
          </van-card>
        </template>
      </van-tree-select>
    </div>
  </div>
</template>
<script>

import { loadProductsAPI, getCategoriesAPI } from "../services/list";
export default {
  data() {
    return {
      txt: "",
      active: 0,
      items: [],
      goods: [],
      newGoods: [],
      query: { id: 38 },
    };
  },
  async created() {
    const resCategories = await getCategoriesAPI();
    // console.log(resCategories);
    // 符合条件的分类
    var eligibleList = resCategories.data
      .filter((item) => {
        return item.desc == "鲜花APP";
      })
      .map(function (cagetory) {
        return { ...cagetory, text: cagetory.name };
      });
    // console.log(eligibleList);
    this.items = eligibleList;
    await loadProductsAPI(this.query).then((res) => {
      this.goods = res.data;
      console.log(this.goods);

      this.newGoods = this.goods.filter((products) => {
        return products.category.id == this.items[this.active].id;
      });
    });
  },
  methods: {
    loadGoods(index) {
      const tid = this.items[index].id;
      this.query = { id: tid };
      this.newGoods = this.goods.filter((products) => {
        return products.category.id == this.items[this.active].id;
      });
    },
    async clickItem(id) {
      this.$router.push({name:"Detail",params:{id}})
    },
  },
};
</script>

<style scoped>
.van-tree-select__content {
  flex: 4;
  padding-bottom: 60px;
}
.van-search {
  border-bottom: 1px solid rgba(128, 128, 128, 0.438);
  background-color: #455765;
}
</style>

