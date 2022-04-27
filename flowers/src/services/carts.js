import {post} from "../utils/request"
// 在详情页把某个商品加入购物车
export const insertModelAPI = (params) => post("/test/Shoppingcart/add",params)
// 加载购物车里面的所有商品
export const loadModelsAPI = (params) => post("/test/Shoppingcart/cartlist",params)
// 删除商品
export const delModelAPI = (params) => post("/text/Shoppingcart/delcart",params)
// 提交订单
export const addOrdersAPI = (params) => post("/test/Order/add",params)