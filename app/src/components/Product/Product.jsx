import React from 'react';
import {Card} from "antd";
import { LikeOutlined, DollarOutlined } from "@ant-design/icons";
import Meta from "antd/es/card/Meta";
import Avatar from "antd/es/avatar/avatar";
import "./index.css"
import {$url} from "../../http";

function Product({product}) {
    return (
        <Card
            className="product-card"
            cover={
                <img height={200}
                    alt={product.name}
                    src={$url + product.image}
                />
            }
            actions={[
                <DollarOutlined />,
                <LikeOutlined />
            ]}
        >
            <Meta
                avatar={<Avatar src="https://joeschmoe.io/api/v1/random" />}
                title={product.name}
                description={"Ціна: " + product.price + " грн"}
            />
        </Card>
    );
}

export default Product;