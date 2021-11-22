// import {
//     ROUTES_CONSTANTS_CATEGORIES,
//     ROUTES_CONSTANTS_LOGIN,
//     ROUTES_CONSTANTS_POSTS, ROUTES_CONSTANTS_REGISTRATION
// } from "../core/constants/router/routesConstant";
import {HomeFilled, LoginOutlined, MessageFilled, SaveOutlined, TeamOutlined, UserOutlined} from "@ant-design/icons";
import {routesConstant} from "../../../../core/constants/router/routes.constant";

export const menu = [
    {
        title: "Main",
        icon: <HomeFilled style={{fontSize:"125%"}} />,
        link: routesConstant.newsFeed
    },
    {
        title: "User",
        icon: <UserOutlined style={{fontSize:"125%"}} />,
        link: routesConstant.currentUser
    },
    {
        title: "Friends",
        icon: <TeamOutlined style={{fontSize:"125%"}} />,
        link: routesConstant.friends
    },
    {
        title: "Messages",
        icon: <MessageFilled style={{fontSize:"125%"}} />,
        link: routesConstant.message
    },
    {
        title: "",
        icon: <SaveOutlined style={{fontSize:"125%"}} />,
        link: routesConstant.savedProductsList
    },
]