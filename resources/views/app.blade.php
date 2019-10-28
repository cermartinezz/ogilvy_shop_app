<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <title>Shopless</title>
    </head>
    <body class="font-sans">
        <div class="flex-center position-ref full-height">
            <div id="app">
                <div class="container px-8">
                    <header class="py-6 mb-8">
                        <h1>
                            <img src="/images/shopless.png" alt="shopless" width="120px" height="120px">
                        </h1>
                    </header>
                    <main class="flex">
                        <aside class="w-1/5 pt-8">
                            <section class="mb-10">
                                <h5 class="uppercase font-bold mb-4 text-base">Cliente</h5>
                                <ul class="list-reset">
                                    <li class="text-sm leading-loose"><router-link class="text-black" to="/" exact>Inicio</router-link></li>
                                </ul>
                            </section>
                            <section class="mb-10">
                                <h5 class="uppercase font-bold mb-4 text-base">Administrador</h5>
                                <ul class="list-reset">
                                    <li class="text-sm leading-loose"><router-link class="text-black" to="/productos">Productos</router-link></li>
                                    <li class="text-sm leading-loose"><router-link class="text-black" to="/inventario">Inventario</router-link></li>
                                    <li class="text-sm leading-loose"><router-link class="text-black" to="/usuarios">Usuarios</router-link></li>
                                </ul>
                            </section>

                            <section class="mb-10">
                                <h5 class="uppercase font-bold mb-4 text-base">Session</h5>
                                <ul class="list-reset">
                                    <li class="text-sm leading-loose" v-show=!init><router-link class="text-black" to="/iniciar_session">Login</router-link></li>
                                    <li class="text-sm leading-loose" v-show=init><router-link class="text-black" to="/cerrar_session">Logout</router-link></li>
                                    <li class="text-sm leading-loose" v-show=!init><router-link class="text-black" to="/registro">Registrar</router-link></li>
                                </ul>
                            </section>
                        </aside>
                        <div class="primary flex-1">
                            <router-view></router-view>
                        </div>
                    </main>


                </div>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
