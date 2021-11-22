import React from 'react';
import {Col, Layout, Row} from "antd";

function EmptyLayout({children}) {
    return (
        <Layout style={{minHeight: "100vh"}}>
            <Row justify={"center"} align={"middle"} style={{minHeight: "calc(100vh - 250px)"}}>
                <Col className="gutter-row" span={8}>
                    {children}
                </Col>
            </Row>
        </Layout>
    );
}

export default EmptyLayout;