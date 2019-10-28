<template>
    <div>
        <h1 class="font-normal text-3xl leading-none mb-5">
            Inicio
        </h1>

        <div v-for="items in products"  class="flex content-between">
            <div v-for="product in items" class="m-2 w-full">
                <div class="max-w-2xl w-full lg:flex">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                         style="background-image: url('https://loremflickr.com/320/240')" title="Woman holding a mug">
                    </div>
                    <div class="w-full border-r border-b border-l border-grey-light lg:border-l-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                        <div class="mb-8">
                            <div class="text-black font-bold text-xl mb-2">{{ product.brand  }}</div>
                            <p class="text-grey-darker text-base">{{ `Modelo: ${product.model}`  }}</p>
                            <p class="text-grey-darker text-base">{{ `Precio: ${product.price}`  }}</p>
                            <p class="text-grey-darker text-base">{{ `Cantidad Disponible: ${product.items_availabel}`  }}</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-sm">
                                <button class="bg-blue hover:bg-blue-dark text-white font-bold py-2 px-4 rounded">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
            };
        },
        created() {
            axios.get("/api/shop").then(response => {
                // console.log(response.data.resultado.data.items);
                let items = response.data.resultado.data.items

                this.products = _.chunk(items,2);
            })
        }
    }
</script>
