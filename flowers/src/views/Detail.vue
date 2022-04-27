<template>
	<div class="detail">
		<!-- 顶部导航栏 -->
		<van-nav-bar :title="this.product.type_info.name" left-text="返回" right-text="..." left-arrow
			@click-left="onClickLeft" />
		<img :src="this.product.img_url | dalImg" alt="" style="display: block; width: 100%" />
		<p style="margin-top: 10px; border-top: 1px solid gray">
			{{ this.product.title }}
		</p>
		<h4>￥{{ this.product.price }}</h4>
		<div class="content">
			<p>{{this.product.desc}}</p>
			<p v-for="(item,index) in this.product.imgs" :key="index"><img :src="item['img_url'] | dalImg" /></p>
		</div>
		<!-- 底部固定栏 立即购买/加入购物车 -->
		<van-goods-action>
			<van-goods-action-icon icon="chat-o" text="客服" />
			<van-goods-action-icon icon="shop-o" text="店铺" />
			<van-goods-action-button color="#be99ff" type="warning" text="加入购物车" @click="addToCart" />
			<van-goods-action-button color="#7232dd" type="danger" text="立即购买" @click="placeOrder()" />
		</van-goods-action>
	</div>
</template>

<script>
	// import { Toast } from "vant";
	import {
		loadItemDetailsAPI
	} from "../services/products";
	import {
		insertModelAPI,
		addOrdersAPI
	} from "../services/carts";
	export default {
		data() {
			return {
				product: {
					type_info: {}
				},
			};
		},

		async created() {
			let id = this.$store.state.detailId;
			await loadItemDetailsAPI({
				id
			}).then(
				(res) => (this.product = res.data)
			);
		},

		methods: {
			onClickLeft() {
				this.$router.go(-1);
			},
			async addToCart() {
				// console.log(this, this.product);
				let {
					status,
					meg
				} = await insertModelAPI({
					uid: this.$store.state.userId,
					goods_id: this.product.id,
					counts: 1,
				});
				if (status == 1) {
					this.$toast.success("加入购物车成功");
				} else {
					this.$toast.fail(meg)
					this.$router.push({
						name: "Login"
					});
				}
			},
			async placeOrder() {
				let {
					data: {
						id
					},
					meg,
					status
				} = await addOrdersAPI({
					goods_id: this.$store.state.detailId,
					uid: this.$store.state['userId'],
				});
				if (status == 1) {
					this.$store.commit("setPayId",id);
					this.$router.push({
						name: "Place-order"
					});
				} else {
					this.$toast.fail(meg);
				}
			}
		}
	}
</script>

<style>
	.detail {
		padding-bottom: 50px;
	}

	.detail h4 {
		color: red;
		border-bottom: 6px solid rgba(128, 128, 128, 0.199);
	}

	.detail img {
		width: 100%;
	}

	.content p {
		margin: 0;
	}

	.content p img {
		display: block;
	}
</style>
