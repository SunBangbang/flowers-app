<template>
	<div class="cart">
		<!-- 顶部标题 -->
		<van-nav-bar title="购物车" left-text="返回" left-arrow @click-left="onClickLeft" />
		<!-- 购物车里的每一个商品-->
		<van-swipe-cell v-for="item in carts" :key="item.id">
			<van-card :price="item.goodsinfo['price']" :title="item.goodsinfo['title']"
				:thumb="item.goodsinfo['img_url'] | dalImg">
				<!-- 是否选中 -->
				<template #tag>
					<van-checkbox class="chooseone" v-model="item.checked"></van-checkbox>
				</template>
				<!-- 加减按钮 -->
				<template #footer>
					<van-stepper :name="item.id" v-model="item.counts" @minus="cartMinus(item)"
						@plus="cartPlus(item)" />
				</template>
			</van-card>

			<!-- 左滑出现的删除按钮 -->
			<template #right>
				<van-button @click="delOne(item)" square text="删除" type="danger" class="delete-button" />
			</template>
		</van-swipe-cell>

		<van-submit-bar :price="sumPrice" button-text="提交订单" @submit="onSubmit">
			<van-checkbox class="check_all" v-model="checked">全选</van-checkbox>
		</van-submit-bar>
	</div>
</template>

<script>
	import {
		loadModelsAPI,
		insertModelAPI,
		delModelAPI,
		addOrdersAPI
	} from "../services/carts";
	export default {
		name: "Cart",
		data() {
			return {
				carts: [],
			};
		},
		// 进到购物车页面就执行加载购物车数据的操作
		async created() {
			// 如果sessionStorage里面有token代表已经登录,此时去加载数据
			if (window.sessionStorage.token) {
				this.loadData();
			} else {
				// 如果没有token说明没有登录,跳转到登录页面
				this.$router.push({
					name: "Login"
				});
			}
		},
		methods: {
			async loadData() {
				const res = await loadModelsAPI({
					"uid": this.$store.state.userId
				});
				if (res.data) {
					this.carts = res.data.map(function(item) {
						return {
							...item,
							checked: false
						}
					});
				}
			},
			onClickLeft() {
				this.$router.push({
					name: "Homeshouye"
				});
			},
			async delOne(item) {
				let {
					status,
					meg
				} = delModelAPI({
					cart_id: item.id,
					uid: this.$store.state.userId
				});
				if (status == 1) {
					this.$toast.success("删除成功");
					this.loadData();
				} else {
					this.$toast.fail(meg);
				}
			},

			async cartPlus(v) {
				console.log(v);
				let {
					state,
					meg
				} = await insertModelAPI({
					goods_id: v.goods_id,
					counts: 1,
					uid: this.$store.state['userId'],
				});
				if (state == 2) {
					this.$toast.fail(meg);
				}
			},
			async cartMinus(v) {
				await insertModelAPI({
					goods_id: v.goods_id,
					counts: -1,
					uid: this.$store.state['userId'],
				});
			},
			async onSubmit() {
				let flag = this.carts.every(function(item) {
					return !item.checked
				})
				if (flag) {
					this.$toast.fail("请先选择商品");
				} else {
					let cartids = '';
					this.carts.map((item) => (item.checked && (cartids += item.id + ',')));
					// 删除结尾字符
					cartids = cartids.slice(0, cartids.length - 1);
					let {
						data: {
							id
						},
						meg,
						status
					} = await addOrdersAPI({
						cartids,
						uid: this.$store.state['userId'],
					});
					if (status == 1) {
						this.$store.commit("setPayId", id);
						this.$router.push({
							name: "Place-order",
						});
					} else {
						this.$toast.fail(meg);
					}
				}
			},
		},
		watch: {},
		computed: {
			checked: {
				set(v) {
					this.carts.forEach((item) => {
						item.checked = v;
					});
				},

				get() {
					return this.carts.every((item) => item.checked);
				},
			},
			sumPrice() {
				return (
					this.carts
					.filter((item) => item.checked)
					.reduce((pre, cur) => pre + cur.counts * cur.goodsinfo['price'], 0) * 100
				);
			},
		},
	};
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

	.chooseone {
		position: absolute;
		left: -10px;
		top: 30px;
		text-align: center;
	}

	.chooseone .van-icon {
		width: 0.9em;
		height: 0.9em;
		text-align: center;
		line-height: 0.8em;
	}

	/* 修改商品图片距离左边的距离,给小圆点一些空间 */
	.van-image {
		margin-left: 15px;
	}

	/* 商品描述信息距离左边的距离 */
	.van-card__content {
		margin-left: 30px;
	}

	.goods-card {
		margin: 0;
		background-color: white;
	}

	.van-card__tag .van-icon {
		font-size: 1.25rem;
	}

	.delete-button {
		height: 100%;
	}
</style>
