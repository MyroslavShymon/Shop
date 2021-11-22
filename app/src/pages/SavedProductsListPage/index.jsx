import React, {useEffect} from 'react';
import {product} from "../../store/product";
import Product from "../../components/Product/Product";

function SavedProductsList(props) {
    useEffect(() => {
        (async () => await product.fetchProductInBasket())()
    }, []);

    return (
        <div style={{display: "flex", justifyContent: "space-between", flexWrap: "wrap"}}>{product.basket.data.map(product=> <Product buy={true} key={product.id} product={product}/> )}</div>
    );
}

export default SavedProductsList;