import * as React from 'react';
import {Layout, Menu} from "antd";
import {Content} from "antd/es/layout/layout";
import Sider from "antd/es/layout/Sider";
import {NavLink, useHistory, useLocation} from "react-router-dom";
import {useState} from "react";
import {menu} from "./menu.constant";
import {ROUTES_CONSTANTS_LOGIN} from "../../core/constants/routesConstants";
import {LogoutOutlined} from "@ant-design/icons";
import {observer} from "mobx-react-lite";

const  MainLayout = ({children}) => {
    const location = useLocation();
    const history = useHistory();
    const [collapsed, setCollapsed] = useState(false);

    const logout = () => {
        // user.logout()
        history.push(ROUTES_CONSTANTS_LOGIN)
    }

    return (
        <div>
            <Layout>
                <Sider className={"sidebar"} collapsible onCollapse={() => setCollapsed(!collapsed)}>
                    <div className="logo"/>
                    <Menu theme="dark" mode="inline" selectedKeys={[location.pathname]}>
                        {menu.map(item =>
                            <Menu.Item key={item.link} icon={item.icon}>
                                <NavLink to={item.link}>
                                    {item.title}
                                </NavLink>
                            </Menu.Item>
                        )}
                        <Menu.Item onClick={logout} key={"logout"} icon={<LogoutOutlined style={{fontSize: "150%"}}/>}>Logout</Menu.Item>
                    </Menu>
                </Sider>
                <Layout className="site-layout">
                    <Content style={{minHeight: "100vh"}}>
                        <div className="site-layout-background" style={{padding: 24, textAlign: 'center'}}>
                            {children}
                        </div>
                    </Content>
                </Layout>
            </Layout>
        </div>
    );
};

export default observer(MainLayout)