import * as React from 'react';
import {Col, Layout, Menu, Row} from "antd";
import {Content, Header} from "antd/es/layout/layout";
import {NavLink, useHistory, useLocation} from "react-router-dom";
import {useState} from "react";
import {menu} from "./environment/constants/menu.constant";
// import {ROUTES_CONSTANTS_LOGIN} from "../core/constants/router/routesConstant";
import {LogoutOutlined} from "@ant-design/icons";
import {observer} from "mobx-react-lite";
import Title from "antd/es/typography/Title";
import {routesConstant} from "../../core/constants/router/routes.constant";
import "./index.css"
import user from "../../store/user";

const MainLayout = ({children}) => {
    const location = useLocation();
    const history = useHistory();
    // const [collapsed, setCollapsed] = useState(false);

    // const logout = () => {
    //     // user.logout()
    //     history.push(ROUTES_CONSTANTS_LOGIN)
    // }

    return (
        <Layout>
            <Header className="main-layout__header"
                // collapsible
                // onCollapse={() => setCollapsed(!collapsed)}
            >
                <Row align={'middle'}> {/*<div className="logo"/>*/}
                    <Col span={3}>
                        <Title className="main-layout__title"
                               onClick={() => history.push(routesConstant.main)}>Shop</Title>
                    </Col>
                    {/*<Col span={9}></Col>*/}
                    <Col span={18} className="main-layout__menu">
                        <Menu theme="dark" mode="horizontal" selectedKeys={[location.pathname]}>

                            {/*    <Menu.Item key={"logout"}*/}
                            {/*               icon={<LogoutOutlined style={{fontSize: "150%"}}/>}>Logout</Menu.Item>*/}
                            {menu.map(item =>
                                <Menu.Item key={item.link} icon={item.icon}>
                                    <NavLink to={item.link}>
                                        {item.title}
                                    </NavLink>
                                </Menu.Item>
                            )}
                            <Menu.Item onClick={() => user.logout()} key={"logout"}
                                       icon={<LogoutOutlined style={{fontSize: "115%"}}/>}>
                                <NavLink to={routesConstant.login}/>
                            </Menu.Item>
                        </Menu>
                    </Col>
                </Row>
            </Header>
            <Content className="site-layout main-layout__content">
                <Row justify={'center'}>
                    <Col span={18}>

                        <Layout className="site-layout">
                            <Content className="main-layout__wrapper">
                                <div className="site-layout-background main-layout">
                                    {children}
                                </div>
                            </Content>
                        </Layout>
                    </Col>
                </Row>
            </Content>
        </Layout>
    );
};

export default observer(MainLayout)