import { put, post } from "../utils/request"



/**
 * 获取用户信息
 */
export const loadUserInfoAPI = (params) => post("/test/Signup/userinfo",params);

export const modifyUserInfoAPI = (data) => put("/api/v1/user/modify", data);
