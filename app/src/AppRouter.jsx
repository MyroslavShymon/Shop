import React, {useState} from 'react';
import {observer} from "mobx-react-lite";
import {Redirect, Route, Switch} from "react-router-dom";
import MainLayout from "./components/layout/MainLayout";
import {publicRoutes} from "./core/constants/publicRoutes";
import {authRoutes} from "./core/constants/authRoutes";
import {PAGES_CONSTANTS_MAIN} from "./core/constants/pagesConstants";
import EmptyLayout from "./components/layout/EmptyLayout";
import {ROUTES_CONSTANTS_LOGIN, ROUTES_CONSTANTS_POSTS} from "./core/constants/routesConstants";

function AppRouter(props) {
    const [isAuth, setIsAuth] = useState(true);
    return (
        <Switch>
            {
                publicRoutes.map(({path, component, type}) =>
                    type === PAGES_CONSTANTS_MAIN ?
                        <Route key={path} path={path} exact
                               render={() => <MainLayout key={path}>{component}</MainLayout>}/>
                        : <Route key={path} path={path} exact
                                 render={() => <EmptyLayout key={path}>{component}</EmptyLayout>}/>
                )
            }
            {
                isAuth &&
                authRoutes.map(({path, component, type}) =>
                    type === PAGES_CONSTANTS_MAIN ?
                        <Route key={path} path={path} exact
                               render={() => <MainLayout key={path}>{component}</MainLayout>}/>
                        : <Route key={path} path={path} exact
                                 render={() => <EmptyLayout key={path}>{component}</EmptyLayout>}/>
                )
            }
            {isAuth ? <Redirect to={ROUTES_CONSTANTS_POSTS}/> : <Redirect to={ROUTES_CONSTANTS_LOGIN}/>}
        </Switch>
    );
}

export default observer(AppRouter);