import authRoutes from "../pages/auth/routes";
import profileRoutes from "../pages/profile/routes"
import indexRoutes from "../pages/public/routes"
import dashboardRoutes from "../pages/dashboard/routes"


export default [...authRoutes, ...profileRoutes, ...indexRoutes, ...dashboardRoutes];