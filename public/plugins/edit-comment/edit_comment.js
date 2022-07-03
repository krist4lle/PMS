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

function validateComment(json) {
    json.then(json => {
            console.log(json.message);
        }
    );
}

editCommentForms.forEach((editCommentForm, index) => {
    editCommentForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const data = {};
        formData.forEach((value, key) => {
            data[key] = value;
        });

        fetch(`/comments/update`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            method: 'POST',
            body: JSON.stringify(data),
        })
            .then(response => {
                if (response.ok) {

                    return response.json();
                }
                if (response.status === 422) {
                    validateComment(response.json());
                }

                throw new Error();
            })
            .then(json => {
                commentContents[index].innerText = json.comment;
                commentContents[index].setAttribute('style', 'display: block')
                this.setAttribute('style', 'display: none');
            })
            .catch(error => console.error(error));


    })
});
