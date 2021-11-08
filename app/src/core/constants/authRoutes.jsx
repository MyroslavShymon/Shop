import {
    ROUTES_CONSTANTS_POSTS,
    ROUTES_CONSTANTS_POST,
    ROUTES_CONSTANTS_CATEGORIES, ROUTES_CONSTANTS_POST_ADD, ROUTES_CONSTANTS_CATEGORY,
} from "./routesConstants";
import {PAGES_CONSTANTS_MAIN} from "./pagesConstants";
import {Categories, Category, Post} from "../../pages";
import AddPost from "../../pages/AddPost";

export const authRoutes = [
    {
        component: <Categories/>,
        path: ROUTES_CONSTANTS_CATEGORIES,
        type: PAGES_CONSTANTS_MAIN
    },
    {
        component: <Category/>,
        path: ROUTES_CONSTANTS_CATEGORY,
        type: PAGES_CONSTANTS_MAIN
    },
    {
        component: <AddPost/>,
        path: ROUTES_CONSTANTS_POST_ADD,
        type: PAGES_CONSTANTS_MAIN
    },
    {
        component: <Post/>,
        path: ROUTES_CONSTANTS_POST,
        type: PAGES_CONSTANTS_MAIN
    },
]