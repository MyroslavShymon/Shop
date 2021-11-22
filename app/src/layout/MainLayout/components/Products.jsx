import React, {useEffect} from 'react';
import {Col, Spin} from "antd";
import product from "../../../store/product";
import Product from "../../../components/Product/Product";
import {observer} from "mobx-react-lite";

function Products(props) {
    useEffect(() => {
        (async () => await product.fetchProducts())();
    }, []);

    return (
        <Col span={20} className="card__wrapper">
            {product?.products?.loading && <Spin size={"large"}/>}
            {product?.products?.data?.map(product => <Product key={product.id} product={product}/>)}
        </Col>
    );
}

export default observer(Products);