import {get} from "../utils/request"
export const loadBannersAPI = function(){
    return get("/api/v1/banners")
}