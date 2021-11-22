import React, {useEffect} from 'react';
import {useParams} from "react-router-dom";
import types from "../../store/types";
import {product} from "../../store/product";
import {Alert, Col, message, Row} from "antd";
import Product from "../../components/Product/Product";
import {observer} from "mobx-react-lite";
import Title from "antd/es/typography/Title";

function ProductType(props) {
    const {id} = useParams();
    console.log(id)
    useEffect(() => {
        (async () => await types.fetchProductsByTypes(id))();
        (async () => await types.fetchType(id))();
    }, []);

    // useEffect(() => {
    //     if (product.products.message)
    //         message.error(product.products.message);
    // }, [types.products.error]);

    return (
        <Row>
            <Col span={24}>
                <Title>{types?.type?.data?.name}</Title>
                {types?.products?.data?.length ?
                    <div style={{display: "flex", justifyContent: "space-between", flexWrap: "wrap"}}>
                        {types?.products?.data?.map(product => <Product key={product.id} product={product}/>)}
                    </div> : <Alert message="Немає продуктів з цим типом" type="warning"/>}
            </Col>
        </Row>
    );
}

export default observer(ProductType);