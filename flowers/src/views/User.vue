<template>
	<div class="user">
		<div class="userTop">
			<van-icon name="setting-o" class="ico" @click="toLogout" />
			<van-image round width="6rem" height="6rem" :src="user.avatar | dalImg" class="userImg" />
			<p class="nickName" @click="toLoginOrModifyInfo">
				{{ user.nickName ? user.nickName : user.userName }}
			</p>
			<div class="regBtn" style="margin-top: 5px; font-size: 14px">
				<van-icon name="star" /><button @click="toReg" style="margin-left: 10px">
					注册会员
				</button>
			</div>
		</div>
		<div class="order">
			<van-cell-group class="orderTop">
				<span>我的订单</span>
				<span @click="gotoOrder">全部订单</span>
			</van-cell-group>
			<van-grid :column-num="3">
				<van-grid-item v-for="value in order" :key="value.id" :icon="value.icon" :text="value.txt"
					class="orderBot" />
			</van-grid>
		</div>
		<div class="userList">
			<van-grid :column-num="4">
				<van-grid-item v-for="value in userInfo" :key="value.id" :icon="value.icon" :text="value.text"
					class="orderBot" />
			</van-grid>
		</div>
		<van-swipe-cell class="userManage">
			<van-cell :border="false" title="账户管理" value="" />
			<van-cell :border="false" title="支付中心" value="" />
			<van-cell :border="false" title="地址管理" value="管理收货地址" />
		</van-swipe-cell>
		<br />
		<br />
		<br />
	</div>
</template>

<script>
	import {
		loadUserInfoAPI
	} from "../services/user";
	export default {
		data() {
			return {
				user: {
					userName: "立即登录",
					avatar: "https://img2.baidu.com/it/u=289538718,2137491427&fm=26&fmt=auto",
				},
				order: [{
						id: 1,
						icon: "cash-back-record",
						txt: "待付款",
					},
					{
						id: 2,
						icon: "logistics",
						txt: "今日配送",
					},
					{
						id: 3,
						icon: "chat-o",
						txt: "待评价",
					},
				],
				userInfo: [{
						id: 1,
						icon: "coupon-o",
						text: "优惠券",
					},
					{
						id: 2,
						icon: "vip-card-o",
						text: "权益卡",
					},
					{
						id: 3,
						icon: "diamond-o",
						text: "积分",
					},
					{
						id: 4,
						icon: "shop-o",
						text: "生日/纪念日",
					},
					{
						id: 5,
						icon: "like-o",
						text: "我的收藏",
					},
					{
						id: 6,
						icon: "phone-o",
						text: "联系客服",
					},
					{
						id: 7,
						icon: "search",
						text: "帮助",
					},
					{
						id: 8,
						icon: "ellipsis",
						text: "关于For you",
					},
				],
			};
		},
		methods: {
			toLogout() {
				this.$router.push({
					name: "Logout",
				});
			},
			toReg() {
				this.$router.push({
					name: "Reg"
				});
				// console.log("去注册页面")
			},
			toLoginOrModifyInfo() {
				if (this.user.id) {
					// 如果已经登录的话,点击用户名会进到这里面,跳转到修改信息页
					this.$router.push({
						name: "ModifyInfo"
					});
					// this.$router.push({ name: "UserInfo" });
				} else {
					// 如果没有登录,点击立即登录会跳转到登录界面
					this.$router.push({
						name: "Login"
					});
				}
			},
			async loadData() {
				let id = this.$store.state.userId || "";
				await loadUserInfoAPI({
					id
				}).then((res) => {
					if (res.status == 1) {

						this.user = {
							...res.data
						};
					}
				});

				//  console.log(this.user)
			},
			gotoOrder() {
				this.$router.push({
					name: "Orders"
				});
			}
		},
		// 一进来这个页面就去加载用户信息
		created() {
			this.loadData();
		},
	};
</script>

<style scoped>
	.ico {
		display: block;
		float: left;
		font-size: 30px;
		color: white;
		float: right;
		margin-right: 2rem;
		margin-top: 2rem;
	}

	.userImg {
		display: block;
		float: left;
		margin: 2rem 0 0 2rem;
	}

	.nickName {
		float: left;
		color: white;
		margin-top: 3rem;
		margin-left: 1rem;
	}

	.regBtn {
		position: absolute;
		top: 4.6rem;
		left: 8rem;
		float: left;
		color: white;
		padding-left: 1rem;
	}

	.regBtn button {
		border: none;
		background: #999;
	}

	.userTop {
		position: relative;
		width: 100%;
		height: 190px;
		background: url(../assets/userimg1.jpg);
		background-size: 100% 100%;
	}

	.order {
		width: 92%;
		margin: 0 auto;
		border-radius: 16px;
		overflow: hidden;
		margin-top: -2.8rem;
	}

	.van-grid-item__content {
		background-color: #e9e9e9;
	}

	.van-cell-group {
		display: flex;
		justify-content: space-between;
		padding: .8rem 2rem;

	}

	.order {
		background-color: #e9e9e9;
	}

	.orderTop {
		background-color: #e9e9e9;
	}

	/* .orderBot {
   background-color: #e9e9e9 !important;
}
 */
	[class*="van-hairline"]::after {
		border: none;
	}

	/* [class*=van-hairline]::after */
	.userList {
		width: 92%;
		margin: 0 auto;
		margin-top: 1rem;
		margin-bottom: 0.7rem;
		border-radius: 16px;
		overflow: hidden;
	}

	.userManage {
		width: 92%;
		margin: 0 auto;
		border-radius: 16px;
		overflow: hidden;
	}

	.van-cell {
		background-color: #e9e9e9;
	}
</style>
