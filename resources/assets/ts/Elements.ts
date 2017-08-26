class Elements {
    private elements = {};
    constructor() {
        this.elements['ajaxForm'] = $('.form-ajax');
        this.elements['tableSortable'] = $('.table.table-sortable');
        this.elements['altHref'] = $('[data-href]');
        this.elements['colorInput'] = $('input[type="color"], .colorpicker-component');
        this.attach();
    }

    public attach() {
        this.get('tableSortable').dataTable({
            searching: false
        });
        this.get('colorInput').colorpicker();
    }

    public get(param: string) {
        return this.elements[param];
    }
}