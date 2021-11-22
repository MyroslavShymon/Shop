import {routesConstant} from "./routes.constant";
import types from "../layout/types.constant";
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
import CurrentUser from "../../../pages/CurrentUserPage";

export const router = [
    {
        name: 'Login',
        path: routesConstant.login,
        type: types.EMPTY,
        component: <Login/>
    },
    {
        name: 'Registration',
        path: routesConstant.registration,
        type: types.EMPTY,
        component: <Registration/>
    },
    {
        name: 'Feed',
        path: routesConstant.newsFeed,
        type: types.MAIN,
        component: <NewsFeed/>
    },
    {
        name: 'User',
        path: routesConstant.user,
        type: types.MAIN,
        component: <User/>
    },
    {
        name: 'Main',
        path: routesConstant.main,
        type: types.MAIN,
        component: <Main/>
    },
    {
        name: 'Tag',
        path: routesConstant.tag,
        type: types.MAIN,
        component: <Tag/>
    },
    {
        name: 'ProductType',
        path: routesConstant.type,
        type: types.MAIN,
        component: <ProductType/>
    },
    {
        name: 'SavedProductsList',
        path: routesConstant.savedProductsList,
        type: types.MAIN,
        component: <SavedProductsList/>
    },
    {
        name: 'Product',
        path: routesConstant.product,
        type: types.MAIN,
        component: <Product/>
    },
    {
        name: 'Post',
        path: routesConstant.post,
        type: types.MAIN,
        component: <Post/>
    },
    {
        name: 'Messages',
        path: routesConstant.message,
        type: types.MAIN,
        component: <Messenger/>
    },
    {
        name: 'Friends',
        path: routesConstant.friends,
        type: types.MAIN,
        component: <FriendsList/>
    },
    {
        name: 'Brands',
        path: routesConstant.brands,
        type: types.MAIN,
        component: <BrandsList/>
    },
    {
        name: 'Brand',
        path: routesConstant.brand,
        type: types.MAIN,
        component: <Brand/>
    },
    {
        name: 'AdminBrand',
        path: routesConstant.adminBrand,
        type: types.ADMIN,
        component: <BrandAdminPage/>
    },
    {
        name: 'RoleBrand',
        path: routesConstant.adminRole,
        type: types.ADMIN,
        component: <RoleAdminPage/>
    },
    {
        name: 'TypeBrand',
        path: routesConstant.adminType,
        type: types.ADMIN,
        component: <TypeAdminPage/>
    },
    {
        name: 'CurrentUser',
        path: routesConstant.currentUser,
        type: types.MAIN,
        component: <CurrentUser/>
    },
];

