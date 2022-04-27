<template>
	<div class="choose-address">
		<van-nav-bar title="地址选择" left-text="返回" left-arrow @click-left="onClickLeft" />
		<!-- 地址编辑 -->
		<van-address-list v-model="chosenAddressId" :list="list" :disabled-list="disabledList"
			disabled-text="以下地址超出配送范围" default-tag-text="默认" @add="onAdd" @edit="onEdit" @select="selectAddress" />
		<!-- 添加地址 -->
		<van-popup v-model="show" closeable position="bottom" :style="{ height: '80%' }">
			<div class="add-address">
				<van-address-edit ref="addressEdit" :area-list="areaList" show-postal show-delete show-set-default :area-columns-placeholder="['请选择', '请选择', '请选择']" @save="onSave" @delete="onDelete" :address-info="addressInfo" />
			</div>
		</van-popup>
	</div>
</template>

<script>
	import {
		areaList
	} from '@vant/area-data';
	export default {
		name: "chooseAdress",
		data() {
			return {
				show: false,
				chosenAddressId: '1',
				areaList,
				addressInfo: {},
				// searchResult: [],
				list: [{
						id: '1',
						name: '张三',
						tel: '13179865499',
						areaCode: '330106',
						postalCode: '123456',
						addressDetail: '文三路 138 号东方通信大厦 7 楼 501 室',
						isDefault: true,
						address: '浙江省杭州市西湖区文三路 138 号东方通信大厦 7 楼 501 室'
					},
					{
						id: '2',
						name: '李四',
						tel: '13189124863',
						areaCode: '330105',
						postalCode: '',
						addressDetail: '莫干山路 50 号',
						address: '浙江省杭州市拱墅区莫干山路 50 号',
					}
				],
				disabledList: [{
					id: '3',
					name: '王五',
					tel: '13237895624',
					areaCode: '330108',
					postalCode: '',
					addressDetail: '江南大道 15 号',
					address: '浙江省杭州市滨江区江南大道 15 号',
				}],

			}
		},
		created() {
			this.chosenAddressId = this.$store.state.addressObj['id'] || 1;
		},
		methods: {
			// 地址编辑保存
			onSave(content) {
				if(content.isDefault){
					this.chosenAddressId = content.areacode;
					this.list.map(item=>item.isDefault = false);
				}
				this.list.push({
					...content,
					id: content['areacode'],
					address: content['province'] + content['city'] + content['county'] + content['addressDetail']
				});
				this.show = false;
			},
			// 地址删除
			onDelete() {
				this.$toast('delete');
			},
			selectAddress(item) {
				this.$store.commit("changeAddress", item);
				this.$router.push({
					name: "Place-order"
				});
			},
			// // 修改详细地址时触发
			// onChangeDetail(val) {
			// 	if (val) {
			// 		this.searchResult = [{
			// 			name: '黄龙万科中心',
			// 			address: '杭州市西湖区',
			// 		}, ];
			// 	} else {
			// 		this.searchResult = [];
			// 	}
			// },
			// 返回按钮
			onClickLeft() {
				let data = {};
				this.list.map(item=>(this.chosenAddressId == item.id && (data = item)));
				this.$store.commit("changeAddress",data);
				this.$router.back(-1);
			},
			// 新增地址
			onAdd() {
				this.show = true;
			},
			// 点击编辑
			onEdit(item){
				console.log(item);
				this.addressInfo = item;
				this.show = true;
			},
		}
	}
</script>

<style>
	html,body, #app{
		height: 100%;
	}
	
	.choose-address {
		height: 100%;
		background-color: #fafafa;
	}

	.choose-address .van-popup {
		bottom: 0 !important;
	}
	

	.add-address {
		margin-top: 35px;
	}
	
	.choose-address .van-address-list {
		height: auto;
	}
</style>
