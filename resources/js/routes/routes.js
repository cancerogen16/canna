// import webRoutes from "../modules/web/routes"
 import authRoutes from "../pages/auth/routes";
 import profileRoutes from "../pages/profile/routes"
 import indexRoutes from "../pages/index/routes"
// import userRoutes from "../modules/user/routes"
// import articleRoutes from "../modules/article/routes"

export default [...authRoutes, ...profileRoutes, ...indexRoutes]