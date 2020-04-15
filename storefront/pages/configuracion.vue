<template>
    <v-container>
        <CtCard :type="stored_config.branding.style.card" dense title="Configuración inicial">
            <template v-slot:rightTitleContent>
                <CtTooltip left btn btn-type="icon" btn-color="white" :btn-icon="['fas', is_saved_icon]">
                    <span v-if="is_saved">Guardado</span>
                    <span v-else-if="! is_saved && seconds_to_save !== 'saving'">Se guardará en <span v-html="seconds_to_save" /> segundos</span>
                    <span v-else-if="! is_saved">Guardando...</span>
                </CtTooltip>
            </template>
            <v-card-text v-if="stored_config.initialized">
                <v-row dense class="body-2">
                    <v-spacer />
                    <h1 class="body-1 text-uppercase text-center">Identificación fiscal de la empresa</h1>
                    <v-spacer />
                </v-row>
                <v-row dense class="body-2">
                    <v-spacer />
                    Estos datos saldrán en el tíquet.
                    <v-spacer />
                </v-row>

                <!-- Tax information -->
                <v-row dense :class="{ 'mt-9': $vuetify.breakpoint.smAndUp }">
                    <v-spacer />
                    <v-col cols="12" sm="10">
                        <TaxIdentification :model="model.tax_identification" />
                    </v-col>
                    <v-spacer />
                </v-row>

                <!-- Branding -->
                <v-row dense>
                    <v-spacer />
                    <v-col cols="12" sm="10">
                        <Branding :model="model.branding" />
                    </v-col>
                    <v-spacer />
                </v-row>

                <!-- Customer switch -->
                <v-row dense>
                    <v-spacer />
                    <v-col cols="12" sm="3">
                        <v-switch v-model="model.customers" class="ma-4" label="Clientes" />
                    </v-col>
                    <v-col cols="12" sm="7" :class="{ 'body-2': true, 'mt-6': $vuetify.breakpoint.smAndUp }" v-if="model.customers">
                        Saldrán listas de clientes y podrás modificar el cliente de los tíquets.
                    </v-col>
                    <v-col cols="12" sm="7" :class="{ 'body-2': true, 'mt-6': $vuetify.breakpoint.smAndUp }" v-else>
                        El cliente siempre será ventas contado.
                    </v-col>
                    <v-spacer />
                </v-row>

                <!-- Turn switch -->
                <v-row dense>
                    <v-spacer />
                    <v-col cols="12" sm="3">
                        <v-switch v-model="model.turns" class="ma-4" label="Turnos" />
                    </v-col>
                    <v-col cols="12" sm="7" :class="{ 'body-2': true, 'mt-6': $vuetify.breakpoint.smAndUp }" v-if="model.turns">
                        Los turnos estarán habilitados. Se agruparán ventas y estadísticas junto a características extra.
                    </v-col>
                    <v-col cols="12" sm="7" :class="{ 'body-2': true, 'mt-6': $vuetify.breakpoint.smAndUp }" v-else>
                        Los turnos estarán deshabilitados
                    </v-col>
                    <v-spacer />
                </v-row>

                <!-- Advanced options -->
                <v-row dense :class="{ 'body-2': true, 'mt-7': $vuetify.breakpoint.smAndDown }">
                    <v-spacer />
                    <v-col cols="12" sm="6" class="body-2 text-center justify-center">
                        <CtBtn :type="stored_config.branding.style.button" color="secondary" class="body-1 text-uppercase text-center" @click="advanced_option = ! advanced_option">Opciones avanzadas</CtBtn> (Click para mostrar/ocultar)
                    </v-col>
                    <v-spacer />
                </v-row>

                <template v-if="advanced_option">
                    <!-- LayoutTPV -->
                    <v-row dense>
                        <v-spacer />
                        <v-col cols="12" sm="10">
                            <LayoutTPV :model="model.layout_tpv" />
                        </v-col>
                        <v-spacer />
                    </v-row>

                    <!-- ConfigTPV -->
                    <v-row dense>
                        <v-spacer />
                        <v-col cols="12" sm="10">
                            <ConfigTPV :model="model.config_tpv" />
                        </v-col>
                        <v-spacer />
                    </v-row>

                    <!-- ConfigTurns -->
                    <v-row dense class="mt-5">
                        <v-spacer />
                        <v-col cols="12" sm="10">
                            <ConfigTurns :model="model.config_turns" />
                        </v-col>
                        <v-spacer />
                    </v-row>

                    <!-- ConfigSmtp -->
                    <v-row dense class="mt-5">
                        <v-spacer />
                        <v-col cols="12" sm="10">
                            <ConfigSmtp :model="model.smtp" />
                        </v-col>
                        <v-spacer />
                    </v-row>

                    <!-- Directories -->
                    <v-row dense class="mt-9">
                        <v-spacer />
                        <v-col cols="12" sm="3">
                            <CtFileInput webkitdirectory v-model="model.data_dir" :ctType="stored_config.branding.style.form" label="Directorio de datos" prepend-icon="mdi-folder" />
                        </v-col>
                        <v-col cols="12" sm="7" :class="{ 'body-2': true }">
                            Directorio donde se guardan los datos de la TPV. Configuraciones, familias, etc. Por defecto: app://./data
                        </v-col>
                        <v-spacer />
                    </v-row>
                    <v-row dense class="mt-6">
                        <v-spacer />
                        <v-col cols="12" sm="3">
                            <CtFileInput webkitdirectory v-model="model.import_dir" :ctType="stored_config.branding.style.form" label="Directorio de importación" prepend-icon="mdi-folder" />
                        </v-col>
                        <v-col cols="12" sm="7" :class="{ 'body-2': true }">
                            Directorio donde se guardan los datos a importar de la TPV. Configuraciones, familias, etc. Por defecto: app://./import_data
                        </v-col>
                        <v-spacer />
                    </v-row>

                    <!-- ConfigImportation -->
                    <v-row dense class="mt-5">
                        <v-spacer />
                        <v-col cols="12" sm="10">
                            <ConfigImportation :model="model.import" />
                        </v-col>
                        <v-spacer />
                    </v-row>
                </template>
            </v-card-text>
            <template v-slot:actions>
                <v-divider />
                <!-- Start TPV -->
                <v-row dense class="body-2">
                    <v-spacer />
                    <v-col cols="6" class="body-2 text-center justify-center">
                        <CtBtn color="primary" :type="stored_config.branding.style.button" class="body-1 text-uppercase text-center" @click="initTPV()">Iniciar TPV</CtBtn>
                    </v-col>
                    <v-spacer />
                </v-row>
            </template>
        </CtCard>
    </v-container>
</template>

<script>
import { ipcRenderer } from 'electron'
import { mapActions } from 'vuex'
import TaxIdentification from "../components/TaxIdentification";
import Branding from "../components/Branding";
import LayoutTPV from "../components/LayoutTPV";
import ConfigTPV from "../components/ConfigTPV";
import ConfigTurns from "../components/ConfigTurns";
import ConfigSmtp from "../components/ConfigSmtp";
import ConfigImportation from "../components/ConfigImportation";

export default {

    components: {ConfigImportation, ConfigSmtp, ConfigTurns, ConfigTPV, Branding, TaxIdentification, LayoutTPV},

    data() {
        return {
            // Save and get config
            is_saved: true,
            is_saved_icon: 'save',
            default_seconds_to_save: 5,
            // Information data about seconds until save
            seconds_to_save: 'saved',
            // Save config event to renderer process actions
            save_config_firing_event: null,
            // Save config event to renderer process actions
            save_config_renderer_event: null,
            // Save config event to listen main process state
            save_config_main_event: null,

            advanced_option: false,

            // Model values are determined by store. It's used to explain and samples.
            model: {
                tax_identification: {
                    tax_name: null,
                    tax_identification: null,
                    address: null,
                    postal_code: null,
                    city: null,
                    province: null,
                },
                branding: {
                    color_palette: {
                        primary: '#267699',
                        secondary: '#70B0CC',
                        accent: '#FF877A',
                        success: '#4CAF50',
                        error: '#FF5252',
                        warning: '#FFC107',
                        info: '#D19BA3',
                    },
                    style: {
                        button: 'text',
                        form: 'outlined',
                        card: 'shaped',
                        dialog_card: 'shaped',
                    },
                },
                customers: false,
                turns: false,
                layout_tpv: {
                    distribution: '1-2x2',
                },
                config_tpv: {
                    // Actions
                    action: {
                        title: 'Acciones',
                        values: {
                            maximize: { value: true, label: 'Maximizar', description: 'Accionar el maximizado de la ventana.' },
                            open_money: { value: true, label: 'Cajón de monedas', description: 'Accionar la apertura del cajón de monedas.' },
                            exit: { value: true, label: 'Salir', description: 'Accionar la salida de la TPV.' },
                            refresh: { value: true, label: 'Refrescar', description: 'Accionar l\'actualización de la TPV.' },
                            alerts: { value: true, label: 'Alertas', description: 'Accionar el modal de las alertas.' },
                        },
                    },

                    // Ticket List
                    ticket: {
                        title: 'Listado de tickets',
                        values: {
                            show_closed: {value: true, label: 'Cerrados', description: 'Mostrar los últimos tíquets cerrados.'},
                            closed_number: {value: 10, type: 'number', label: 'Número de cerrados', description: ''},
                            name: {value: false, label: 'Nombre', description: 'Mostrar el nombre del cliente.'},
                            check: {value: false, label: 'Revisar', description: 'Mostrar el botón para revisar el tíquet después de cerrarlo.'},
                            collect: {value: true, label: 'Cobrar', description: 'Mostrar el botón de cobrar.'},
                            collect_direct: {value: true, label: 'Cobrar directamente', description: 'Mostrar el botón de cobrar directamente.'},
                            send_custom: {value: true, label: 'Enviar personalizado', description: 'Mostrar un checkbox al lado de cada tíquet para enviarlo.'},
                            delete: {value: true, label: 'Eliminar', description: 'Mostrar el botón para eliminar el tíquet.'}, // If hasn't ticket number
                        },
                    },

                    // Ticket Opened

                    ticket_opened: {
                        title: 'Ticket abierto',
                        values: {
                            save: {value: false, label: 'Guardar', description: 'Mostrar el botón de guardar.'},
                            close: {value: false, label: 'Cerrar', description: 'Mostrar el botón de cerrar.'},
                            save_close: {value: true, label: 'Guardar y cerrar', description: 'Mostrar el botón de guardar y cerrar.'},
                            total_price: {value: true, label: 'Precio total', description: 'Mostrar precio total.'},
                            send: {value: true, label: 'Enviar', description: 'Mostrar el botón de enviar.'},
                            delete: {value: true, label: 'Eliminar', description: 'Mostrar el botón de eliminar.'}, // If hasn't ticket number
                        },
                    },

                    // Ticket Opened - Customer
                    ticket_opened_customer: {
                        title: 'Ticket abierto - Cliente',
                        values: {
                            unfolded: {value: false, label: 'Desplegado', description: 'Desplegar de forma automática el cliente.'},
                            link: {value: true, label: 'Enlace', description: 'Mostrar botón para ir a la ficha entera del cliente.'},
                            update: {value: true, label: 'Modificación temporal', description: 'Habilitar la modificación temporal del cliente.'},
                            temporary_discount_product: {value: true, label: 'Descuento de producto', description: 'Habilitar la modificación temporal del descuento de producto.'},
                            temporary_discount_pay_soon: {value: true, label: 'Descuento pronto pago', description: 'Habilitar la modificación temporal del descuento pronto pago.'},
                            temporary_discount_customer: {value: true, label: 'Descuento de cliente', description: 'Habilitar la modificación temporal del descuento de cliente.'},
                            temporary_apply_zone_tax: {value: false, label: 'Impuestos por zona', description: 'Habilitar la aplicación de impuestos por zona.'},
                            temporary_apply_equivalence_surcharge: {value: false, label: 'Recargo de equivalencia', description: 'Habilitar la aplicación del recargo de equivalencia.'},
                            temporary_apply_irpf: {value: false, label: 'IRPF', description: 'Habilitar la aplicación del IRPF.'},
                            temporary_apply_rate: {value: '1', type: 'select', options: ['1', '2', '3', '4'], label: 'Tarifa', description: 'Modificar la tarifa aplicada.'}, // Select customizable
                            temporary_save: {value: true, label: 'Guardar', description: 'Mostrar el botón para guardar los canvios en la ficha del cliente.'},
                        },
                    },

                    // Ticket - Lines
                    ticket_line: {
                        title: 'Tickets - Línea',
                        values: {
                            discount: {value: true, label: 'Descuento', description: 'Mostrar la columna de descuento.'},
                            unit_price: {value: true, label: 'Precio unidad', description: 'Mostrar la columna de precio unidad.'},
                            unit: {value: true, label: 'Unidad', description: 'Mostrar la columna de unidades.'},
                            total_price: {value: true, label: 'Precio total', description: 'Mostrar la columna de precio total.'},
                            complements: {value: true, label: 'Complementos', description: 'Mostrar el botón de complementos.'},
                            delete: {value: true, label: 'Eliminar', description: 'Mostrar el botón de eliminar.'}, // If hasn't ticket number
                            send: {value: false, label: 'Enviar', description: 'Mostrar el botón de enviar.'},
                        },
                    },

                    // Families
                    family: {
                        title: 'Familias',
                        values: {
                            image: {value: true, label: 'Imagen', description: 'Mostrar imagen'},
                            image_size: {value: 'md', type: 'select', options: ['s', 'sm', 'md', 'lg'], label: 'Tamaño de la imagen', description: ''}, // Select s, sm, md, lg
                            text: {value: true, label: 'Texto', description: 'Mostrar texto'},
                            text_size: {value: 'md', type: 'select', options: ['s', 'sm', 'md', 'lg'], label: 'Tamaño del texto', description: ''}, // Select s, sm, md, lg
                        },
                    },

                    // Feature
                    feature: {
                        title: 'Características',
                        values: {
                            text_size: {value: 'md', type: 'select', options: ['s', 'sm', 'md', 'lg'], label: 'Tamaño del texto', description: ''}, // Select s, sm, md, lg
                        },
                    },

                    // Quantities
                    quantities: {
                        title: 'Cantidades',
                        values: {
                            unfolded: {value: false, label: 'Desplegadas', description: 'Desplegar de forma automática las cantidades.'},
                            linear: {value: true, label: 'Lineal', description: 'Mostrar las cantidades de forma lineal.'},
                        },
                    },

                    // Search
                    search: {
                        title: 'Búsqueda',
                        values: {
                            show: {value: true, label: 'Mostrar', description: 'Mostrar el buscador'},
                        },
                    },

                    // Product List
                    product: {
                        title: 'Listado de productos',
                        values: {
                            show_price: {value: false, label: 'Precio', description: 'Mostrar el precio.'},
                            image: {value: true, label: 'Imagen', description: 'Mostrar la imagen.'},
                            image_size: {value: 'md', type: 'select', options: ['s', 'sm', 'md', 'lg'], label: 'Tamaño de la imgen', description: ''}, // Select s, sm, md, lg
                            text: {value: true, label: 'Texto', description: 'Mostrar el texto.'},
                            text_size: {value: 'md', type: 'select', options: ['s', 'sm', 'md', 'lg'], label: 'Tamaño del texto', description: ''}, // Select s, sm, md, lg
                        },
                    },

                    // Barcode
                    barcode: {
                        title: 'Código de barras',
                        values: {
                            show: {value: false, label: 'Mostrar', description: 'Mostrar la búsqueda por código de barras.'},
                        },
                    },

                    // Dining rooms
                    dining_room: {
                        title: 'Comedores',
                        values: {
                            show: {value: false, label: 'Mostrar', description: 'Mostrar los comedores.'},
                        },
                    },
                },
                // Turns
                config_turns: {
                    title: 'Turnos',
                    values: {
                        text_size: { value: 'md', type: 'select', options: ['s', 'sm', 'md', 'lg'], label: 'Tamaño del texto', description: '' }, // Select s, sm, md, lg
                        description: { value: true, label: 'Descripción', description: 'Mostrar la descripción' },
                    },
                },
                // SMTP
                smtp: {
                    title: 'SMTP',
                    values: {
                        host: { value: '', type: 'text-field', label: 'Servidor', description: 'Url del servidor de correo' },
                        user: { value: '', type: 'text-field', label: 'Usuario', description: 'Usuario del servidor' },
                        password: { value: '', type: 'password', label: 'Password', description: 'Password del usuario del servidor' },
                        port: { value: '587', type: 'number', label: 'Puerto', description: '' },
                        type_encryption: { value: 'TLS', type: 'select', options: ['TLS', 'SSL', 'STARTTLS'], label: 'Encriptación', description: '' },
                        email_equal_user: { value: true, label: 'Correo igual a usuario', description: 'El correo tiene el mismo usuario que el del servidor.' },
                        email: { value: '', type: 'text-field', label: 'Correo electrónico', description: '' },
                        email_password_equal_user: { value: true, label: 'Password del correo igual al password', description: 'El password del correo es igual que el del servidor.' },
                        email_password: { value: '', type: 'text-field', label: 'Password correo', description: '' },
                    },
                },
                data_dir: { name: 'data', path: 'app://data' }, // default -> { name: 'data', path: 'app://data' }
                import_dir: { name: 'import_data', path: 'app://import_data' }, // default -> { name: 'import_data', path: 'app://import_data' }

                // Import
                import: {
                    type: 'csv', // Currently only support csv. Api support soon.

                    domain: {
                        product: {
                            title: 'Productos',
                            fields: [
                                {
                                    label: 'Codigo',
                                    description: 'Identificador único',
                                    name: 'id',
                                    type: 'int',
                                },
                                {
                                    label: 'Codigo familia',
                                    description: 'Identificador único de la familia',
                                    name: 'id_taxonomy',
                                    type: 'int',
                                },
                                {
                                    label: 'IVA',
                                    description: 'Impuesto sobre el valor añadido',
                                    name: 'iva',
                                    type: 'int',
                                },
                                {
                                    label: 'Enviar a',
                                    description: 'Dispositivo al que va a ser enviado al añadirse a un tíquet',
                                    name: 'ids_send_to',
                                    type: 'select',
                                },
                                {
                                    label: 'Nombre',
                                    description: 'Nombre',
                                    name: 'name',
                                    type: 'string',
                                },
                                {
                                    label: 'Coste',
                                    description: 'Coste para la empresa',
                                    name: 'cost',
                                    type: 'float',
                                },
                                {
                                    label: 'Base',
                                    description: 'Total sin IVA',
                                    name: 'base',
                                    type: 'float',
                                },
                                {
                                    label: 'PVP',
                                    description: 'Precio de venta al público',
                                    name: 'total',
                                    type: 'float',
                                },
                                {
                                    label: 'Referencia',
                                    description: 'Identificador de la empresa para el producto',
                                    name: 'reference',
                                    type: 'string',
                                },
                                {
                                    label: 'Complemento único',
                                    description: 'El producto puede tener complemento aunque solo uno',
                                    name: 'complement_unique',
                                    type: 'boolean',
                                },
                                {
                                    label: 'Mostrar complemento',
                                    description: 'Pedir el complemento antes de añadir al tíquet',
                                    name: 'complement_show',
                                    type: 'boolean',
                                },
                                {
                                    label: 'Ids complementos asociados',
                                    description: 'Identificaciones de productos asociados como posible complemento',
                                    name: 'complement_ids_available',
                                    type: 'string',
                                },
                                {
                                    label: 'Precio complemento',
                                    description: 'Precio del producto como complemento',
                                    name: 'complement_price',
                                    type: 'float',
                                },
                                {
                                    label: 'Texto tpv complemento',
                                    description: 'Texto a mostrar en la tpv como complemento',
                                    name: 'complement_text_tpv',
                                    type: 'string',
                                },
                                {
                                    label: 'Categoria complemento',
                                    description: 'Categoria asociada al producto como complemento',
                                    name: 'complement_taxonomy',
                                    type: 'string',
                                },
                                {
                                    label: 'Complemento habilitado',
                                    description: 'Producto habilitado como complemento',
                                    name: 'complement_enabled',
                                    type: 'boolean',
                                },
                                {
                                    label: 'Habilitado',
                                    description: 'Producto habilitado',
                                    name: 'enabled',
                                    type: 'boolean',
                                },
                                {
                                    label: 'Imagen',
                                    description: 'Imagen. Como más pequeñas sean más rápido irá.',
                                    name: 'img',
                                    type: 'string',
                                },
                                {
                                    label: 'Texto boton TPV',
                                    description: 'Nombre acortado',
                                    name: 'text_tpv',
                                    type: 'string',
                                },
                            ],

                            columns: [
                                'Codigo',
                                'Codigo familia',
                                'IVA',
                                'Enviar a',
                                'Descripcion',
                                'Coste',
                                'Base',
                                'PVP',
                                'Referencia',
                                'Complemento unico',
                                'Mostrar complementos',
                                'Imagen',
                                'Texto boton TPV',
                            ],

                            fields_columns: {
                                id: 'Codigo',
                                id_taxonomy: 'Codigo familia',
                                iva: 'IVA',
                                ids_send_to: 'Enviar a',
                                name: 'Descripcion',
                                cost: 'Coste',
                                base: 'Base',
                                total: 'PVP',
                                reference: 'Referencia',
                                complement_unique: 'Complemento unico',
                                complement_show: 'Mostrar complementos',
                                complement_ids_available: null,
                                complement_price: null,
                                complement_text_tpv: null,
                                complement_taxonomy: null,
                                complement_enabled: null,
                                enabled: null,
                                img: 'Imagen',
                                text_tpv: 'Texto boton TPV',
                            },
                        },

                        family: {
                            title: 'Familias',
                            fields: [
                                {
                                    label: 'Codigo',
                                    description: 'Identificador único',
                                    name: 'id',
                                    type: 'int',
                                },
                                {
                                    label: 'Imagen',
                                    description: 'Imagen. Como más pequeñas sean más rápido irá.',
                                    name: 'img',
                                    type: 'string',
                                },
                                {
                                    label: 'Texto boton TPV',
                                    description: 'Nombre acortado',
                                    name: 'text_tpv',
                                    type: 'string',
                                },
                            ],

                            columns: [
                                'id_familia',
                                'descripcio',
                                'de',
                                'foto',
                                'mostrar_text',
                                'cos',
                                'orden',
                                'color_fons',
                                'color_lletra',
                                'borde_gruix',
                                'borde_tipus',
                                'border_color',
                                'borde_radius',
                            ],

                            fields_columns: {
                                id: 'id_familia',
                                img: 'foto',
                                text_tpv: 'descripcio',
                            },
                        },


                        ticket: {
                            title: 'Tíquets',

                            fields: [
                                {label: 'Código', description: 'Identificador único', name: "id", type: 'int'},
                                {label: 'Código cliente', description: 'Identificador de cliente', name: "id_customer", type: 'int'},
                                {label: 'Código usuario', description: 'Identificador de usuario', name: "id_user", type: 'int'},
                                {label: 'Código terminal', description: 'Identificador de terminal', name: "id_terminal", type: 'int'},
                                {label: 'Código turno', description: 'Identificador de turno', name: "id_turn", type: 'int'},

                                // Payment parameters
                                {label: 'Número', description: 'Número de documento', name: "number", type: 'int'},
                                {label: 'IRPF', description: 'Impuesto sobre la renda de personas físicas', name: "irpf", type: 'float'},
                                {label: 'Método de pago', description: 'Método de pago usado', name: "method_payment", type: 'string'},
                                {label: 'Decuento pronto pago', description: 'Descuento por pronto pago', name: "discount_prompt_payment", type: 'float'},
                                {label: 'Descuento cliente', description: 'Descuento de cliente', name: "discount_customer", type: 'float'},
                                {label: 'Total', description: 'Importe total', name: "total", type: 'float'},

                                // Number of customers related with ticket
                                {label: 'Comensales', description: 'Clientes atendidos', name: "diners", type: 'int'},

                                // pending, paid_check, paid
                                {label: 'Estado', description: 'pending (null/0), paid_check (2) o paid(1)', name: "state", type: 'string'},

                                {label: 'Fecha creación', description: 'Fecha de la primera edición', name: "create_date", type: 'Date'},
                                {label: 'Fecha modificación', description: 'Fecha de la última modificación', name: "update_date", type: 'Date'},
                            ],

                            columns: [
                                'id',
                                'client',
                                'fecha',
                                'numero_document',
                                'irpf',
                                'forma_pagament',
                                'total',
                                'descompte_pp',
                                'descompte_client',
                                'estat',
                                'usuari',
                                'comensales',
                                'hora',
                                'id_terminal',
                                'id_turno',
                            ],

                            fields_columns: {
                                id: 'id',
                                id_customer: 'client',
                                id_user: 'usuari',
                                id_terminal: 'id_terminal',
                                id_turn: 'id_turno',

                                // Payment parameters
                                number: 'numero_document',
                                irpf: 'irpf',
                                method_payment: 'forma_pagament',
                                discount_prompt_payment: 'descompte_pp',
                                discount_customer: 'descompte_client',
                                total: 'total',

                                // Number of customers related with ticket
                                diners: 'comensales',

                                // pending, paid_check, paid
                                state: 'estat',

                                create_date: 'fecha',
                                update_date: null,
                            },
                        },

                        ticket_line: {
                            title: 'Líneas del tíquet',

                            fields: [
                                {label: 'Código tíquet', description: 'Identificador único del tíquet', name: "id_ticket", type: 'int'},
                                {label: 'Código línea', description: 'Identificador único de la línea', name: "id_ticket_line", type: 'int'},
                                {label: 'Código atributo', description: 'Identificador único del atributo asociado', name: "id_attribute", type: 'int'},
                                {label: 'Código usuario', description: 'Identificador único del usuario', name: "id_user", type: 'int'},

                                // Used to determine with fields and how show
                                {label: 'Tipo', description: 'Tipo de producto', name: "type", type: 'string'},

                                {label: 'Descripción', description: '', name: "description", type: 'string'},
                                {label: 'Cantidad', description: '', name: "quantity", type: 'float'},
                                {label: 'Número de série', description: '', name: "serial_number", type: 'string'}, // Technological identifier
                                {label: 'Lote', description: '', name: "lot", type: 'string'}, // Nutrition identifier
                                {label: 'Caducidad', description: '', name: "expiration", type: 'string'}, // It's a informative date
                                {label: 'Coste', description: '', name: "cost", type: 'float'},
                                {label: 'Precio', description: 'Precio total de la línea', name: "price", type: 'float'},
                                {label: 'IVA', description: '', name: "iva", type: 'float'},
                                {label: 'Recargo', description: '', name: "surcharge", type: 'float'},
                                {label: 'Descuento', description: '', name: "discount", type: 'float'},

                                {label: 'Referencia propia', description: 'Referencia interna', name: "reference", type: 'string'},
                                {label: 'Referencia para el cliente', description: '', name: "reference_customer", type: 'string'},

                                {label: 'Fecha creación', description: 'Fecha de la primera edición', name: "create_date", type: 'Date'},
                                {label: 'Fecha modificación', description: 'Fecha de la última modificación', name: "update_date", type: 'Date'},
                            ],

                            columns: [
                                'id_document',
                                'descripcio_article',
                                'grup',
                                'element',
                                'quantitat',
                                'numero_serie',
                                'lot',
                                'caducitat',
                                'preu',
                                'descompte',
                                'tipo_article',
                                'preu_fixe',
                                'referencia_article',
                                'referencia_client',
                                'formato',
                                'iva',
                                'ordre_entrada',
                                'recarrec',
                                'fecha',
                                'usuari',
                                'venedor',
                                'compta',
                            ],

                            fields_columns: {
                                id_ticket: 'id_document',

                                id_ticket_line: 'ordre_entrada',
                                id_attribute: null,
                                id_user: 'usuari',

                                // Used to determine with fields and how show
                                type: 'tipo_article',

                                description: 'descripcio_article',
                                quantity: 'quantitat',
                                serial_number: 'numero_serie', // Technological identifier
                                lot: 'lot', // Nutrition identifier
                                expiration: 'caducitat', // It's a informative date
                                cost: 'preu_fixe',
                                price: 'preu',
                                iva: 'iva',
                                surcharge: 'recarrec',
                                discount: 'descompte',

                                reference: 'referencia_article',
                                reference_customer: 'referencia_client',

                                create_date: 'fecha',
                                update_date: null,
                            },
                        },

                        ticket_complement: {
                            title: 'Complementos de las líneas del tíquet',

                            fields: [
                                {label: 'Código línea del tíquet', description: 'Identificador único de la línea del tíquet', name: "id_ticket_line", type: 'int'},

                                {label: 'Código complemento', description: 'Identificador único del complemento', name: "id_complement", type: 'int'},

                                // Same structure as ticket_line
                                {label: 'Descripción', description: '', name: "description", type: 'string'},
                                {label: 'Cantidad', description: '', name: "quantity", type: 'float'},
                                {label: 'Número de série', description: '', name: "serial_number", type: 'string'}, // Technological identifier
                                {label: 'Lote', description: '', name: "lot", type: 'string'}, // Nutrition identifier
                                {label: 'Caducidad', description: '', name: "expiration", type: 'string'}, // It's a informative date
                                {label: 'Coste', description: '', name: "cost", type: 'float'},
                                {label: 'Precio', description: 'Precio total del complemento', name: "price", type: 'float'},
                                {label: 'IVA', description: '', name: "iva", type: 'float'},
                                {label: 'Recargo', description: '', name: "surcharge", type: 'float'},
                                {label: 'Descuento', description: '', name: "discount", type: 'float'},

                                {label: 'Referencia propia', description: 'Referencia interna', name: "reference", type: 'string'},
                                {label: 'Referencia para el cliente', description: '', name: "reference_customer", type: 'string'},

                                {label: 'Fecha de creación', description: 'Fecha de la primera edición', name: "create_date", type: 'Date'},
                                {label: 'Fecha de modificación', description: 'Fecha de la última modificación', name: "update_date", type: 'Date'},
                            ],

                            columns: [
                                'id',
                                'id_linea',
                                'quantitat',
                                'complemento',
                                'iva',
                                'import',
                            ],

                            fields_columns: {
                                id_ticket_line: 'id_linea',

                                id_complement: 'id',

                                // Same structure as ticket_line
                                description: 'complemento',
                                quantity: 'quantitat',
                                serial_number: null, // Technological identifier
                                lot: null, // Nutrition identifier
                                expiration: null, // It's a informative date
                                cost: null,
                                price: 'import',
                                iva: 'iva',
                                surcharge: null,
                                discount: null,

                                reference: null,
                                reference_customer: null,

                                create_date: 'fecha',
                                update_date: null,
                            },
                        },

                        ticket_receipt: {
                            title: 'Recibo del tíquet',

                            fields: [
                                {label: 'Código tíquet', description: '', name: "id_ticket", type: 'int'},

                                // receipt
                                {label: 'Código', description: 'Identificador único del recibo', name: "id", type: 'int'},
                                {label: 'Código factura', description: 'Identificador único de la factura', name: "id_invoice", type: 'int'},
                                {label: 'Código usuario', description: 'Identificador único del usuario', name: "id_user", type: 'int'},
                                {label: 'Código cuenta de ingreso', description: 'Identificador único de la cuenta de ingreso', name: "id_income_account", type: 'int'},

                                {label: 'Número', description: 'Número de recibo', name: "number", type: 'int'},
                                {label: 'Método de pago', description: 'Método de pago usado', name: "collection_method", type: 'string'}, // cash, card, transfer, paypal, bizum, other
                                {label: 'Pagado', description: 'Importe pagado', name: "paid", type: 'float'}, // Float/Boolean
                                {label: 'Total', description: 'Importe total del documento', name: "total", type: 'float'},

                                {label: 'Fecha de pago', description: 'Fecha de pago', name: "paid_date", type: 'Date'},
                                {label: 'Fecha de expiración', description: 'Fecha de expiración del pago', name: "expiration_date", type: 'Date'},
                                {label: 'Fecha de creación', description: 'Fecha de la primera edición', name: "create_date", type: 'Date'},
                                {label: 'Fecha de modificación', description: 'Fecha de la última modificación', name: "update_date", type: 'Date'},
                            ],

                            columns: [
                                'codi',
                                'codi_factura',
                                'empresa',
                                'import',
                                'fecha',
                                'venciment',
                                'client',
                                'cobrat',
                                'fecha_cobro',
                                'codi_compte_ingres',
                                'modalitat_cobro',
                                'numero_efecte',
                                'usuari',
                                'tancat',
                                'caixa',
                                'id_torn',
                            ],

                            fields_columns: {
                                id_ticket: 'codi_factura',

                                id: 'codi',
                                id_invoice: 'codi_factura',
                                id_user: 'usuari',
                                id_income_account: 'codi_compte_ingres',

                                number: 'numero_efecte',
                                collection_method: 'modalitat_cobro', // cash, card, transfer, paypal, bizum, other
                                paid: 'cobrat', // Float/Boolean
                                total: 'import',

                                paid_date: 'fecha_cobro',
                                expiration_date: 'venciment',
                                create_date: 'fecha',
                                update_date: null,
                            },
                        },

                        customer: {
                            title: 'Clientes',
                            fields: [
                                {label: 'Código cliente', description: '', name: "id", type: 'int'},

                                {label: 'IVA', description: '', name: "iva", type: 'float'},
                                {label: 'IRPF', description: '', name: "irpf", type: 'float'},

                                {label: 'Nombre comercial', description: '', name: "corporation_name", type: 'string'},
                                {label: 'Nombre', description: '', name: "name", type: 'string'},
                                {label: 'Nombre fiscal', description: '', name: "taxonomy_name", type: 'string'},
                                {label: 'Identificación fiscal', description: '', name: "taxonomy_identification", type: 'string'},
                                {label: 'Observaciones', description: '', name: "observations", type: 'string'},
                                {label: 'Texto TPV', description: '', name: "text_tpv", type: 'string'},
                                {label: 'Imagen', description: '', name: "img", type: 'string'},
                                {label: 'Imagen secundaria', description: 'Usada por ejemple al tener una mesa llena en el comedor', name: "img_secondary", type: 'string'},
                                {label: 'Referencia', description: '', name: "reference", type: 'string'},

                                {label: 'Género', description: '', name: "gender", type: 'string'},
                                {label: 'Origen', description: 'Dónde conoció la empresa el cliente', name: "origin", type: 'string'},
                                {label: 'Targeta de la seguridad social', description: 'Número de la targeta de la seguridad social', name: "social_security_card", type: 'string'},
                                {label: 'Importe de la pensión', description: '', name: "pension_amount", type: 'float'},

                                {label: 'Dirección', description: '', name: "address", type: 'string'},
                                {label: 'Código Postal', description: '', name: "postal_code", type: 'string'},
                                {label: 'Ciudad', description: '', name: "town", type: 'string'},
                                {label: 'Provincia', description: '', name: "state", type: 'string'},

                                {label: 'Nombre del contacto', description: '', name: "contact_name", type: 'string'},
                                {label: 'Teléfono', description: '', name: "phone", type: 'string'},
                                {label: 'Teléfono 2', description: '', name: "phone2", type: 'string'},
                                {label: 'Fax', description: '', name: "fax", type: 'string'},
                                {label: 'Móvil', description: '', name: "mobile", type: 'string'},
                                {label: 'Email', description: '', name: "email", type: 'string'},

                                {label: 'Notificaciones', description: 'Notificaciones habilitadas', name: "notifications_enabled", type: 'boolean'},
                                {label: 'Notificaciones básicas', description: 'Notificaciones básicas habilitadas', name: "notifications_basic_enabled", type: 'boolean'},
                                {label: 'Notificaciones publicidad', description: 'Notificaciones publicidad habilitadas', name: "notifications_publicity_enabled", type: 'boolean'},
                                {label: 'Otras notificaciones', description: 'Otras notificaciones habilitadas', name: "notifications_others_enabled", type: 'boolean'},

                                {label: 'Categoría SMS', description: 'Nombre de la categoría de sms que recibe el cliente', name: "taxonomy_sms", type: 'int'},
                                {label: 'Categoría email', description: 'Nombre de la categoría de email que recibe el cliente', name: "taxonomy_email", type: 'int'},

                                {label: 'Puntos', description: 'Puntos del programa de fidelización', name: "points", type: 'int'},
                                {label: 'Nivel', description: 'Nivel del programa de fidelización', name: "level", type: 'int'},

                                {label: 'Periodicidad', description: 'Intervalo de tiempo entre pagos', name: "periodicity", type: 'string'},
                                {label: 'Cuenta donde se carga', description: 'Cuenta de la empresa por defecto donde se carga', name: "account_charge", type: 'string'},
                                {label: 'Tarifa', description: 'Tarifa por defecto del cliente', name: "rate", type: 'string'},
                                {label: 'Recargo de equivalencia', description: 'Aplicación del recargo de equivalencia por defecto', name: "surcharge", type: 'string'},
                                {label: 'Código contable', description: 'Código contable del cliente', name: "countable_code", type: 'string'},
                                {label: 'Día de pago 1', description: '', name: "payment_day", type: 'string'},
                                {label: 'Día de pago 2', description: '', name: "payment_day2", type: 'string'},
                                {label: 'Código del banco', description: 'Código del banco del cliente', name: "payment_bank", type: 'int'},
                                {label: 'Código de la entidad', description: 'Código de la entidad bancaria del cliente', name: "payment_entity", type: 'int'},
                                {label: 'Código de la agencia', description: 'Código de la agencia bancaria del cliente', name: "payment_agency", type: 'int'},
                                {label: 'Dígito de control', description: 'Dígito de control bancario del cliente', name: "payment_control_digit", type: 'int'},
                                {label: 'Cuenta de pago', description: 'Cuenta contable por defecto de la empresa donde se realiza el cobro', name: "payment_account", type: 'int'},
                                {label: 'Método de pago', description: 'Forma de pago del cliente por defecto', name: "payment_method", type: 'string'},
                                {label: 'Descuento del tíquet', description: 'Descuento por defecto en el tíquet', name: "discount_document", type: 'float'},
                                {label: 'Descuento de producto', description: 'Descuento por defecto en cada producto del tíquet', name: "discount_product", type: 'float'},
                                {label: 'Descuento por pronto pago', description: 'Descuento por defecto por pronto pago del tíquet', name: "discount_prompt_payment", type: 'float'},

                                {label: 'Comensales', description: 'El cliente puede ser una mesa por ejemplo. Este dato se usa para estadísticas.', name: "diners", type: 'int'},
                                {label: 'Identifiación de la mesa', description: 'Si el cliente es una mesa o símil puede tener su propio identificador.', name: "table_id", type: 'int'},
                                {label: 'Mesa en uso', description: 'Dato transitorio que indica si la mesa está en uso.', name: "table_in_use", type: 'boolean'},
                                {label: 'Identificación del comedor', description: 'Identificador del comedor o símil donde se encuentra el cliente.', name: "dinning_room_id", type: 'int'},

                                {label: 'Habilitado', description: 'Indica si el cliente está activo o no.', name: "enabled", type: 'boolean'},

                                {label: 'Usuario creador', description: 'Usuario que dió de alta el cliente.', name: "creator_user_id", type: 'int'},
                                {label: 'Último usuario editor', description: 'Último usuario que editó el cliente.', name: "update_user_id", type: 'int'},
                                {label: 'Vendedor asignado', description: 'Vendedor actual para el cliente.', name: "seller_user_id", type: 'int'},

                                {label: 'Fecha de cumpleaños', description: '', name: "birthday_date", type: 'Date'},
                                {label: 'Fecha de creación', description: '', name: "create_date", type: 'Date'},
                                {label: 'Fecha de eliminación', description: '', name: "drop_date", type: 'Date'},
                                {label: 'Fecha de modificación', description: '', name: "update_date", type: 'Date'},
                            ],

                            columns: [
                                'codi',
                                'empresa',
                                'nombre',
                                'nombre_comercial',
                                'direccion',
                                'codigo_postal',
                                'poblacion',
                                'tel_1',
                                'tel_2',
                                'fax',
                                'mobil',
                                'categoria_sms',
                                'categoria_email',
                                'email',
                                'dni',
                                'persona_contacto',
                                'observaciones',
                                'forma_pago',
                                'banco',
                                'entidad',
                                'agencia',
                                'dc',
                                'cuenta',
                                'dia_pago1',
                                'dia_pago2',
                                'descompte_pp',
                                'descompte_client',
                                'codi_comptable',
                                'alertar',
                                'provincia',
                                'mostrar',
                                'comensales',
                                'tarifa',
                                'iva',
                                'taula',
                                'menjador',
                                'taula_plena',
                                'recarrec',
                                'irpf',
                                'descompte_arti',
                                'descompte_comp',
                                'procedencia',
                                'client_origen',
                                'sexe',
                                'naixament',
                                'identificaio',
                                'venedor',
                                'inactiu',
                                'compta_cobrament',
                                'data_alta',
                                'data_baixa',
                                'targeta_ss',
                                'seguretat_social',
                                'import_pensio',
                                'periodicitat',
                                'punts',
                                'nivell_comisio',
                            ],

                            fields_columns: {
                                id: 'codi',
                                iva: 'iva',
                                irpf: 'irpf',
                                corporation_name: 'nombre_comercial',
                                name: 'nombre',
                                taxonomy_name: '',
                                taxonomy_identification: 'dni',
                                observations: 'observaciones',
                                address: 'direccion',
                                postal_code: 'codigo_postal',
                                town: 'poblacion',
                                state: 'provincia',
                                contact_name: 'persona_contacto',
                                phone: 'tel_1',
                                phone2: 'tel_2',
                                fax: 'fax',
                                mobile: 'mobil',
                                email: 'email',
                                notifications_enabled: 'alertar',
                                notifications_basic_enabled: '',
                                notifications_publicity_enabled: '',
                                notifications_others_enabled: '',
                                taxonomy_sms: 'categoria_sms',
                                taxonomy_email: 'categoria_email',
                                discount_prompt_payment: 'descompte_pp',
                                discount_product: 'descompte_arti',
                                discount_document: 'descompte_client',
                                payment_method: 'forma_pago',
                                payment_account: 'cuenta',
                                payment_entity: 'entidad',
                                payment_bank: 'banco',
                                payment_control_digit: 'dc',
                                payment_agency: 'agencia',
                                payment_day: 'dia_pago1',
                                payment_day2: 'dia_pago2',
                                countable_code: 'codi_comptable',
                                surcharge: 'recarrec',
                                rate: 'tarifa',
                                account_charge: 'compta_cobrament',
                                periodicity: 'periodicitat',
                                diners: 'comensales',
                                table_id: '',
                                dinning_room_id: 'menjador',
                                table_in_use: '',
                                origin: 'client_origen', // procedencia
                                gender: 'sexe',
                                social_security_card: 'targeta_ss', // seguretat_social
                                pension_amount: 'import_pensio',
                                birthday_date: 'naixament',
                                reference: 'identificaio',
                                creator_user_id: '',
                                update_user_id: '',
                                seller_user_id: 'venedor',
                                img: 'taula',
                                img_secondary: 'taula_plena', // Sample: used to dinning room when customers fill table
                                text_tpv: '',
                                points: 'punts',
                                level: 'nivell_comisio',
                                enabled: 'mostrar', // inactiu
                                create_date: 'data_alta',
                                drop_date: 'data_baixa',
                                update_date: '',
                            },
                        },

                        customer_search: {
                            title: 'Clientes - Búsqueda',
                            fields: [
                                {label: 'Código cliente', description: 'Tiene que ser el mismo código que identifica a los clientes del apartado anterior', name: "id_customer", type: 'int'},

                                {label: 'Nombre comercial', description: '', name: "corporation_name", type: 'string'},
                                {label: 'Nombre', description: '', name: "name", type: 'string'},
                                {label: 'Nombre fiscal', description: '', name: "taxonomy_name", type: 'string'},
                                {label: 'Identificación fiscal', description: '', name: "taxonomy_identification", type: 'string'},
                                {label: 'Referencia', description: '', name: "reference", type: 'string'},
                            ],

                            columns: [
                                'codi',
                                'empresa',
                                'nombre',
                                'nombre_comercial',
                                'direccion',
                                'codigo_postal',
                                'poblacion',
                                'tel_1',
                                'tel_2',
                                'fax',
                                'mobil',
                                'categoria_sms',
                                'categoria_email',
                                'email',
                                'dni',
                                'persona_contacto',
                                'observaciones',
                                'forma_pago',
                                'banco',
                                'entidad',
                                'agencia',
                                'dc',
                                'cuenta',
                                'dia_pago1',
                                'dia_pago2',
                                'descompte_pp',
                                'descompte_client',
                                'codi_comptable',
                                'alertar',
                                'provincia',
                                'mostrar',
                                'comensales',
                                'tarifa',
                                'iva',
                                'taula',
                                'menjador',
                                'taula_plena',
                                'recarrec',
                                'irpf',
                                'descompte_arti',
                                'descompte_comp',
                                'procedencia',
                                'client_origen',
                                'sexe',
                                'naixament',
                                'identificaio',
                                'venedor',
                                'inactiu',
                                'compta_cobrament',
                                'data_alta',
                                'data_baixa',
                                'targeta_ss',
                                'seguretat_social',
                                'import_pensio',
                                'periodicitat',
                                'punts',
                                'nivell_comisio',
                            ],

                            fields_columns: {
                                id_customer: 'codi',
                                corporation_name: 'nombre_comercial',
                                name: 'nombre',
                                taxonomy_name: '',
                                taxonomy_identification: 'dni',
                                reference: 'identificaio',
                            },
                        },
                    },
                },
            },
        }
    },

    computed: {
        stored_config () {
            return this.$store.state.global.config
        }
    },

    watch: {
        is_saved (newValue) {
            if (newValue) {
                this.is_saved_icon = 'save'
            } else {
                this.is_saved_icon = 'pencil-alt'
            }
        },

        // Transform directory variables
        'model.data_dir' (newValue) {
            if (newValue instanceof File) {
                this.model.data_dir = {
                    name: this.model.data_dir.name,
                    path: this.model.data_dir.path,
                }
            }
            if (! newValue) {
                this.model.data_dir = { name: 'data', path: 'app://data' }
            }
        },
        'model.import_dir' (newValue) {
            if (newValue instanceof File) {
                this.model.import_dir = {
                    name: this.model.import_dir.name,
                    path: this.model.import_dir.path,
                }
            }
            if (! newValue) {
                this.model.import_dir = { name: 'data', path: 'app://import_data' }
            }
        },

        // Set global config from updates (Transformer output)
        model: {
            deep: true,
            handler() {
                if (! this.stored_config.initialized) {
                    return
                }
                this.is_saved = false

                // Set config values used globally
                this.$vuetify.theme.themes.light.primary = this.model.branding.color_palette.primary
                this.$vuetify.theme.themes.light.secondary = this.model.branding.color_palette.secondary
                this.$vuetify.theme.themes.light.accent = this.model.branding.color_palette.accent
                this.$vuetify.theme.themes.light.success = this.model.branding.color_palette.success
                this.$vuetify.theme.themes.light.error = this.model.branding.color_palette.error
                this.$vuetify.theme.themes.light.warning = this.model.branding.color_palette.warning
                this.$vuetify.theme.themes.light.info = this.model.branding.color_palette.info

                Object.entries(this.model.tax_identification).forEach(([key, element]) => this.setConfig({ path: 'tax_identification>'+key, value:  element }))
                Object.entries(this.model.branding.color_palette).forEach(([key, element]) => this.setConfig({ path: 'branding>color_palette>'+key, value: element }))
                Object.entries(this.model.branding.style).forEach(([key, element]) => this.setConfig({ path: 'branding>style>'+key, value:  element }))
                this.setConfig({ path: 'customers', value: this.model.customers })
                this.setConfig({ path: 'turns', value: this.model.turns })
                Object.entries(this.model.layout_tpv).forEach(([key, element]) => this.setConfig({ path: 'layout_tpv>'+key, value:  element }))
                Object.entries(this.model.config_tpv.action.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>action>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.ticket.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>ticket>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.ticket_opened.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>ticket_opened>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.ticket_opened_customer.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>ticket_opened_customer>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.ticket_line.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>ticket_line>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.family.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>family>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.feature.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>feature>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.quantities.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>quantities>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.search.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>search>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.product.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>product>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.barcode.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>barcode>'+key, value:  element.value }))
                Object.entries(this.model.config_tpv.dining_room.values).forEach(([key, element]) => this.setConfig({ path: 'config_tpv>dining_room>'+key, value:  element.value }))
                Object.entries(this.model.config_turns.values).forEach(([key, element]) => this.setConfig({ path: 'config_turns>'+key, value:  element.value }))
                Object.entries(this.model.smtp.values).forEach(([key, element]) => this.setConfig({ path: 'smtp>'+key, value:  element.value }))
                this.setConfig({ path: 'data_dir', value: this.model.data_dir })
                this.setConfig({ path: 'import_dir', value: this.model.import_dir })
                Object.entries(this.model.import.domain.product.fields_columns).forEach(([key, element]) => this.setConfig({ path: 'import>domain>product>fields_columns>'+key, value:  element }))
                Object.entries(this.model.import.domain.family.fields_columns).forEach(([key, element]) => this.setConfig({ path: 'import>domain>family>fields_columns>'+key, value:  element }))
                Object.entries(this.model.import.domain.ticket.fields_columns).forEach(([key, element]) => this.setConfig({ path: 'import>domain>ticket>fields_columns>'+key, value:  element }))
                Object.entries(this.model.import.domain.ticket_line.fields_columns).forEach(([key, element]) => this.setConfig({ path: 'import>domain>ticket_line>fields_columns>'+key, value:  element }))
                Object.entries(this.model.import.domain.ticket_complement.fields_columns).forEach(([key, element]) => this.setConfig({ path: 'import>domain>ticket_complement>fields_columns>'+key, value:  element }))
                Object.entries(this.model.import.domain.ticket_receipt.fields_columns).forEach(([key, element]) => this.setConfig({ path: 'import>domain>ticket_receipt>fields_columns>'+key, value:  element }))
                Object.entries(this.model.import.domain.customer.fields_columns).forEach(([key, element]) => this.setConfig({ path: 'import>domain>customer>fields_columns>'+key, value:  element }))
                Object.entries(this.model.import.domain.customer_search.fields_columns).forEach(([key, element]) => this.setConfig({ path: 'import>domain>customer_search>fields_columns>'+key, value:  element }))

                // Set event to save config to file
                this.$nextTick(() => {
                    this.save_config_renderer_event = setTimeout(
                        () => ipcRenderer.send('save_config', this.$store.state.global.config),
                        this.default_seconds_to_save * 1000
                    )
                    // Every second update time to save until 0
                    this.seconds_to_save = this.default_seconds_to_save
                    let save_config_firing_event_function = () => {
                        if (this.seconds_to_save > 'saved') {
                            return
                        } else if (this.seconds_to_save > 0) {
                            this.seconds_to_save -= 1
                        } else {
                            this.seconds_to_save = 'saving'
                        }

                        this.save_config_firing_event = setTimeout( () => {
                            save_config_firing_event_function()
                        }, 1000)
                    }
                    save_config_firing_event_function()
                })
            },
        },
    },

    mounted() {
        // Set event to capture config file is saved or not from main process
        this.save_config_main_event = (event, is_saved) => {
            this.is_saved = is_saved
        }
        ipcRenderer.on('save_config', this.save_config_main_event)

        this.setIsContainerNeeded(true)
        this.fetchConfig(this.stored_config)
    },

    beforeDestroy() {
        // Destroy listener to save_config event from main process
        ipcRenderer.removeListener('save_config', this.save_config_main_event)
    },

    methods: {
        initTPV() {
            ipcRenderer.send('save_config', this.$store.state.global.config)
            this.$router.push('/')
        },

        // Set global config to local (Transformer input)
        // config_initialized should be false
        fetchConfig (config) {
            // Turn initialized to false to no override model data.
            this.$store.state.global.config.initialized = false
            // Execute at next tick to populate initialized
            this.$nextTick(() => {
                Object.entries(config.tax_identification).forEach(([key, element]) => this.model.tax_identification[key] = element)
                Object.entries(config.branding.color_palette).forEach(([key, element]) => this.model.branding.color_palette[key] = element)
                Object.entries(config.branding.style).forEach(([key, element]) => this.model.branding.style[key] = element)
                this.model.customers = config.customers
                this.model.turns = config.turns
                Object.entries(config.layout_tpv).forEach(([key, element]) => this.model.layout_tpv[key] = element)
                Object.entries(config.config_tpv.action).forEach(([key, element]) => this.model.config_tpv.action.values[key].value = element)
                Object.entries(config.config_tpv.ticket).forEach(([key, element]) => this.model.config_tpv.ticket.values[key].value = element)
                Object.entries(config.config_tpv.ticket_opened).forEach(([key, element]) => this.model.config_tpv.ticket_opened.values[key].value = element)
                Object.entries(config.config_tpv.ticket_opened_customer).forEach(([key, element]) => this.model.config_tpv.ticket_opened_customer.values[key].value = element)
                Object.entries(config.config_tpv.ticket_line).forEach(([key, element]) => this.model.config_tpv.ticket_line.values[key].value = element)
                Object.entries(config.config_tpv.family).forEach(([key, element]) => this.model.config_tpv.family.values[key].value = element)
                Object.entries(config.config_tpv.feature).forEach(([key, element]) => this.model.config_tpv.feature.values[key].value = element)
                Object.entries(config.config_tpv.quantities).forEach(([key, element]) => this.model.config_tpv.quantities.values[key].value = element)
                Object.entries(config.config_tpv.search).forEach(([key, element]) => this.model.config_tpv.search.values[key].value = element)
                Object.entries(config.config_tpv.product).forEach(([key, element]) => this.model.config_tpv.product.values[key].value = element)
                Object.entries(config.config_tpv.barcode).forEach(([key, element]) => this.model.config_tpv.barcode.values[key].value = element)
                Object.entries(config.config_tpv.dining_room).forEach(([key, element]) => this.model.config_tpv.dining_room.values[key].value = element)
                Object.entries(config.config_turns).forEach(([key, element]) => this.model.config_turns.values[key].value = element)
                Object.entries(config.smtp).forEach(([key, element]) => this.model.smtp.values[key].value = element)
                this.model.data_dir = config.data_dir
                this.model.import_dir = config.import_dir
                Object.entries(config.import.domain.product.fields_columns).forEach(([key, element]) => this.model.import.domain.product.fields_columns[key] = element)
                Object.entries(config.import.domain.family.fields_columns).forEach(([key, element]) => this.model.import.domain.family.fields_columns[key] = element)
                Object.entries(config.import.domain.ticket.fields_columns).forEach(([key, element]) => this.model.import.domain.ticket.fields_columns[key] = element)
                Object.entries(config.import.domain.ticket_line.fields_columns).forEach(([key, element]) => this.model.import.domain.ticket_line.fields_columns[key] = element)
                Object.entries(config.import.domain.ticket_complement.fields_columns).forEach(([key, element]) => this.model.import.domain.ticket_complement.fields_columns[key] = element)
                Object.entries(config.import.domain.ticket_receipt.fields_columns).forEach(([key, element]) => this.model.import.domain.ticket_receipt.fields_columns[key] = element)
                Object.entries(config.import.domain.customer.fields_columns).forEach(([key, element]) => this.model.import.domain.customer.fields_columns[key] = element)
                Object.entries(config.import.domain.customer_search.fields_columns).forEach(([key, element]) => this.model.import.domain.customer_search.fields_columns[key] = element)
                this.$store.state.global.config.initialized = true
            })
        },

        ...mapActions('global', [
            'setIsContainerNeeded',
            'setConfig',
            'setConfigComplete',
        ]),
    },
}
</script>
