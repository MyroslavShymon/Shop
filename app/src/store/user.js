import {makeAutoObservable} from "mobx";
import {$host} from "../http";
import ErrorHandler from "./error/error.handler";

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
        const userData = JSON.parse(localStorage.getItem('user'));
        if (userData) {
            this.isAuth = true
        }
        if (userData?.data?.role?.find(role => role.name === "Admin")) {
            this.isAdmin = true
        }
    }

    login = async (user) => {
        try {
            this.user = {loading: true}
            const {data: userResponse} = await $host.post(`api/auth/login`, user)

            localStorage.setItem("user", JSON.stringify(userResponse))

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
            localStorage.setItem("user", JSON.stringify(userResponse))

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