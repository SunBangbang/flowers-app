<template>
	<div class="recommend">
		<!-- 轮播图 -->
		<van-swipe class="my-swipe" :autoplay="3000" indicator-color="white">
			<van-swipe-item><img class="swipe-banner" src="../assets/banner1.png" /></van-swipe-item>
			<van-swipe-item><img class="swipe-banner" src="../assets/banner2.png" /></van-swipe-item>
			<van-swipe-item><img class="swipe-banner" src="../assets/banner3.png" /></van-swipe-item>
			<van-swipe-item><img class="swipe-banner" src="../assets/banner4.png" /></van-swipe-item>
		</van-swipe>
		<!-- 优惠券 -->
		<div class="coupon">
			<div class="coupon_box">
				<div class="new-font">新人礼</div>
				<div class="new-img">
					<section style="border: 0">
						<div class="newbox">¥<span style="font-size: 34px">10</span></div>
						<div class="newbox1">无门槛得</div>
					</section>
					<section>
						<div class="newbox">¥<span style="font-size: 34px">20</span></div>
						<div class="newbox1">满200元使用</div>
					</section>
					<section>
						<div class="newbox">¥<span style="font-size: 34px">30</span></div>
						<div class="newbox1">满300元使用</div>
					</section>
					<section>
						<div class="newbox">¥<span style="font-size: 34px">40</span></div>
						<div class="newbox1">满600元使用</div>
					</section>
				</div>
				<div class="new-font">点击领取</div>
			</div>
		</div>
		<!-- 分类 -->
		<van-grid :gutter="10">
			<van-grid-item icon="gem-o" text="精品花束" />
			<van-grid-item icon="fire-o" text="当前热卖" />
			<van-grid-item icon="point-gift-o" text="生日礼品" />
			<van-grid-item icon="shop-collect-o" text="收藏店铺" />
			<van-grid-item icon="flower-o" text="新鲜花卉" />
			<van-grid-item icon="free-postage" text="免费包邮" />
			<van-grid-item icon="vip-card-o" text="会员专享" />
			<van-grid-item icon="newspaper-o" text="周边服务" />
		</van-grid>
		<!-- 活动 -->
		<div class="activity_box">
			<div class="activity">
				<div class="act_box"></div>
				<div class="act_box1"></div>
			</div>
		</div>
		<van-card v-for="item in goods" :key="item.id" :price="item.price" :desc="item.title"
			:thumb="item.img_url | dalImg" @click="clickItem(item.id)">
		</van-card>
	</div>
</template>

<script>
	// import Vue from "vue";
	import "vant/lib/index.css";
	import {
		loadProductsAPI
	} from "../services/list";
	// import { Swipe, SwipeItem, Grid, GridItem } from "vant";

	// Vue.use(Swipe);
	// Vue.use(SwipeItem);
	// Vue.use(Grid);
	// Vue.use(GridItem);

	export default {
		name: "HomeThree",
		data() {
			return {
				goods: [],
			};
		},
		async created() {
			await loadProductsAPI().then((res) => {
				this.goods = res.data;
				// console.log(this.goods);
			});
		},
		methods: {
			clickItem(id) {
				this.$store.commit("setDetailId", id);
				setTimeout(() => {
					this.$router.push({
						name: "Detail"
					});
				}, 500)
			},
		},
		// components: {
		//   Swipe,
		//   SwipeItem,
		//   Grid,
		//   GridItem,
		// },
	}
</script>

<style scoped>
	.recommend {
		padding-bottom: 80px;
	}

	.my-swipe .van-swipe-item .swipe-banner {
		width: 100%;
		height: 200px;
	}

	.van-grid {
		padding: 10px 0;
		background: linear-gradient(bottom, #c9b4ba, #455765);
	}

	.coupon {
		height: 90px;
	}

	.coupon_box {
		width: 95%;
		height: 80px;
		margin: auto;
		margin-top: 5px;
		display: flex;
		justify-content: space-between;
		background-color: #455765;
	}

	.new-font {
		width: 10%;
		color: #fff;
		font-size: 12px;
		text-align: center;
		line-height: 30px;
		letter-spacing: 4px;
		writing-mode: vertical-lr;
	}

	.new-img {
		width: 90%;
		display: flex;
	}

	.new-img section {
		width: 80%;
		height: 80%;
		margin: auto;
		border-left: 1px solid rgb(87, 87, 87);
	}

	.new-img section .newbox {
		height: 70%;
		color: #fff;
		padding: 0 10px;
		background-color: #e9546b;
	}

	.new-img section .newbox1 {
		height: 30%;
		text-align: center;
		font-size: 11px;
		line-height: 20px;
		background-color: #fff;
	}

	.activity_box {
		height: 200px;
		background: linear-gradient(top, #c9b4ba, #eeeeee);
	}

	.activity_box .activity {
		width: 95%;
		height: 200px;
		margin: auto;
		display: flex;
		justify-content: space-between;
	}

	.activity_box .activity .act_box {
		width: 49%;
		height: 100%;
		background: url(../assets/bei1.png) no-repeat;
		background-size: cover;
	}

	.activity_box .activity .act_box1 {
		width: 49%;
		height: 100%;
		background: url(../assets/bei2.png) no-repeat;
		background-size: cover;
	}
</style>
