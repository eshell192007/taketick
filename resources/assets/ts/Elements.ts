class Elements {
    private elements = {};
    constructor(private config: {}) {
        this.elements['ajaxForm'] = $('.form-ajax');
        this.elements['tableSortable'] = $('.table.table-sortable');
        this.elements['altHref'] = $('[data-href]');
        this.elements['recordAdd'] = $('.btn-record-add');
        this.elements['recordRemove'] = $('.btn-record-remove');
        this.elements['recordEdit'] = $('.btn-record-edit');
        this.attach();
    }

    public attach() {
        if(this.get('tableSortable').length > 0) {
            this.get('tableSortable').dataTable({
                searching: false
            });
        }
        this.refresh();
    }

    public refresh() {
        this.elements['colorInput'] = $('input[type="color"], .colorpicker-component');
        if(this.get('colorInput').length > 0) {
            this.get('colorInput').colorpicker();
        }
    }

    public get(param: string) {
        return this.elements[param];
    }

    public recordForm(group: string, name?: string, color?: string, id?: number, params?: {} = {}) {
        color = color || '#ffffff';
        name = name || '';
        id = id || 0;
        let input = '';
        if(group === 'priority') {
            input += `
            <div class="form-group">
              <label for="${group}-${id}-priority" class="label">${this.config['i18n']['Priority']}</label>
              <input type="number" name="priority" value="${params['priority']}" class="form-control" id="${group}-${id}-priority">
            </div>
            `;
        }
        return `
        <div class="record-form" data-name="${group}" data-id="${id}">
          <div class="form-group">
            <label for="${group}-${id}-name" class="label">${this.config['i18n']['Name']}</label>
            <input type="text" name="name" id="${group}-${id}-name" class="form-control form-name" value="${name}">
          </div>
          <div class="form-group">
            <label for="${group}-${id}-color" class="label">${this.config['i18n']['Color']}</label>
            <div class="input-group colorpicker-component">
              <input type="text" name="color" id="${group}-${id}-color" value="${color}" class="form-control form-color">
              <span class="input-group-addon"><i></i></span>
            </div>
          </div>
          ${input}
          <div class="form-group">
            <button class="btn btn-sm btn-outline-success btn-record-save" type="button">
              <span class="fa fa-save"></span>
              ${this.config['i18n']['Save']}
            </button>
          </div>
        </div>
        `;
    }

    public recordRow(name: string, color: string, param?: {} = {}) {
        let info = '';
        if(name === 'priority') {
            info = `
            <small class="priority">${param['priority']}</small>
            `;
        }
        return `
        <div class="btn-group float-right">
          <button type="button" class="btn btn-outline-primary btn-sm btn-record-edit">
            <span class="fa fa-pencil"></span>
          </button>
          <button type="button" class="btn btn-outline-danger btn-sm btn-record-remove">
            <span class="fa fa-trash"></span>
          </button>
        </div>
        <span class="badge badge-default badge-pill" style="background-color: ${color}">&nbsp;</span>
        <span class="name">${name}</span>
        ${info}
        `;
    }

    public message(subject: string, detail: string, fromLink: string, fromLabel: string, dateDiff: string) {
        return `
        <li class="list-group-item d-block">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">
              <a href="${fromLink}">${fromLabel}</a>
            </h5>
            <small class="text-muted">${dateDiff}</small>
          </div>
          <strong class="mb-1">${subject}</strong>
          <div class="clearfix"></div>
          <div class="message-body">${detail}</div>
        </li>
        `;
    }
}