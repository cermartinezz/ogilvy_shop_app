import Home from './components/Home';
import Product from './components/Products';
import NotFound from './components/NotFound';
import Login from './components/Login';
import Register from './components/Register';

export default {
    mode: 'history',
    linkActiveClass: 'font-bold',
    routes: [
        {
            path: "/",
            component: Home
        },
        {
            path: "/productos",
            component: Product
        },
        {
            path: "/iniciar_session",
            component: Login
        },
        {
            path: "/registro",
            component: Register
        },
        {
            path: "*",
            component: NotFound
        },
    ]
}