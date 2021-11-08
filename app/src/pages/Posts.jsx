import React, {useEffect} from 'react';
import {observer} from "mobx-react-lite";
import posts from "../store/posts";
import Avatar from "antd/es/avatar/avatar";
import Meta from "antd/es/card/Meta";
import {Button, Card} from "antd";
import Title from "antd/es/typography/Title";
import {EyeOutlined, LikeOutlined, SettingOutlined} from "@ant-design/icons";
import {useHistory} from "react-router-dom";
import {ROUTES_CONSTANTS_POST_ADD} from "../core/constants/routesConstants";

function Posts(props) {
    const history = useHistory()
    useEffect(() => {
        // (async ()=> await posts.fetchPosts())()
        posts.fetchPosts()
    }, []);

    console.log("posts.posts", posts.posts)
    return (
        <div>
            <Title level={2}>Posts</Title>
            <Button onClick={()=>history.push(ROUTES_CONSTANTS_POST_ADD)}>Add post</Button>
            {posts?.posts?.data?.length ?
                <div style={{display: 'flex', flexWrap: 'wrap'}}>
                    {posts?.posts?.data?.map(post =>
                        <Card
                            key={post.id}
                            style={{width: 300, marginRight: 20,}}
                            cover={
                                <img
                                    alt={post.id}
                                    src={`http://127.0.0.1:8000${post.image}`}
                                />
                            }
                            actions={[
                                <SettingOutlined key="setting"/>,
                                <div key="like" onClick={() => posts.likePost(post.id)}><LikeOutlined/> {post.likes}
                                </div>,
                                <div key="view"><EyeOutlined/> {post.views}</div>,
                            ]}
                        >
                            <Meta
                                title={post.title}
                                description={post.description}
                            />
                        </Card>)

                    }
                </div> : <div>There is no posts</div>
            }
        </div>
    );
}

export default observer(Posts);