const editCommentButtons = document.querySelectorAll('#editCommentButton');
const editCancelButtons = document.querySelectorAll('#editCancelButton');
const editCommentForms = document.querySelectorAll('#editCommentForm');
const commentContents = document.querySelectorAll('#commentContent');
const alertErrors = document.querySelectorAll('#alertError');

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
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            method: 'POST',
            body: JSON.stringify(data),
        })
            .then(response => {
                if (response.ok !== true) {
                    response.json().then(json => {
                        alertErrors[index].setAttribute('style', 'display: block');
                        alertErrors[index].innerText = json.message;
                    });
                }

                return response.json();
            })
            .then(json => {
                alertErrors[index].setAttribute('style', 'display: none');
                commentContents[index].innerText = json.comment;
                commentContents[index].setAttribute('style', 'display: block')
                this.setAttribute('style', 'display: none');
            })
            .catch(error => console.error(error));


    })
});
