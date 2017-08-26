class app {
    private events: Events;

    constructor(private $doc: any, private $win: any, private config: {}) {
        this.events = new Events($doc, $win, config);
    }

    public run() {
        this.events.registerEvents();
    }
}

if(typeof $ == 'undefined') {
    function $(param: any, param1?: any) {}
}
new app($(document), $(window), window.config).run();
