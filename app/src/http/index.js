import axios from "axios";

const $host = axios.create({
    baseURL: "http://127.0.0.1:8000/api/",
});

// const $authHost = axios.create({
//     baseURL: "http://localhost:5000/",
// });
//
// const authInterceptor = (config) => {
//     config.headers.authorization = `Bearer ${localStorage.getItem("token")}`;
//     return config;
// };
//
// $authHost.interceptors.request.use(authInterceptor);

// export { $host, $authHost };
export { $host };