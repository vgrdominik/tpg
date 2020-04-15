export default {
    methods: {
        getValueToDatePicker(dateObject) {
            if (!dateObject) {
                return
            }
            let [{value: mo}, , {value: da}, , {value: ye}] = this.$store.state.global.date_format.formatToParts(dateObject)

            return ye + '-' + mo + '-' + da
        },
    }
}
