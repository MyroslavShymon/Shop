import React, {useEffect} from 'react';
import {useParams} from "react-router-dom";
import {$host} from "../../http";

function Product(props) {
    const {id} = useParams();

    // useEffect(() => {
    //     const {data: type} = await $host.get(`api/type/${id}`)
    // }, []);


    return (
        <div>{id}</div>
    );
}

export default Product;