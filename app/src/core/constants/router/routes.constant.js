const routesConstant = Object.freeze({
    newsFeed: "/feed",
    login: "/login",
    registration: "/registration",
    user: "/friend/:id",
    currentUser: "/user/:id",
    main: "/",
    tag: "/tag/:id",
    type: "/type/:id",
    savedProductsList: "/products/saved",
    product: "/product/:id",
    post: "/post/:id",
    message: "/message",
    friends: "/friends",
    brands: "/brands",
    brand: "/brands/:id",
    adminBrand: "/admin/brand",
    adminType: "/admin/type",
    adminRole: "/admin/role",
})

export {routesConstant};