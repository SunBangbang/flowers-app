<template>
	<div class="place-order">
		<van-nav-bar title="提交订单" left-text="返回" left-arrow @click-left="onClickLeft" />
		<div class="order-pay">
			<!-- 配送人及地址 -->
			<van-row @click="chooseAdress" v-if="currentContact.name">
				<van-col span="22">
					<div>姓名：{{currentContact.name}}</div>
					<div>电话：{{currentContact.tel}}</div>
					<div>地址：{{currentContact.address}}</div>
				</van-col>
				<van-col span="2"><i class="van-icon van-icon-arrow van-cell__right-icon"></i></van-col>
			</van-row>
			<van-contact-card type="add" @click="onAdd" v-else />
			<!-- 支付方式 -->
			<van-field v-model="fieldValue" is-link readonly label="支付方式" placeholder="请选择支付方式" @click="show = true" />
			<!-- 配送方式 -->
			<van-field v-model="disModel" readonly label="配送方式" />
			<van-panel title="商品">
				<van-card v-for="item in goods" :key="item['id']" :num="item['counts']" :price="item['price']"
					:desc="item['desc']" :title="item['title']" :thumb="item['img'] | dalImg">
				</van-card>
			</van-panel>
			<van-submit-bar :price="totalPrice*100" button-text="支付" @submit="onSubmit">
				<!-- <template #tip>
			    你的收货地址不支持同城送, <span @click="onClickEditAddress">修改地址</span>
			  </template> -->
			</van-submit-bar>
			<van-popup v-model="show" round position="bottom" get-container="body" :safe-area-inset-bottom="true">
				<van-cascader v-model="cascaderValue" title="请选择支付方式" :options="options" @close="show = false"
					@finish="onFinish" />
			</van-popup>
			<van-popup v-model="showFlag" :style="{ height: '60%',width: '100%',overflow:'hidden'}"
				:safe-area-inset-bottom="true" class="paypass">
				<div class="passPopup">
					<h4>请输入密码</h4>
					<van-password-input :value="value" :focused="showKeyboard" @focus="showKeyboard = true" />
				</div>
				<van-number-keyboard v-model="value" :show="showKeyboard" @blur="showKeyboard = false" />
			</van-popup>
		</div>
	</div>
</template>

<script>
	import {
		orderInfoAPI,
		payforAPI
	} from "../services/orders";
	export default {
		name: "Place-order",
		data() {
			return {
				show: false,
				showFlag: false,
				fieldValue: '',
				cascaderValue: '',
				disModel: '快递配送(免运费)',
				totalPrice: 0,
				value: '',
				showKeyboard: true,
				goods: [],
				options: [{
						text: '微信支付',
						value: '330000',
					},
					{
						text: '支付宝支付',
						value: '320000',
					},
					{
						text: '银行卡支付',
						value: '320001',
					}
				],
				currentContact: {
					name: '张三',
					tel: '13000000000',
					address: '北京是顺义区后沙峪镇铁匠村裕民路39好'
				},
			}
		},
		async created() {
			let payId = this.$store.state.payId;
			let {
				data,
				status,
				meg
			} = await orderInfoAPI({
				order_id: payId,
				uid: this.$store.state.userId
			});
			if (status == 1) {
				this.totalPrice = data['price'];
				this.goods = data['goods_infoss'];
			} else {
				this.$toast.fail(meg);
				this.$router.push({
					name: "Login"
				});
			}
			this.currentContact = this.$store.state['addressObj'] || {};
		},
		methods: {
			// 全部选项选择完毕后，会触发 finish 事件
			onFinish({
				selectedOptions
			}) {
				this.show = false;
				this.fieldValue = selectedOptions.map((option) => option.text).join('/');
			},
			onSubmit() {
				if (!this.currentContact['name'] || !this.fieldValue) {
					this.$toast("请把内容填写完整");
					return;
				}
				this.value = "";
				this.showKeyboard = true;
				this.showFlag = true;
			},
			onClickLeft() {
				this.$router.back(-1);
			},
			chooseAdress() {
				this.$router.push({
					name: "chooseAdress"
				})
			},
			onAdd() {
				this.$router.push({
					name: "chooseAdress"
				})
			},
			async payfor(obj) {
				let res = await payforAPI(obj);
				if (res.status == 1) {
					this.$toast.success("支付成功");
					this.$router.push({
						name: "Orders"
					});
				} else {
					this.$toast.fail(res.meg);
				}
			}
		},
		watch: {
			value(value) {
				if (value.length === 6 && value == '123456') {
					let obj = {
						uid: this.$store.state.userId,
						order_id: this.$store.state.payId,
						address: this.currentContact.address,
						phone: this.currentContact.tel,
						name: this.currentContact.name,
						pay_type: this.fieldValue, // 支付方式
						send_type: this.disModel // 配送方式
					};
					this.payfor(obj);
				} else if (value.length === 6 && value != '123456') {
					this.$toast.fail("密码错误");
				}
			}
		}
	};
</script>

<style>
	html,
	body,
	#app {
		height: 100%;
	}

	body {
		background-color: #EEE;
	}

	.place-order {
		background-color: #FFF;
	}

	.place-order .title {
		text-align: center;
		height: 30px;
		line-height: 30px;
		font-size: 18px;
		font-weight: 100;
		color: black;
		font-weight: bolder;
		border-bottom: 3px solid rgba(128, 128, 128, 0.11);
	}

	.order-pay {
		height: 100%;
	}

	.van-cell::after {
		border: none;
	}

	.passPopup {
		text-align: center;
	}

	.paypass {
		top: 70% !important;
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

	.van-col--2 .van-cell__right-icon {
		font-size: 26px;
	}
</style>
