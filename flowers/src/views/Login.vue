<template>
	<div class="login">
		<van-icon name="cross" class="back" @click="goHome" />
		<h2>账号密码登录</h2>
		<van-form @submit="onSubmit">
			<van-field v-model="username" name="name" label="用户名" placeholder="请输入用户名"
				:rules="[{ required: true, message: '请填写用户名' }]" />
			<br />
			<van-field v-model="password" type="password" name="password" label="密码" placeholder="请输入密码"
				:rules="[{ required: true, message: '请填写密码' }]"></van-field>

			<van-row class="note">
				<van-col span="2">
					<van-radio-group v-model="radio">
						<van-radio name="1" label-disabled></van-radio>
					</van-radio-group>
				</van-col>
				<van-col span="22">
					我已阅读并同意<span>《一树鲜花隐私政策》</span>、<span>《一树鲜花用户协议》</span>并使用手机号码登录
				</van-col>
			</van-row>
			<div style="margin: 16px">
				<van-button round block type="info" native-type="submit">提交</van-button>
			</div>
		</van-form>
		<router-link class="b-link" :to="{ name: 'Reg' }">没有账号，我要注册</router-link>
	</div>
</template>

<script>
	// eslint-disable-next-line no-unused-vars
	import {
		loginAPI
	} from "../services/auth";
	// eslint-disable-next-line no-unused-vars
	import {
		setToken
	} from "../utils/tools";
	export default {
		data() {
			return {
				username: "",
				password: "",
				radio: ""
			};
		},
		methods: {
			async onSubmit(values) {
				if(this.radio !== '1'){
					this.$toast("请先确定已阅读协议");
					return;
				}
				// eslint-disable-next-line no-unused-vars
				const res = await loginAPI(values);
				if (res.status == 1) {
					setToken(res.data['token']);
					this.$store.commit("setUserId", res.data['id'])
					this.$toast.success("登陆成功");
					this.$router.replace({
						name: "User",
					});
				} else {
					this.$toast.fail(res.meg);
				}
			},
			goHome() {
				this.$router.push({
					name: "Home"
				});
			},
		},
	};
</script>

<style scoped>
	.back {
		font-size: 1.5rem;
		margin: 1rem 0 0 1rem;
	}

	h2 {
		width: 100%;
		height: 6rem;
		text-align: center;
		line-height: 6rem;
		font-weight: 400;
	}

	.b-link {
		font-size: 0.8rem;
		float: right;
		margin-right: 2rem;
	}
	
	.van-radio-group {
		display: flex;
		justify-content: right;
	}

	.note {
		margin-top: 15px;
		font-size: 14px;
	}
	
	.note .van-col--22 {
		padding-left: 10px;
	}
	
	.note span{
		color: orange;
	}
</style>
