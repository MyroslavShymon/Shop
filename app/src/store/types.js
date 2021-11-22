import {makeAutoObservable} from "mobx";
import {$host} from "../http";

class Types {
    types = {
        data: [],
        loading: true,
        message: '',
        error: false
    }

    constructor() {
        makeAutoObservable(this, {}, {deep: true});
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