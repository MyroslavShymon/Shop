import React, {useState} from 'react';
import Title from "antd/es/typography/Title";
import {Button, Col, Form, Input, Row, Upload} from "antd";
import user from "../store/user";
import {ROUTES_CONSTANTS_POSTS} from "../core/constants/routesConstants";
import TextArea from "antd/es/input/TextArea";
import {UploadOutlined} from "@ant-design/icons";
import posts from "../store/posts";

function AddPost(props) {
    const [file, setFile] = useState(null);
    // const propses = {
    //     // action: 'https://www.mocky.io/v2/5cc8019d300000980a055e76',
    //     onChange({file, fileList}) {
    //         if (file.status !== 'uploading') {
    //             setFile(fileList[0])
    //         }
    //     },
    // };
    const selectFile = (info) => {
        console.log(info)
        setFile(info.file.originFileObj);
    };


    const onFinish = async (values) => {
        console.log("filefilefilefilefile", file)
        const formData = new FormData();
        formData.append("title", values.title);
        formData.append("description", values.title);
        formData.append("image", file);
        formData.append("category_id", "2");
        formData.append("user_id", "1");
        console.log("formData", formData)
        await posts.addPost(formData)
    };

    return (
        <>
            <Title>Add post</Title>
            <Row>
                <Col span={20}>
                    <Form
                        name="basic"
                        labelCol={{span: 8}}
                        wrapperCol={{span: 16}}
                        onFinish={onFinish}
                        autoComplete="off"
                    >
                        <Form.Item
                            label="Title"
                            name="title"
                            rules={[{required: true, message: 'Please input post title!'}]}
                        >
                            <Input/>
                        </Form.Item>

                        <Form.Item
                            label="Description"
                            name="description"
                            rules={[{required: true, message: 'Please input your description!'}]}
                        >
                            <TextArea/>
                        </Form.Item>

                        <Form.Item>
                            <Upload onChange={selectFile}>
                                <Button icon={<UploadOutlined/>}>Upload</Button>
                            </Upload>,
                        </Form.Item>

                        <Form.Item wrapperCol={{offset: 8, span: 16}}>
                            <Button type="primary" htmlType="submit">
                                Submit
                            </Button>
                        </Form.Item>
                    </Form>
                </Col>
            </Row>
        </>
    );
}

export default AddPost;