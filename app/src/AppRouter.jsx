import React, {useState} from 'react';
import {observer} from "mobx-react-lite";
import {Redirect, Route, Switch} from "react-router-dom";
import {router} from "./core/constants/router";
import types from "./core/constants/layout/types";
import {AdminLayout, EmptyLayout, MainLayout} from "./layout";
import {routes} from "./core/constants/router/routes";

function AppRouter(props) {
    const [isAuth, setIsAuth] = useState(true);
    const [isAdmin, setIsAdmin] = useState(true);

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
                                    return isAuth && <MainLayout>{route.component}</MainLayout>;
                                case types.ADMIN :
                                    return isAdmin && <AdminLayout>{route.component}</AdminLayout>;
                                default :
                                    return <EmptyLayout>{route.component}</EmptyLayout>
                            }
                        }
                        }
                    />
                )
            }
            {isAuth ? <Redirect to={routes.main}/> : <Redirect to={routes.login}/>}
        </Switch>
    );
}

export default observer(AppRouter);