class Callbacks {
    constructor(private $doc: any, private $win: any, private config: {}, private elements: Elements) {}

    /* === CALLBACKS === */

    public insertId(response) {
        $('[data-id="0"]').attr('data-id', response.id)
    }

    public messageAdd(response) {
        let $rf = $('#reply-form');
        $rf.before(this.elements.message(
            response['subject'],
            response['detail'],
            response['fromLink'],
            response['fromLabel'],
            response['dateDiff']
        ));
        $rf.find('textarea').val('');
        $('.scrollbar-bottom').scrollTop(Math.pow(10,10))
    }
}