import { post } from "../utils/request"
// 分类详情
// export const getCategoriesAPI = (params) => post("test/Goods/goodsinfo", params)
// 鲜花列表
export const loadProductsAPI = (params) => post("/test/Goods/list", params)