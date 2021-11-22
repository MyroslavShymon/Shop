import {makeAutoObservable} from "mobx";
import {$host} from "../http";
import {localStorageConstants} from "../core/constants/localStorage.constants";
import ErrorHandler from "./error/error.handler";
import types from "./types";

class Products {
    basketId = JSON.parse(localStorage.getItem(localStorageConstants.USER))?.basket;
    products = {
        data: [],
        loading: true,
        message: '',
        error: false
    }
    productToBasket = {
        data: [],
        loading: true,
        message: '',
        error: false
    }
    basket = {
        data: [],
        loading: true,
        message: '',
        error: false
    }

    constructor() {
        makeAutoObservable(this, {}, {deep: true});
    }
    //
    // changeIsInBasket = (data, productId, isInBasket, message) => {
    //     return {
    //         data: data.map(product => product.id === productId ? {
    //             ...product,
    //             isInBasket
    //         } : product),
    //         message
    //     }
    // }

    removeProductFromBasket = async (productId) => {
        try {
            this.productToBasket = {
                loading: true
            }
            const {data: productToBasket} = await $host.post(`api/product/remove/basket`, {
                basket_id: this.basketId,
                product_id: productId
            })

            this.products  = {
                data: this.products.data.map(product => product.id === productId ? {
                    ...product,
                    isInBasket: false
                } : product),
                message: "Продукт вилучнно з корзини"
            }
            types.products = {
                data: types.products.data.map(product => product.id === productId ? {
                    ...product,
                    isInBasket: false
                } : product),
                message: "Продукт вилучнно з корзини"
            }
            // this.products = {...this.changeIsInBasket(this.products, productId, false, "Продукт вилучнно з корзини")}
            // types.products = {...this.changeIsInBasket(types.products, productId, false, "Продукт вилучнно з корзини")}
            console.log(this.products, types.products )

            this.productToBasket = {
                data: productToBasket,
                loading: false
            }
        } catch (e) {
            this.productToBasket = ErrorHandler(e);
        }
    }

    addProductTooBasket = async (productId) => {
        // console.log("basketId", basketId, productId);
        try {
            this.productToBasket = {
                loading: true
            }
            const {data: productToBasket} = await $host.post(`api/product/basket`, {
                basket_id: this.basketId,
                product_id: productId
            })

            this.products  = {
                data: this.products.data.map(product => product.id === productId ? {
                    ...product,
                    isInBasket: true
                } : product),
                message: "Продукт в корзині"
            }
            types.products = {
                data: types.products.data.map(product => product.id === productId ? {
                    ...product,
                    isInBasket: true
                } : product),
                message: "Продукт в корзині"
            }
            // this.products = {...this.changeIsInBasket(this.products, productId, true, "Продукт в корзині")}
            // types.products = {...this.changeIsInBasket(types.products, productId, true, "Продукт в корзині")}
            // console.log(this.products, types.products )
            this.productToBasket = {
                data: productToBasket,
                loading: false
            }
        } catch (e) {
            this.productToBasket = ErrorHandler(e);
        }
    }

    isInBasket = async (products) => {
        const {data: productsInBasket} = await $host.get(`api/product/in-basket/${this.basketId}`)
        for (let i = 0; i < products.length; i++) {
            products[i].isInBasket = false
            for (let j = 0; j < productsInBasket.length; j++) {
                if (products[i].id === productsInBasket[j].product_id)
                    products[i].isInBasket = true;
            }
        }
        return products
    }

    fetchProductInBasket = async () => {
        try {
            this.basket = {
                loading: true
            }
            const {data: productsInBasket} = await $host.get(`api/product/in-basket/${this.basketId}`)
            // console.log("products", products)

            this.basket = {
                data: await productsInBasket,
                message: 'Продукти загружено успішно',
                loading: false
            }
        } catch (e) {
            this.basket = ErrorHandler(e);
        }
    }

    fetchProducts = async () => {
        try {
            this.products = {
                loading: true
            }
            const {data: products} = await $host.get(`api/product`)
            // console.log("products", products)

            this.products = {
                data: await this.isInBasket(products),
                message: 'Продукти загружено успішно',
                loading: false
            }
        } catch (e) {
            this.products = ErrorHandler(e);
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

const product = new Products();
export {product}