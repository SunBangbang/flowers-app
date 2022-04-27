<template>
	<div class="reg">
		<van-icon name="cross" class="back" @click="goHome" />
		<h2>注册账号</h2>
		<van-form @submit="onSubmit">
			<van-field v-model="username" name="name" label="用户名" placeholder="请输入用户名"
				:rules="[{ required: true, message: '请填写用户名' }]" />
			<van-field v-model="password" type="password" name="password" label="密码" placeholder="请输入密码"
				:rules="[{ required: true, message: '请填写密码' }]"></van-field>
			<van-field v-model="passwords" type="password" name="passwords" label="确认密码" placeholder="请再次输入密码"
				:rules="[{ required: true, message: '请填写密码' }]"></van-field>
			<van-field v-model="code" center clearable label="随机验证码" placeholder="请输入随机验证码">
				<template #button>
					<van-button native-type="button" size="small" type="primary" @click="getCode">{{codeNum}}</van-button>
				</template>
			</van-field>
			<div style="margin: 16px">
				<van-button round block type="info" native-type="submit">注册</van-button>
			</div>
		</van-form>
		<router-link class="b-link" :to="{ name: 'Login' }">已有账号，我要登录</router-link>
	</div>
</template>

<script>
	// eslint-disable-next-line no-unused-vars
	import {
		regAPI
	} from "../services/auth";
	// eslint-disable-next-line no-unused-vars
	// import { setToken } from "../utils/tools";

	export default {
		data() {
			return {
				username: "",
				password: "",
				passwords: "",
				code: "",
				codeNum: "随机验证码",
				codeStr: "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
			};
		},
		methods: {
			async onSubmit(values) {
				if(this.code == "随机验证码" || this.code != this.codeNum){
					this.$toast.fail("随机验证码错误");
					return;
				}
				if (this.password == this.passwords) {
					const res = await regAPI(values);
					if (res.status == 1) {
						this.$router.push({
							name: "Login"
						});
					} else {
						this.$toast.fail(res.meg);
					}
				} else {
					this.$toast.fail("密码不一致");
				}
			},
			goHome() {
				this.$router.push({
					name: "Home",
				});
			},
			// 随机数
			getRandom(n, m) {
				n = Number(n);
				m = Number(m);
				// 确保 m 始终大于 n
				if (n > m) {
					var temp = n;
					n = m;
					m = temp;
				}
				return Math.floor(Math.random() * (m - n) + n);
			},
			getCode() {
				let str = '';
				// 验证码有几位就循环几次
				for (let i = 0; i < 4; i++) {
					let ran = this.getRandom(0, 62);
					str += this.codeStr.charAt(ran);
				}
				this.codeNum = str;
			}
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
</style>
