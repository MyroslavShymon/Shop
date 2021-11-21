import {routes} from "./routes";
import types from "../layout/types";
import {
    Login,
    Main,
    NewsFeed,
    Registration,
    User,
    BrandAdminPage,
    RoleAdminPage,
    TypeAdminPage,
    Brand,
    BrandsList,
    FriendsList,
    Messenger,
    Post,
    Product,
    ProductType,
    Tag,
    SavedProductsList
} from "../../../pages";

export const router = [
    {
        name: 'Login',
        path: routes.login,
        type: types.EMPTY,
        component: <Login/>
    },
    {
        name: 'Registration',
        path: routes.registration,
        type: types.EMPTY,
        component: <Registration/>
    },
    {
        name: 'Feed',
        path: routes.newsFeed,
        type: types.MAIN,
        component: <NewsFeed/>
    },
    {
        name: 'User',
        path: routes.user,
        type: types.MAIN,
        component: <User/>
    },
    {
        name: 'Main',
        path: routes.main,
        type: types.MAIN,
        component: <Main/>
    },
    {
        name: 'Tag',
        path: routes.tag,
        type: types.MAIN,
        component: <Tag/>
    },
    {
        name: 'ProductType',
        path: routes.type,
        type: types.MAIN,
        component: <ProductType/>
    },
    {
        name: 'SavedProductsList',
        path: routes.savedProductsList,
        type: types.MAIN,
        component: <SavedProductsList/>
    },
    {
        name: 'Product',
        path: routes.product,
        type: types.MAIN,
        component: <Product/>
    },
    {
        name: 'Post',
        path: routes.post,
        type: types.MAIN,
        component: <Post/>
    },
    {
        name: 'Messages',
        path: routes.message,
        type: types.MAIN,
        component: <Messenger/>
    },
    {
        name: 'Friends',
        path: routes.friends,
        type: types.MAIN,
        component: <FriendsList/>
    },
    {
        name: 'Brands',
        path: routes.brands,
        type: types.MAIN,
        component: <BrandsList/>
    },
    {
        name: 'Brand',
        path: routes.brand,
        type: types.MAIN,
        component: <Brand/>
    },
    {
        name: 'AdminBrand',
        path: routes.adminBrand,
        type: types.ADMIN,
        component: <BrandAdminPage/>
    },
    {
        name: 'RoleBrand',
        path: routes.adminRole,
        type: types.ADMIN,
        component: <RoleAdminPage/>
    },
    {
        name: 'TypeBrand',
        path: routes.adminType,
        type: types.ADMIN,
        component: <TypeAdminPage/>
    },
];

