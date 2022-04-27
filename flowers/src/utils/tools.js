

/**
 * 文件上传地址
 */
export const uploadUrl =  "http://sails.penkuoer.com/api/v1/common/upload_file";

export function setToken(token) {
    sessionStorage.setItem("token", token);
}

export function getToken() {
    return sessionStorage.getItem("token");
}

export function removeToken() {
    sessionStorage.removeItem("token");
}

export function isLogined() {
    return getToken() ? true : false;
}