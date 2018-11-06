const url = 'upload.php';
const form = document.querySelector('form');

form.addEventListener('submit', e => {
    e.preventDefault();

    const files = document.querySelector('[type=file]').files;
    const formData = new FormData();

    /* We only use the first 
    for (let i = 0; i < files.length; i++) {
        let file = files[i];

        formData.append('files[]', file);
    }

    fetch(url, {
        method: 'POST',
        body: formData
        console.log(response);
    });
});
