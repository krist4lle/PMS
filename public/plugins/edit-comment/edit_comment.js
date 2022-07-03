const editCommentButtons = document.querySelectorAll('#editCommentButton');
const editCancelButtons = document.querySelectorAll('#editCancelButton');
const editCommentForms = document.querySelectorAll('#editCommentForm');
const commentContents = document.querySelectorAll('#commentContent');
const submitButtons = document.querySelectorAll('#submitButton');

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

editCommentForms.forEach((editCommentForm, index) => {
    editCommentForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        fetch(`/comments/update`, {
            method: 'POST',
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(json => {
                commentContents[index].innerText = json.comment;
                commentContents[index].setAttribute('style', 'display: block')
                this.setAttribute('style', 'display: none');
            });
    })
});
