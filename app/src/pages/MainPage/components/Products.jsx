import React, {useEffect} from 'react';
import {Col, message, Spin} from "antd";
import {product} from "../../../store/product";
import Product from "../../../components/Product/Product";
import {observer} from "mobx-react-lite";

function Products(props) {
    useEffect(() => {
        (async () => await product.fetchProducts())();
    }, []);

    // useEffect(() => {
    //     if (product.productToBasket.message)
    //         message.error(product.productToBasket.message);
    // }, [product.productToBasket.error]);
    useEffect(() => {
        if (product.products.message)
            message.error(product.products.message);
    }, [product.products.error]);
    useEffect(() => {
        if (product.products.message && !product.products.error)
            message.success(product.products.message);
    }, [product.products.message]);

    return (
        <Col span={20} className="card__wrapper">
            {product?.products?.loading && <Spin size={"large"}/>}
            {product?.products?.data?.map(product => <Product key={product.id} product={product}/>)}
        </Col>
    );
}

export default observer(Products);