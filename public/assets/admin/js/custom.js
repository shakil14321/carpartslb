// Slug functionality
function freindlySlug() {
    const inTitle = document.getElementById('input-title');
    const inSlug = document.getElementById('input-slug');

    if (!inTitle || !inSlug) return;

    if (window.location.pathname.includes('edit')) return;

    inTitle.addEventListener('input', function () {
        const slug = inTitle.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
        inSlug.value = slug;
    })
}
freindlySlug();


// Slug edit functionality
function slugEdit() {
    const slugEditButton = document.getElementById('slug-edit-button');
    const slugEditInput = document.getElementById('input-slug');
    const slugEditSaveButton = document.getElementById('slug-edit-save-button');

    if (!slugEditButton || !slugEditInput || !slugEditSaveButton) return;

    slugEditButton.addEventListener('click', () => {
        slugEditInput.removeAttribute('readonly');
        slugEditInput.style.background = 'none';
        slugEditSaveButton.style.display = 'inline';
    });

    slugEditSaveButton.addEventListener('click', () => {
        slugEditInput.setAttribute('readonly', true);
        slugEditSaveButton.style.display = 'none';
    });
}
slugEdit();

function imagePreview() {
    const imageInput = document.getElementById('imageFile');

    if (!imageInput) return;

    imageInput.addEventListener('change', function (event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('brandImagePreview').src = URL.createObjectURL(file);
        }
    });
}
imagePreview();

// Modal show functionality
function showModal() {
    const modalViewBtn = document.querySelectorAll('.delete-icon');

    if (!modalViewBtn) return;

    modalViewBtn.forEach(icon => {
        icon.addEventListener('click', function (e) {
            e.preventDefault();
            $('#deleteModal').modal('show'); // <-- Use Bootstrap's modal function
        });
    });
}
showModal();


// Image gallery functionality
function imageGallery() {
    const imageGalleryFile = document.getElementById('imageGalleryFile');
    const galleryPreview = document.getElementById('galleryPreview');
    let filesArray = [];

    if(!imageGallery && !galleryPreview) return;

    imageGalleryFile.addEventListener('change', function (event) {
        Array.from(event.target.files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            filesArray.push(file);
            const reader = new FileReader();

            reader.onload = function (e) {
                const wrapper = document.createElement('div');
                wrapper.style.position = 'relative';
                wrapper.style.display = 'inline-block';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.border = '1px solid #ddd';
                img.style.borderRadius = '4px';
                wrapper.appendChild(img);

                const removeBtn = document.createElement('span');
                removeBtn.innerHTML = '&times;';
                removeBtn.style.position = 'absolute';
                removeBtn.style.top = '2px';
                removeBtn.style.right = '5px';
                removeBtn.style.cursor = 'pointer';
                removeBtn.style.background = 'rgba(0,0,0,0.5)';
                removeBtn.style.color = 'white';
                removeBtn.style.borderRadius = '50%';
                removeBtn.style.padding = '0 5px';
                removeBtn.addEventListener('click', function () {
                    wrapper.remove();
                    filesArray = filesArray.filter(f => f !== file);
                    updateFileInput();
                });

                wrapper.appendChild(removeBtn);
                galleryPreview.appendChild(wrapper);
            };

            reader.readAsDataURL(file);
        });

        updateFileInput();
    });

    // Update the input's FileList (important for form submission)
    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        filesArray.forEach(file => dataTransfer.items.add(file));
        imageGalleryFile.files = dataTransfer.files;
    }

}
imageGallery();
