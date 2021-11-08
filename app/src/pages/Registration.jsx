import React from 'react';
import {useHistory} from "react-router-dom";
import user from "../store/user";
import {
    ROUTES_CONSTANTS_LOGIN,
    ROUTES_CONSTANTS_POSTS,
    ROUTES_CONSTANTS_REGISTRATION
} from "../core/constants/routesConstants";
import {Alert, Button, Col, Form, Input, Row} from "antd";
import {formItemsConstantLogin} from "../core/constants/formItemsConstantsLogin";
import Checkbox from "antd/es/checkbox/Checkbox";
import {formItemsConstantsRegistration} from "../core/constants/formItemsConstantsRegistration";

function Registration(props) {
    const history = useHistory()

    const onFinish = async (values) => {
        await user.registration(values)

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
            {formItemsConstantsRegistration.map(item =>
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
                            Register
                        </Button>
                    </Col>
                    <Col>
                        <Button type={'default'} onClick={() => history.push(ROUTES_CONSTANTS_LOGIN)}>There is
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
        </Form>)
}

export default Registration;