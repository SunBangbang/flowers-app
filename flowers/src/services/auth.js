// eslint-disable-next-line no-unused-vars
import { post } from "../utils/request";

export const loginAPI = (data) => post("/test/Signup/login", data);

export const regAPI = (data) => post("/test/Signup/register", data);

export const loginoutAPI = (data) => post("/test/Signup/logout", data);