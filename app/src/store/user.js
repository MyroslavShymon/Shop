import {makeAutoObservable} from "mobx";
import {$host} from "../http";
import ErrorHandler from "./error/error.handler";
import {localStorageConstants} from "../core/constants/localStorage.constants";

class User {
    isAdmin = false
    isAuth = false
    user = {
        data: [],
        loading: false,
        message: '',
        error: false
    }

    constructor() {
        makeAutoObservable(this, {}, {deep: true});
    }

    getToken = () => {
        const userData = JSON.parse(localStorage.getItem(localStorageConstants.USER));
        this.user.data = userData;
        if (userData) {
            this.isAuth = true
        }
        if (userData?.data?.role?.find(role => role.name === "Admin")) {
            this.isAdmin = true
        }
    }

    setToken = () => {
        localStorage.removeItem(localStorageConstants.USER)
    }

    logout = () => {
        this.user = {};
        this.isAuth = false;
        this.isAdmin = false;
        this.setToken();
    }

    login = async (user) => {
        try {
            this.user = {loading: true}
            const {data: userResponse} = await $host.post(`api/auth/login`, user)

            localStorage.setItem(localStorageConstants.USER, JSON.stringify(userResponse))

            this.user = {
                message: "Залогінений",
                data: userResponse,
                loading: false
            }
            this.getToken()

        } catch (e) {
            this.user = ErrorHandler(e);
        }
    }

    registration = async (user) => {
        try {
            this.user = {loading: true}
            const {data: userResponse} = await $host.post(`api/auth/registration`, user)
            console.log("user register", userResponse)
            localStorage.setItem(localStorageConstants.USER, JSON.stringify(userResponse))

            this.user = {
                message: "Зареєстрований",
                data: userResponse,
                type: 'success'
            }
            this.getToken()

        } catch (e) {
            this.user = ErrorHandler(e);
        }
    }
}

export default new User()