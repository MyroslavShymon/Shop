import {makeAutoObservable} from "mobx";
import {$host} from "../http";

class Products {
    products = {
        data: [],
        loading: true,
        message: '',
        error: false
    }

    constructor() {
        makeAutoObservable(this, {}, {deep: true});
    }

    fetchProducts = async () => {
        try {
            this.products = {
                loading: true
            }
            const {data: product} = await $host.get(`api/product`)

            this.products = {
                data: product,
                message: 'Продукти загружено успішно',
                loading: false
            }

        } catch (e) {
            console.log(e?.response);
            this.products = {
                message: e?.response?.data,
                loading: false,
                error: true
            }
        }
    }
    //
    // likePost = async (id) => {
    //     await $host.post(`posts/like/${id}`)
    //     console.log("this.posts.data[id]", this.posts.data[id])
    //     this.posts.data[id - 1].likes = this.posts.data[id - 1].likes + 1;
    // }
    //
    // addPost = async (data) => {
    //     this.posts.data = await $host.post(`posts`, data)
    //     console.log("this.posts.data", this.posts.data)
    // }
}

export default new Products()