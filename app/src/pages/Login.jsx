import React from 'react';
import {useHistory} from "react-router-dom";
import user from "../store/user";
import {ROUTES_CONSTANTS_POSTS, ROUTES_CONSTANTS_REGISTRATION} from "../core/constants/routesConstants";
import {Alert, Button, Col, Form, Input, Row} from "antd";
import Checkbox from "antd/es/checkbox/Checkbox";
import {formItemsConstantLogin} from "../core/constants/formItemsConstantsLogin";
import {observer} from "mobx-react-lite";

function Login(props) {
    const history = useHistory()

    const onFinish = async (values) => {
        await user.login(values)

        if (user?.user?.type === "success") {
            history.push(ROUTES_CONSTANTS_POSTS)
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
            {formItemsConstantLogin.map(item =>
                <Form.Item
                    key={item.name}
                    label={item.label}
                    name={item.name}
                    rules={[{required: true, message: `Please input your ${item.name}!`}]}
                >
                    <Input/>
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
                        <Button type={'default'} onClick={() => history.push(ROUTES_CONSTANTS_REGISTRATION)}>There is no
                            account?</Button>
                    </Col>
                </Row>
            </Form.Item>
            {
                user.user.type === "error" &&
                <Form.Item>
                    <Alert type="error" message={user.user.message}/>
                </Form.Item>
            }
        </Form>
    );
}

export default observer(Login);