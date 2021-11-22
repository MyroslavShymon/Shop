import React, {useEffect} from 'react';
import {Button, Card, message,} from "antd";
import {LikeOutlined, DollarOutlined, DollarCircleFilled} from "@ant-design/icons";
import Meta from "antd/es/card/Meta";
import Avatar from "antd/es/avatar/avatar";
import "./index.css"
import {$url} from "../../http";
import {product as productStore} from "../../store/product";
import {observer} from "mobx-react-lite";
import user from "../../store/user";
import {useHistory} from "react-router-dom";

function Product({product, buy}) {
    const history = useHistory()
    // console.log(product.user_id !== user?.user?.data?.data?.user?.id)
    return (
        <Card
            className="product-card"
            cover={
                <img height={200}
                     alt={product.name}
                     onClick={() => {
                         history.location.pathname = `/`
                         history.push(`product/${product.id}`)
                     }}
                     src={$url + product.image}
                />
            }
            actions={buy ? [<Button
                    onClick={() => message.success(`Продукт куплено з рахнку знято ${product.price}`)}>Купити</Button>] :
                (product.user_id !== user?.user?.data?.data?.user?.id ? [
                    product.isInBasket ?
                        <DollarCircleFilled onClick={() => productStore.removeProductFromBasket(product.id)}/> :
                        <DollarOutlined onClick={() => productStore.addProductTooBasket(product.id)}/>,
                    <LikeOutlined/>
                ] : [
                    <LikeOutlined/>
                ])}
        >
            <Meta
                avatar={<Avatar src="https://joeschmoe.io/api/v1/random"/>}
                title={product.name}
                description={"Ціна: " + product.price + " грн"}
            />
        </Card>
    );
}

export default observer(Product);