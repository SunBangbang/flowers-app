import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
  state: {
		detailId: sessionStorage.getItem("detailId")||"",
		userId: sessionStorage.getItem("userId")||"",
		addressObj: sessionStorage.getItem("addressObj")||"",
		orderDetailId: sessionStorage.getItem("orderDetailId")||"",
		payId: sessionStorage.getItem("orderDetailId")||"",
  },
  mutations: {
		setDetailId(state,id){
			sessionStorage.setItem('detailId',id);
			state.detailId = id;
		},
		setUserId(state,id){
			sessionStorage.setItem('userId',id);
			state.userId = id;
		},
		changeAddress(state,data){
			sessionStorage.setItem('addressObj',data);
			state.addressObj = data;
		},
		setOrderDetailId(state,id){
			sessionStorage.setItem('orderDetailId',id);
			state.orderDetailId = id;
		},
		setPayId(state,id){
			sessionStorage.setItem('payId',id);
			state.payId = id;
		}
  },
  actions: {
  },
  modules: {
  }
})
