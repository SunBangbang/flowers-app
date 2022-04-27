import {post} from "../utils/request"
// 删除订单
export const deleteOrdersAPI = (params) => post("/test/Order/delorder",params)
// 订单列表
export const orderListAPI = (params) => post("/test/Order/list",params)
// 订单详情
export const orderInfoAPI = (params) => post("/test/Order/orderinfo",params)
// 支付
export const payforAPI = (params) => post("/test/Order/pay",params)