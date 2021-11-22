import React, {useEffect} from 'react';
import {Col, Row, Spin} from "antd";
import {observer} from "mobx-react-lite";
import "./index.css";
import Products from "../../layout/MainLayout/components/Products";
import Types from "../../layout/MainLayout/components/Types";

function Main(props) {
    return (
        <Row>
            <Types />
            <Products/>
        </Row>
    );
}

export default observer(Main);