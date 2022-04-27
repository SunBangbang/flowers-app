<template>
	<div class="orders-all" v-if="all.length>0">
		<div class="order-list" v-for="item in all" :key="item.id">
			<van-card v-for="(ele,index) in item['goods_infoss']" :key="ele.id" :num="ele.counts" :price="ele['price']" :desc="ele['desc']"
				:title="ele['title']" :thumb="item.imgs.split(',')[index] | dalImg " @click="gotoDetail(item.id)">
			</van-card>
			<div class="footer">
				<p>共{{item.goods_counts}}件商品 总计: <span>¥{{item.price}}</span> (含运费 ¥5.00)</p>
				<van-button type="danger" size="small" @click="deleteOrder(item['id'])">删除订单</van-button>
			</div>
		</div>
	</div>
	<van-empty v-else class="custom-image" image="https://img01.yzcdn.cn/vant/custom-empty-image.png"
		description="暂无数据" />
</template>

<script>
	export default {
		props: ['all'],
		methods: {
			deleteOrder(value) {
				this.$emit('deleteOrder', value);
			},
			gotoDetail(value){
				this.$emit('gotoDetail', value);
			}
		}
	}
</script>

<style>
	.order-list {
		background-color: #fafafa;
		margin: 20px;
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
</style>
