var $addBoardColumnLink = $('<a href="#" class="add_boardcolumn_link">Add a board column</a>');
var collectionHolder;

jQuery(document).ready(function() {
    collectionHolder = $('ul.boardColumns');
    collectionHolder.sortable();
    collectionHolder.after($addBoardColumnLink);
    collectionHolder.bind( "sortupdate", function(event, ui) {
        addIdToBoardColumns($(this));
    });
});

$addBoardColumnLink.on('click', function(e) {
    e.preventDefault();
    addBoardColumnForm(collectionHolder, $addBoardColumnLink);
});

function addIdToBoardColumns(collectionHolder) {
    collectionHolder.children().each(
        function(){
            newIndex = $(this).index();
            changedId = $(this).find(">:first-child").attr('id');
            $('input[id=' + changedId + '_ordering]').val(newIndex);
        }
)};

function addBoardColumnForm(collectionHolder, $addBoardColumnLink) {
    var prototype = collectionHolder.attr('data-prototype');
    var newForm = prototype.replace(/\$\$name\$\$/g, collectionHolder.children().length);
    var $newFormLi = $('<li></li>').append(newForm);
    collectionHolder.append($newFormLi);
    addIdToBoardColumns(collectionHolder);
}
