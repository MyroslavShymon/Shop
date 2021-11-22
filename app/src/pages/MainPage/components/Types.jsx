import React, {useEffect} from 'react';
import {Col, Row, Spin} from "antd";
import types from "../../../store/types";
import {observer} from "mobx-react-lite";
import {NavLink} from "react-router-dom";

function Types(props) {
    useEffect(() => {
        (async () => await types.fetchTypes())();
    }, []);

    return (
        <Col span={4}>{types?.types?.data?.map(type =>
            <Row key={type.id}>
                {types?.types?.loading && <Spin size={"large"}/>}
                <NavLink to={`type/${type.id}`} className="type-name">
                    {type.name}
                </NavLink>
            </Row>)}
        </Col>
    );
}

export default observer(Types);