import React, {useEffect, useState} from 'react';
import {observer} from "mobx-react-lite";
import {Redirect, Route, Switch, useHistory} from "react-router-dom";
import {router} from "./core/constants/router";
import types from "./core/constants/layout/types.constant";
import {AdminLayout, EmptyLayout, MainLayout} from "./layout";
import {routesConstant} from "./core/constants/router/routes.constant";
import user from "./store/user";

function AppRouter(props) {
    const history = useHistory()
    useEffect(() => {
        user.getToken();
        if (!user.isAuth) {
            history.push(routesConstant.login)
        } else {
            history.push(routesConstant.main)
        }
    }, []);

    console.log("isAuth", user.isAuth, "isAdmin", user.isAdmin, "user", user.user)

    return (
        <Switch>
            {
                router.map((route) =>
                    <Route
                        key={route.name}
                        path={route.path}
                        exact
                        render={() => {
                            switch (route.type) {
                                case types.MAIN :
                                    return user.isAuth && <MainLayout>{route.component}</MainLayout>;
                                case types.ADMIN :
                                    return user.isAdmin && <AdminLayout>{route.component}</AdminLayout>;
                                default :
                                    return <EmptyLayout>{route.component}</EmptyLayout>
                            }
                        }
                        }
                    />
                )
            }
            {/*{user.isAuth ? <Redirect to={routesConstant.main}/> : <Redirect to={routesConstant.login}/>}*/}
        </Switch>
    );
}

export default observer(AppRouter);