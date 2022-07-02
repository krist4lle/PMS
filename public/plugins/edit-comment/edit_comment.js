const editCommentButtons = document.querySelectorAll('#editCommentButton');
const editCancelButtons = document.querySelectorAll('#editCancelButton');
const editCommentForms = document.querySelectorAll('#editCommentForm');
const commentContents = document.querySelectorAll('#commentContent');

editCommentButtons.forEach((editCommentButton, index) => {
    editCommentButton.onclick = function () {
        editCommentForms[index].setAttribute('style', 'display: block');
        commentContents[index].setAttribute('style', 'display: none');
    }
});

editCancelButtons.forEach((editCancelButton, index) => {
    editCancelButton.onclick = function () {
        editCommentForms[index].setAttribute('style', 'display: none');
        commentContents[index].setAttribute('style', 'display: block');
    }
});
