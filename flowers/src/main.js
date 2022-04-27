import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import Vant from 'vant';
import moment from "moment";
import 'vant/lib/index.css';
Vue.use(Vant);

// 过滤图片,有的图片不是以http开头的,无法加载,如果图片地址为空,返回一个默认图片  
Vue.filter("dalImg", (url) => {
	if (url) { // 图片有url地址 
		if (url.startsWith("http")) {
			return url // 有url地址并以http开头时就返回url,不做任何操作
		}
		return "http://sails.penkuoer.com" + url // 有url地址但不是以http开头,在此加上域名
	}
	return "https://img0.baidu.com/it/u=3052501589,3276694511&fm=26&fmt=auto" // 没有图片时返回此默认图片
})

// 自定义时间过滤器
Vue.filter("dateFormat", (date) => {
	return moment(date).format("YYYY-MM-DD HH:SS:MM") // 可以自己需求设置时间格式
})

Vue.config.productionTip = false

new Vue({
	router,
	store,
	render: h => h(App)
}).$mount('#app')
