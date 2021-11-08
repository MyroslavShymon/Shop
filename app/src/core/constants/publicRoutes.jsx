import {
    ROUTES_CONSTANTS_CATEGORY,
    ROUTES_CONSTANTS_LOGIN, ROUTES_CONSTANTS_POSTS,
    ROUTES_CONSTANTS_REGISTRATION
} from "./routesConstants";
import {PAGES_CONSTANTS_EMPTY, PAGES_CONSTANTS_MAIN} from "./pagesConstants";
import {Login, Posts, Registration} from "../../pages";

export const publicRoutes = [
    {
        component: <Posts/>,
        path: ROUTES_CONSTANTS_POSTS,
        type: PAGES_CONSTANTS_MAIN
    },
    {
        component: <Login/>,
        path: ROUTES_CONSTANTS_LOGIN,
        type: PAGES_CONSTANTS_EMPTY
    },
    {
        component: <Registration/>,
        path: ROUTES_CONSTANTS_REGISTRATION,
        type: PAGES_CONSTANTS_EMPTY
    }
]