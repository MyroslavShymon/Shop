import React from 'react';
import {useHistory} from "react-router-dom";
// import user from "../store/user";
import {Alert, Button, Col, Form, Input, Row} from "antd";
import Checkbox from "antd/es/checkbox/Checkbox"
import {observer} from "mobx-react-lite";
import {routesConstant} from "../../core/constants/router/routes.constant";
import {formItemsConstant} from "./environment/constants/formItems.constant";
import user from "../../store/user";

function Login(props) {
    const history = useHistory()

    const onFinish = async (values) => {
        await user.login(values)

        if (!user?.user?.error) {
            history.push(routesConstant.main)
        }
    };

    return (
        <Form
            name="basic"
            initialValues={{remember: true}}
            onFinish={onFinish}
            // onFinishFailed={onFinishFailed}
            layout={"vertical"}
            autoComplete="off"
        >
            {formItemsConstant.map(item =>
                <Form.Item
                    key={item.name}
                    label={item.label}
                    name={item.name}
                    rules={[{required: true, message: `Please input your ${item.name}!`}]}
                >
                    {item.name === "password" ? <Input.Password/>: <Input/>}
                </Form.Item>
            )}

            <Form.Item name="remember" valuePropName="checked">
                <Checkbox>Remember me</Checkbox>
            </Form.Item>

            <Form.Item>
                <Row justify={'space-between'}>
                    <Col>
                        <Button type="primary" htmlType="submit">
                            Login
                        </Button>
                    </Col>
                    <Col>
                        <Button type={'default'} onClick={() => history.push(routesConstant.registration)}>There is no
                            account?</Button>
                    </Col>
                </Row>
            </Form.Item>
            {
                user?.user?.error &&
                <Form.Item>
                    <Alert type="error" message={user.user.message}/>
                </Form.Item>
            }
        </Form>
    );
}

export default observer(Login);