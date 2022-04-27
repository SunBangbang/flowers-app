<template>
	<div class="orders">
		<van-nav-bar title="订单管理" left-text="返回" left-arrow @click-left="onClickLeft" />
		<van-tabs v-model="activeName">
			<van-tab title="全部" name="a">
				<All :all="orders" @deleteOrder="deleteOrder" @gotoDetail="gotoDetail" />
			</van-tab>
			<van-tab title="待付款" name="b">
				<van-empty class="custom-image" image="https://img01.yzcdn.cn/vant/custom-empty-image.png"
					description="暂无数据" />
			</van-tab>
			<van-tab title="待发货" name="c">
				<van-empty class="custom-image" image="https://img01.yzcdn.cn/vant/custom-empty-image.png"
					description="暂无数据" />
			</van-tab>
			<van-tab title="待收货" name="d">
				<van-empty class="custom-image" image="https://img01.yzcdn.cn/vant/custom-empty-image.png"
					description="暂无数据" />
			</van-tab>
			<van-tab title="待评价" name="e">
				<van-empty class="custom-image" image="https://img01.yzcdn.cn/vant/custom-empty-image.png"
					description="暂无数据" />
			</van-tab>
		</van-tabs>
	</div>
</template>

<script>
	import {
		deleteOrdersAPI,
		orderListAPI
	} from "../services/orders";
	import All from '../components/All.vue'
	export default {
		name: "Orders",
		data() {
			return {
				orders: [],
				activeName: 'a',
			}
		},
		async created() {
			let {data, status, meg} = await orderListAPI({uid: this.$store.state.userId});
			if(status == 1){
				this.orders = data;
			}else{
				this.$toast.fail(meg);
				this.$router.push({name: "Login"})
			}
		},
		methods: {
			onClickLeft() {
				this.$router.push({
					name: "Cart"
				});
			},
			async deleteOrder(value) {
				let {status, meg} = await deleteOrdersAPI({order_id: value,uid: this.$store.state['userId']});
				if (status == 1) {
					this.$toast.success("删除成功");
					location.reload();
				} else {
					this.$toast.fail(meg);
				}
			},
			gotoDetail(value){
				this.$store.commit("setOrderDetailId",value);
				this.$router.push({name: "OrderDetail", params:{id: value}});
			}
		},
		components: {
			All
		},
	}
</script>

<style>
	* {
		margin: 0;
		padding: 0;
	}
	
	.orders {
		padding-bottom: 5px;
	}

	.cart .title {
		text-align: center;
		height: 30px;
		line-height: 30px;
		font-size: 18px;
		font-weight: 100;
		color: black;
		font-weight: bolder;
		border-bottom: 3px solid rgba(128, 128, 128, 0.11);
	}

	.van-card:not(:first-child) {
		margin-top: 20px;
	}

	.custom-image .van-empty__image {
		width: 90px;
		height: 90px;
	}
</style>
