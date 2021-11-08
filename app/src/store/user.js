import {makeAutoObservable} from "mobx";
import {$host} from "../http";

class User {
    user = {}

    constructor() {
        makeAutoObservable(this, {}, {deep: true});
    }

    login = async (user) => {
        try {
            const {data: userResponse} = await $host.post(`auth/login`, user)
            console.log("user login", userResponse)
            localStorage.setItem("user", JSON.stringify(userResponse))
            this.user = {
                message: "Залогінений",
                data: userResponse,
                type: 'success'
            }

        } catch (e) {
            this.user = {
                message: e?.response?.data?.message,
                type: 'error'
            }
        }
    }

    registration = async (user) => {
        try {
            const {data: userResponse} = await $host.post(`auth/registration`, user)
            console.log("user register", userResponse)
            localStorage.setItem("user", JSON.stringify(userResponse))
            this.user = {
                message: "Зареєстрований",
                data: userResponse,
                type: 'success'
            }

        } catch (e) {
            this.user = {
                message: e?.response?.data?.message,
                type: 'error'
            }
        }
    }
}

export default new User()