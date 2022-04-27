import axios from "axios"
import Nprogress from "nprogress"
import "nprogress/nprogress.css";
import qs from 'qs';
// eslint-disable-next-line no-unused-vars
import {
	getToken
} from "../utils/tools";

// 创建一个instance实例,用来做请求拦截和响应拦截
const instance = axios.create({
	timeout: 5000,
	// baseURL: "http://sails.penkuoer.com"
	baseURL: process.env.VUE_HOST,
	headers: {
		"Content-Type": "application/x-www-form-urlencoded"
	}
})

instance.interceptors.request.use(
	(config) => {
		config.headers["token"] = getToken();
		Nprogress.start()
		// console.log("这是全局请求拦截,config是:", config)

		return config
	},
	function(error) {
		return Promise.reject(error);
	}
)
instance.interceptors.response.use(
	function(response) {
		Nprogress.done()
		// console.log("这是全局响应拦截,返回的结果是:", response)
		return response.data
	},
	function(error) {
		/* if (error.response?.status === 401) {
		    window.location.href = "/#/login";
		} */
		console.dir(error)
		if (error.response) {
			if (error.response.status == 401) {
				// console.log("还未登陆")

				// window.location.href="/#/login"
			}
		}

		Nprogress.done()

	}
)

//get请求
export function get(url, params) {
	return instance.get(url, {
		params
	})
}
// post请求
export function post(url, data) {
	return instance.post(url, qs.stringify(data))
}

export const put = (url, data) => instance.put(url, data);
export const del = (url) => instance.delete(url);
