import Inputmask from "inputmask";

export default {

    bind(el, binding) {

        let unmask = binding.value && binding.value.unmask ? binding.value.unmask : false;

        /** NUMBER */
        if (binding.arg === 'number') {
            Inputmask({
                alias: 'currency',
                radixPoint: binding.value && binding.value.radix ? binding.value.radix : ',',
                prefix: binding.value && binding.value.prefix ? binding.value.prefix : '',
                digits: binding.value && binding.value.decimal ? binding.value.decimal : 0,
                groupSeparator: binding.value && binding.value.marks ? binding.value.marks : '',
                autoUnmask: unmask
            }).mask(el);
        }

        /** CURRENCY */
        else if (binding.arg === 'currency') {
            Inputmask({
                alias: 'currency',
                radixPoint: binding.value && binding.value.radix ? binding.value.radix : ',',
                prefix: binding.value && binding.value.prefix ? binding.value.prefix : '',
                digits: binding.value && binding.value.decimal ? binding.value.decimal : 2,
                groupSeparator: binding.value && binding.value.marks ? binding.value.marks : '.',
                autoUnmask: unmask
            }).mask(el);
        }

        /** DATE */
        else if (binding.arg === 'date') {
            Inputmask({
                alias: binding.value && binding.value.dateType === 'month' ? "mm/yyyy" :
                    binding.value && binding.value.dateType === 'year' ? "9999" :
                    "date"
            }).mask(el);
        }

        /** CPF */
        else if (binding.arg === 'cpf') {
            Inputmask({
                mask: ['999.999.999-99'],
                autoUnmask: unmask,
                onUnMask: function(maskedValue) {
                    return maskedValue.replace(/\./g, '').replace(/-/g, '').replace(/_/g, '');
                }
            }).mask(el);
            $(el).addClass('text-center');
        }

        /** CNPJ */
         else if (binding.arg === 'cnpj') {
            Inputmask({
                mask: ['99.999.999/9999-99'],
                autoUnmask: unmask,
                onUnMask: function(maskedValue) {
                    return maskedValue.replace(/\./g, '').replace(/-/g, '').replace(/\//g, '').replace(/_/g, '');
                }
            }).mask(el);
            $(el).addClass('text-center');
        }

        /** CPFCNPJ */
        else if (binding.arg === 'cpfcnpj') {
            Inputmask({
                mask: ['999.999.999-99', '99.999.999/9999-99'],
                keepStatic: true,
                autoUnmask: unmask,
                onUnMask: function(maskedValue) {
                    return maskedValue.replace(/\./g, '').replace(/-/g, '').replace(/\//g, '').replace(/_/g, '');
                }
            }).mask(el);
            $(el).addClass('text-center');
        }

        /** CELTEL */
        else if (binding.arg === 'celtel') {
            Inputmask({
                mask: ['(99)9999-9999', '(99)99999-9999'],
                keepStatic: true,
                autoUnmask: unmask,
                onUnMask: function(maskedValue) {
                    return maskedValue.replace(/-/g, '').replace(/_/g, '').replace(/\)/g, '').replace(/\(/g, '');
                }
            }).mask(el);
            $(el).addClass('text-center');
        }

        /** CEP */
        else if (binding.arg === 'cep') {
            Inputmask({
                mask: ['99999-999'],
                autoUnmask: unmask,
                onUnMask: function(maskedValue) {
                    return maskedValue.replace(/-/g, '').replace(/_/g, '');
                }
            }).mask(el);
            $(el).addClass('text-center');
        }

        /** OBJECT */
        else if (binding.arg === 'object') {
            if (!binding.value.ignore) {
                Inputmask(binding.value).mask(el);
                $(el).addClass('text-center');
            }
        }
    }
}