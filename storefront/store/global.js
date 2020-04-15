export const state = () => ({
  is_container_needed: '',
  date_format: new Intl.DateTimeFormat('en', { year: 'numeric', month: '2-digit', day: '2-digit' }),

  // miliseconds
  time_to_sync: 8000,
  default_time_to_sync: 8000,

  config: {
    initialized: false,

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

    // Default config data. Updated by stored file config
    config_tpv: {
      // Actions
      action: {
        maximize: true,
        open_money: false,
        exit: true,
        refresh: true,
        alerts: true,
      },

      // Ticket List
      ticket: {
        show_closed: true,
        closed_number: 10,
        name: false,
        check: false,
        collect: true,
        collect_direct: true,
        send_custom: true,
        delete: true,
      },

      // Ticket Opened
      ticket_opened: {
        save: false,
        close: false,
        save_close: true,
        total_price: true,
        send: true,
        delete: true,
      },

      // Ticket Opened - Customer
      ticket_opened_customer: {
        unfolded: false,
        link: true,
        update: true,
        temporary_discount_product: true,
        temporary_discount_pay_soon: true,
        temporary_discount_customer: true,
        temporary_apply_zone_tax: false,
        temporary_apply_equivalence_surcharge: false,
        temporary_apply_irpf: false,
        temporary_apply_rate: '1',
        temporary_save: true,
      },

      // Ticket - Lines
      ticket_line: {
        discount: true,
        unit_price: true,
        unit: true,
        total_price: true,
        complements: true,
        delete: true,
        send: false,
      },

      // Families
      family: {
        image: true,
        image_size: 'md',
        text: true,
        text_size: 'md',
      },

      // Feature
      feature: {
          text_size: 'md',
      },

      // Quantities
      quantities: {
        unfolded: false,
        linear: true,
      },

      // Search
      search: {
        show: true,
      },

      // Product List
      product: {
        show_price: false,
        image: true,
        image_size: 'md',
        text: true,
        text_size: 'md',
      },

      // Barcode
      barcode: {
        show: false,
      },

      // Dining rooms
      dining_room: {
        show: false,
      }
    },

    // Turns
    config_turns: {
      text_size: 'md',
      description: true,
    },

    // SMTP
    smtp: {
        host: '',
        user: '',
        password: '',
        port: '587',
        type_encryption: 'TLS',
        email_equal_user: true,
        email: '',
        email_password_equal_user: true,
        email_password: '',
    },

    // Directories
    data_dir: { name: 'data', path: 'app://data' }, // default -> { name: 'data', path: 'app://./data' }
    import_dir: { name: 'import_data', path: 'app://import_data' }, // default -> { name: 'import_data', path: 'app://./import_data' }

    // Import
    import: {
      type: 'csv', // Currently only support csv. Api support soon.

      domain: {
        product: {
          fields: [
            {
              name: 'id',
              type: 'int',
            },
            {
              name: 'id_taxonomy',
              type: 'int',
            },
            {
              name: 'iva',
              type: 'float',
            },
            {
              name: 'ids_send_to',
              type: 'array',
            },
            {
              name: 'name',
              type: 'string',
            },
            {
              name: 'cost',
              type: 'float',
            },
            {
              name: 'base',
              type: 'float',
            },
            {
              name: 'total',
              type: 'float',
            },
            {
              name: 'reference',
              type: 'string',
            },
            {
              name: 'complement_unique',
              type: 'boolean',
            },
            {
              name: 'complement_show',
              type: 'boolean',
            },
            {
              name: 'complement_ids_available',
              type: 'string',
            },
            {
              name: 'complement_price',
              type: 'float',
            },
            {
              name: 'complement_text_tpv',
              type: 'string',
            },
            {
              name: 'complement_taxonomy',
              type: 'string',
            },
            {
              name: 'complement_enabled',
              type: 'boolean',
            },
            {
              name: 'enabled',
              type: 'boolean',
            },
            {
              name: 'img',
              type: 'string',
            },
            {
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
          fields: [
            {
              name: 'id',
              type: 'int',
            },
            {
              name: 'img',
              type: 'string',
            },
            {
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

          fields: [
            {name: "id", type: 'int'},
            {name: "id_customer", type: 'int'},
            {name: "id_user", type: 'int'},
            {name: "id_terminal", type: 'int'},
            {name: "id_turn", type: 'int'},

            // Payment parameters
            {name: "number", type: 'int'},
            {name: "irpf", type: 'float'},
            {name: "method_payment", type: 'string'},
            {name: "discount_prompt_payment", type: 'float'},
            {name: "discount_customer", type: 'float'},
            {name: "total", type: 'float'},

            // Number of customers related with ticket
            {name: "diners", type: 'int'},

            // pending, paid_check, paid
            {name: "state", type: 'string'},

            {name: "create_date", type: 'Date'},
            {name: "update_date", type: 'Date'},
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
          fields: [
            {name: "id_ticket", type: 'int'},
            {name: "id_ticket_line", type: 'int'},
            {name: "id_attribute", type: 'int'},
            {name: "id_user", type: 'int'},

            // Used to determine with fields and how show
            {name: "type", type: 'string'},

            {name: "description", type: 'string'},
            {name: "quantity", type: 'float'},
            {name: "serial_number", type: 'string'}, // Technological identifier
            {name: "lot", type: 'string'}, // Nutrition identifier
            {name: "expiration", type: 'string'}, // It's a informative date
            {name: "cost", type: 'float'},
            {name: "price", type: 'float'},
            {name: "iva", type: 'float'},
            {name: "surcharge", type: 'float'},
            {name: "discount", type: 'float'},

            {name: "reference", type: 'string'},
            {name: "reference_customer", type: 'string'},

            {name: "create_date", type: 'Date'},
            {name: "update_date", type: 'Date'},
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
          fields: [
            {name: "id_ticket_line", type: 'int'},

            {name: "id_complement", type: 'int'},

            // Same structure as ticket_line
            {name: "description", type: 'string'},
            {name: "quantity", type: 'float'},
            {name: "serial_number", type: 'string'}, // Technological identifier
            {name: "lot", type: 'string'}, // Nutrition identifier
            {name: "expiration", type: 'string'}, // It's a informative date
            {name: "cost", type: 'float'},
            {name: "price", type: 'float'},
            {name: "iva", type: 'float'},
            {name: "surcharge", type: 'float'},
            {name: "discount", type: 'float'},

            {name: "reference", type: 'string'},
            {name: "reference_customer", type: 'string'},

            {name: "create_date", type: 'Date'},
            {name: "update_date", type: 'Date'},
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
          fields: [
            {name: "id_ticket", type: 'int'},

            // receipt
            {name: "id", type: 'int'},
            {name: "id_invoice", type: 'int'},
            {name: "id_user", type: 'int'},
            {name: "id_income_account", type: 'int'},

            {name: "number", type: 'int'},
            {name: "collection_method", type: 'string'}, // cash, card, transfer, paypal, bizum, other
            {name: "paid", type: 'float'}, // Float/Boolean
            {name: "total", type: 'float'},

            {name: "paid_date", type: 'Date'},
            {name: "expiration_date", type: 'Date'},
            {name: "create_date", type: 'Date'},
            {name: "update_date", type: 'Date'},
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
          fields: [
            {label: "Código", description: "Identificador único del cliente.", modifiable: false, name: "id", type: 'int'},

            {label: "Iva", description: "Impuesto sobre el valor añadido por defecto.", modifiable: true, name: "iva", type: 'float'},
            {label: "Irpf", description: "Impuesto sobre la renta de las personas físicas por defecto.", modifiable: true, name: "irpf", type: 'float'},

            {label: "Nombre comercial", description: "Nombre comercial del cliente.", modifiable: true, name: "corporation_name", type: 'string'},
            {label: "Nombre interno", description: "Nombre interno de la empresa.", modifiable: true, name: "name", type: 'string'},
            {label: "Nombre fiscal", description: "Nombre en terminos fiscales del cliente.", modifiable: true, name: "taxonomy_name", type: 'string'},
            {label: "Identificación fiscal", description: "Identificación fiscal del cliente.", modifiable: true, name: "taxonomy_identification", type: 'string'},
            {label: "Observaciones", description: "Observaciones internas de la empresa.", modifiable: true, name: "observations", type: 'string'},
            {label: "Texto TPV", description: "Texto que va a salir en el TPV.", modifiable: true, name: "text_tpv", type: 'string'},
            {label: "Imagen", description: "Imagen o logo del cliente.", modifiable: true, name: "img", type: 'string'},
            {label: "Imagen secundaria", description: "Imagen usada cuando el cliente está en el local o activo de alguna forma.", modifiable: true, name: "img_secondary", type: 'string'},
            {label: "Referencia", description: "Referencia interna y/o externa del cliente.", modifiable: true, name: "reference", type: 'string'},

            {label: "Género", description: "Género del cliente. Se pide un uso especialmente responsable de este dato.", modifiable: true, name: "gender", type: 'string'},
            {label: "Origen", description: "Cómo ha conocido la empresa el cliente. Se pide un uso especialmente responsable de este dato.", modifiable: true, name: "origin", type: 'string'},
            {label: "Tarjeta de la seguridad social", description: "Tarjeta de la seguridad social del cliente. Se pide un uso especialmente responsable de este dato.", modifiable: true, name: "social_security_card", type: 'string'},
            {label: "Importe de la pensión", description: "Importe de la pensail del cliente. Se pide un uso especialmente responsable de este dato.", modifiable: true, name: "pension_amount", type: 'float'},

            {label: "Dirección", description: "Dirección del cliente.", modifiable: true, name: "address", type: 'string'},
            {label: "Código Postal", description: "Código Postal del cliente.", modifiable: true, name: "postal_code", type: 'string'},
            {label: "Pueblo/Ciudad", description: "Pueblo o ciudad del cliente.", modifiable: true, name: "town", type: 'string'},
            {label: "Provincia/Estado", description: "Provincia o estado del cliente.", modifiable: true, name: "state", type: 'string'},

            {label: "Nombre de contacto", description: "Nombre para el contacto con el cliente.", modifiable: true, name: "contact_name", type: 'string'},
            {label: "Teléfono", description: "Teléfono del cliente.", modifiable: true, name: "phone", type: 'string'},
            {label: "Teléfono secundario", description: "Teléfono secundario del cliente.", modifiable: true, name: "phone2", type: 'string'},
            {label: "Fax", description: "Fax del cliente", modifiable: true, name: "fax", type: 'string'},
            {label: "Móvil", description: "Móvil del cliente", modifiable: true, name: "mobile", type: 'string'},
            {label: "Correo electrónico", description: "Correo electrónico del cliente", modifiable: true, name: "email", type: 'string'},

            {label: "Notificaciones habilitadas", description: "Notificaciones para el cliente habilitadas", modifiable: true, name: "notifications_enabled", type: 'boolean'},
            {label: "Notificaciones básicas habilitadas", description: "Notificaciones básicas para el cliente habilitadas", modifiable: true, name: "notifications_basic_enabled", type: 'boolean'},
            {label: "Notificaciones publicitarias habilitadas", description: "Notificaciones publicitarias para el cliente habilitadas", modifiable: true, name: "notifications_publicity_enabled", type: 'boolean'},
            {label: "Otras notificaciones habilitadas", description: "Otras notificaciones para el cliente habilitadas", modifiable: true, name: "notifications_others_enabled", type: 'boolean'},

            {label: "Categoría para SMS", description: "Categorización para el envío de sms para el cliente", modifiable: true, name: "taxonomy_sms", type: 'int'},
            {label: "Categoría para EMAIL", description: "Categorización para el envío de correos electrónicos para el cliente", modifiable: true, name: "taxonomy_email", type: 'int'},

            {label: "Puntos", description: "Puntos de fidelización del cliente", modifiable: true, name: "points", type: 'int'},
            {label: "Nivel", description: "Nivel de fidelización del cliente", modifiable: true, name: "level", type: 'int'},

            {label: "Periodicidad", description: "Periodicidad por defecto del cliente", modifiable: true, name: "periodicity", type: 'string'},
            {label: "Cuenta de cargos", description: "Cuenta donde se carga el importe de los tíquets", modifiable: true, name: "account_charge", type: 'string'},
            {label: "Tarifa", description: "Tarifa por defecto del cliente", modifiable: true, name: "rate", type: 'string'},
            {label: "Recargo", description: "Aplicación del recargo por defecto en los tíquets", modifiable: true, name: "surcharge", type: 'boolean'},
            {label: "Código contable", description: "Código contable del cliente", modifiable: true, name: "countable_code", type: 'string'},
            {label: "Día de pago", description: "Día de pago del cliente", modifiable: true, name: "payment_day", type: 'string'},
            {label: "Día de pago 2", description: "Segundo día de pago del cliente", modifiable: true, name: "payment_day2", type: 'string'},
            {label: "Banco de la cuenta", description: "Banco de la cuenta del cliente", modifiable: true, name: "payment_bank", type: 'int'},
            {label: "Entidad bancaria de la cuenta", description: "Entidad bancaria de la cuenta del cliente", modifiable: true, name: "payment_entity", type: 'int'},
            {label: "Agencia de la cuenta", description: "Agencia de la cuenta del cliente", modifiable: true, name: "payment_agency", type: 'int'},
            {label: "Dígito de control de la cuenta", description: "Dígito de control de la cuenta del cliente", modifiable: true, name: "payment_control_digit", type: 'int'},
            {label: "Número de la cuenta", description: "Número de la cuenta del cliente", modifiable: true, name: "payment_account", type: 'int'},
            {label: "Método de pago", description: "Método de pago del cliente por defecto", modifiable: true, name: "payment_method", type: 'string'},
            {label: "Descuento de tíquet", description: "Descuento en los tíquets por defecto", modifiable: true, name: "discount_document", type: 'float'},
            {label: "Descuento de producto", description: "Descuento en los productos por defecto", modifiable: true, name: "discount_product", type: 'float'},
            {label: "Descuento pronto pago", description: "Descuento de pronto pago por defecto", modifiable: true, name: "discount_prompt_payment", type: 'float'},

            {label: "Comensales", description: "Comensales que representa el cliente por defecto", modifiable: true, name: "diners", type: 'int'},
            {label: "Identificador de mesa", description: "Identificador de mesa del cliente", modifiable: true, name: "table_id", type: 'int'},
            {label: "Mesa en uso", description: "Valor por defecto de mesa en uso", modifiable: true, name: "table_in_use", type: 'boolean'},
            {label: "Identificador del comedor", description: "Identificador del comedor por defecto", modifiable: true, name: "dinning_room_id", type: 'int'},

            {label: "Habilitado", description: "Indica si el cliente está habilitado", modifiable: true, name: "enabled", type: 'boolean'},

            {label: "Identificador del creador", description: "Identificación del usuario que lo creó", modifiable: true, name: "creator_user_id", type: 'int'},
            {label: "Identificador del modificador", description: "Identificador del último usuario que lo ha modificado", modifiable: true, name: "update_user_id", type: 'int'},
            {label: "Identificador del vendedor", description: "Identificador del usuario que atiende al cliente por defecto", modifiable: true, name: "seller_user_id", type: 'int'},

            {label: "Fecha de nacimiento", description: "Fecha de nacimiento del cliente", modifiable: true, name: "birthday_date", type: 'Date'},
            {label: "Fecha de creación", description: "Fecha de creación del cliente", modifiable: true, name: "create_date", type: 'Date'},
            {label: "Fecha de eliminación", description: "Fecha de eliminación del cliente", modifiable: true, name: "drop_date", type: 'Date'},
            {label: "Fecha de modificación", description: "Fecha de modificación", modifiable: true, name: "update_date", type: 'Date'},
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
          fields: [
            {name: "id_customer", type: 'int'},

            {name: "corporation_name", type: 'string'},
            {name: "name", type: 'string'},
            {name: "taxonomy_name", type: 'string'},
            {name: "taxonomy_identification", type: 'string'},
            {name: "reference", type: 'string'},
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
})

export const actions = {
  setIsContainerNeeded(state, is_container_needed) {
    state.commit('updateIsContainerNeeded', is_container_needed)
  },
  setConfig(state, payload) {
    state.commit('updateConfigValue', payload)
  },
  setConfigComplete(state, payload) {
    state.commit('updateConfigComplete', payload)
  },
  setTimeToSync(state, payload) {
    state.commit('updateTimeToSync', payload)
  },
}

export const mutations = {
  updateIsContainerNeeded (state, is_container_needed) {
    state.is_container_needed = is_container_needed
  },
  updateConfigComplete (state, config) {
    state.config = config
  },
  updateTimeToSync (state, time_to_sync) {
    state.time_to_sync = time_to_sync
  },

  updateConfigValue (state, { path, value }) {
    let pathStack = path.split('>')
    let stateConfig = state.config

    while (pathStack.length>1) {
      stateConfig = stateConfig[pathStack.shift()]
    }

    let elementToUpdate = pathStack.shift()
    stateConfig[elementToUpdate] = value
  },
}
