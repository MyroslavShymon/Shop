import {
    HomeFilled,
    LoginOutlined,
    LogoutOutlined,
    MessageFilled,
    SaveOutlined,
    TeamOutlined,
    UserOutlined
} from "@ant-design/icons";
import {routesConstant} from "../../../../core/constants/router/routes.constant";

export const menu = [
    {
        title: "Main",
        icon: <HomeFilled style={{fontSize: "115%"}}/>,
        link: routesConstant.newsFeed
    },
    {
        title: "User",
        icon: <UserOutlined style={{fontSize: "115%"}}/>,
        link: routesConstant.currentUser
    },
    {
        title: "Friends",
        icon: <TeamOutlined style={{fontSize: "115%"}}/>,
        link: routesConstant.friends
    },
    {
        title: "Messages",
        icon: <MessageFilled style={{fontSize: "115%"}}/>,
        link: routesConstant.message
    },
    {
        title: "",
        icon: <SaveOutlined style={{fontSize: "115%"}}/>,
        link: routesConstant.savedProductsList
    },
]