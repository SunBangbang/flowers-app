<template>
	<div class="orders">
		<van-nav-bar title="订单详情" left-text="返回" left-arrow @click-left="onClickLeft" />
		<van-row>
			<van-col span="3"><i class="van-icon van-icon-contact van-cell__left-icon"></i></van-col>
			<van-col span="21">
				<div>姓名：{{orders.name}}</div>
				<div>电话：{{orders.phone}}</div>
				<div>地址：{{orders.address}}</div>
			</van-col>
		</van-row>
		<div class="order-list">
			<van-card v-for="(ele,index) in orders['goods_infoss']" :key="ele.id" :num="ele.counts"
				:price="ele['price']" :desc="ele['desc']" :title="ele['title']" :thumb="orders.imgs.split(',')[index] | dalImg ">
			</van-card>
			<div class="footer">
				<p>共{{orders.goods_counts}}件商品 总计: <span>¥{{orders.price}}</span> (含运费 ¥5.00)</p>
			</div>
		</div>
		<div class="infos">
			<p>订单ID: {{orders['id']}}</p>
			<p>订单状态: {{orders['pay_status'] == '1' ? '已支付' : '未支付'}}</p>
			<p>支付方式: {{orders['pay_type']}}</p>
			<p>配送方式: {{orders['send_type']}}</p>
			<p>创建时间: {{new Date(orders['ctime'] * 1000) | dateFormat}}</p>
		</div>
	</div>
</template>

<script>
	import {
		orderInfoAPI
	} from "../services/orders";
	export default {
		name: "OrderDetail",
		data() {
			return {
				orders: [],
			}
		},
		async created() {
			let {
				data,
				status,
				meg
			} = await orderInfoAPI({
				order_id: this.$store.state.orderDetailId,
				uid: this.$store.state.userId
			});
			if (status == 1) {
				this.orders = data;
			} else {
				this.$toast.fail(meg);
			}
		},
		methods: {
			onClickLeft() {
				this.$router.push({
					name: "Orders"
				});
			},
		}
	}
</script>

<style>
	* {
		margin: 0;
		padding: 0;
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
	
	.van-row::before {
		position: absolute;
		right: 0;
		bottom: 0;
		left: 0;
		height: 2px;
		background: repeating-linear-gradient(-45deg, #ff6c6c 0, #ff6c6c 20%, transparent 0, transparent 25%, #1989fa 0, #1989fa 45%, transparent 0, transparent 50%);
		background-size: 80px;
		content: '';
	}
	
	.van-row {
		position: relative;
		display: flex;
		align-items: center;
		padding: 10px 16px;
		line-height: 24px;
		font-size: 14px;
	}
	
	.van-row .van-cell__left-icon {
		font-size : 26px;
	}

	.order-list {
		margin-top: 20px;
		background-color: #fafafa;
	}

	.footer {
		text-align: right;
	}

	.footer p {
		margin: 10px 0;
		padding: 10px;
		font-size: 15px;
		border-top: 1px solid #eee;
		border-bottom: 1px solid #eee;
	}

	.footer p span {
		color: #E9546B
	}

	.footer .van-button {
		margin: 0 10px 10px 0;
	}
	
	.infos {
		margin: 20px 0;
		padding: 20px;
		line-height: 25px;
		font-size: 14px;
		color: #666;
		border-top: 1px solid #eee;
	}
</style>
