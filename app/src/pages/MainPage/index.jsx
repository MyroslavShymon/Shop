import React, {useEffect} from 'react';
import {Col, Row, Spin} from "antd";
import {observer} from "mobx-react-lite";
import "./index.css";
import Types from "./components/Types";
import Products from "./components/Products";

function Main(props) {
    return (
        <Row>
            <Types />
            <Products/>
        </Row>
    );
}

export default observer(Main);