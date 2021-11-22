import {makeAutoObservable} from "mobx";
import {$host} from "../http";
import ErrorHandler from "./error/error.handler";
import {product} from "./product";

class Types {
    type = {
        data: [],
        loading: true,
        message: '',
        error: false
    }
    types = {
        data: [],
        loading: true,
        message: '',
        error: false
    }
    products = {
        data: [],
        loading: true,
        message: '',
        error: false
    }

    constructor() {
        makeAutoObservable(this, {}, {deep: true});
    }

    fetchType = async (id) => {
        try {
            this.type = {
                loading: true
            }
            const {data: type} = await $host.get(`api/type/${id}`)

            this.type = {
                data: type,
                message: 'Тип загружено успішно',
                loading: false
            }
            console.log(this.products)
        } catch (e) {
            this.type = ErrorHandler(e);
        }
    }
    fetchProductsByTypes = async (id) => {
        try {
            this.products = {
                loading: true
            }
            const {data: products} = await $host.get(`api/product/type/${id}`)

            this.products = {
                data:  await product.isInBasket(products),
                message: 'Продукти загружено успішно',
                loading: false
            }
            console.log(this.products)
        } catch (e) {
            this.products = ErrorHandler(e);
        }
    }

    fetchTypes = async () => {
        try {
            this.types = {
                loading: true
            }
            const {data: type} = await $host.get(`api/type`)

            this.types = {
                data: type,
                message: 'Тип загружено успішно',
                loading: false
            }

        } catch (e) {
            console.log(e?.response);
            this.types = {
                message: e?.response?.data,
                loading: false,
                error: true
            }
        }
    }
}

export default new Types()