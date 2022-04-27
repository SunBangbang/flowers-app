import { get, post } from "../utils/request"
export const loadProductsAPI = (params) => get("/test/v1/products", params)
// 加载商品详情
export const loadItemDetailsAPI = (params) => post("/test/Goods/goodsinfo", params)
// export const loadModelOneAPI = (id) => get("/api/v1/products/" + id)