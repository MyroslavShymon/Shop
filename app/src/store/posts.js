import {makeAutoObservable} from "mobx";
import {$host} from "../http";

class Posts {
    posts = {
        message: "",
        data: [],
        type: '',
        error: ''
    }

    constructor() {
        makeAutoObservable(this, {}, {deep: true});
    }

    fetchPosts = async () => {
        try {
            const {data: postsResponse} = await $host.get(`posts`)

            this.posts = {
                message: "Пост получено",
                data: postsResponse,
                type: 'success'
            }

        } catch (e) {
            this.posts = {
                message: e?.response?.data?.error,
                type: 'error'
            }
        }
    }

    likePost = async (id) => {
        await $host.post(`posts/like/${id}`)
        console.log("this.posts.data[id]", this.posts.data[id])
        this.posts.data[id - 1].likes = this.posts.data[id - 1].likes + 1;
    }

    addPost = async (data) => {
        this.posts.data = await $host.post(`posts`, data)
        console.log("this.posts.data", this.posts.data)
    }
}

export default new Posts()