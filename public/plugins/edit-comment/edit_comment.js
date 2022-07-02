const editCommentButtons = document.querySelectorAll('#editCommentButton');
const editCancelButtons = document.querySelectorAll('#editCancelButton');
const editCommentForms = document.querySelectorAll('#editCommentForm');

editCommentButtons.forEach((editCommentButton, index) => {
    editCommentButton.onclick = function () {
        editCommentForms[index].setAttribute('style', 'display: block');
    }
});

editCancelButtons.forEach((editCancelButton, index) => {
    editCancelButton.onclick = function () {
        editCommentForms[index].setAttribute('style', 'display: none');
    }
});
