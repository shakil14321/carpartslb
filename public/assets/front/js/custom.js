// Shop page script pagination, sorting filter
if (window.location.pathname.includes('/shop')) {
    function shopPageScript() {
        if (window.location.pathname.includes('/shop')) {
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('car-parts-container');
                const sortSelect = document.getElementById('sort_by');
                const priceForm = document.getElementById('price-filter-form');

                if (!container) return;

                function loadContent(url) {
                    fetch(url, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            container.innerHTML = html;
                            history.replaceState({}, '', url);
                            bindPaginationLinks();
                        })
                        .catch(err => console.error('AJAX error:', err));
                }

                function bindPaginationLinks() {
                    const links = container.querySelectorAll('.pagination a');
                    links.forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const url = new URL(this.href);
                            if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                            if (priceForm) {
                                const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                                const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                                if (minPrice) url.searchParams.set('min_price', minPrice);
                                if (maxPrice) url.searchParams.set('max_price', maxPrice);
                            }
                            loadContent(url.toString());
                        });
                    });
                }

                if (sortSelect) {
                    sortSelect.addEventListener('change', function () {
                        const url = new URL(window.location.href);
                        url.searchParams.set('sort', this.value);
                        url.searchParams.delete('page');
                        if (priceForm) {
                            const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                            const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                            if (minPrice) url.searchParams.set('min_price', minPrice);
                            if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        }
                        loadContent(url.toString());
                    });
                }

                if (priceForm) {
                    priceForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        const url = new URL(window.location.href);
                        const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                        const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                        if (minPrice) url.searchParams.set('min_price', minPrice);
                        else url.searchParams.delete('min_price');
                        if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        else url.searchParams.delete('max_price');
                        url.searchParams.delete('page');
                        if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                        loadContent(url.toString());
                    });
                }

                bindPaginationLinks();
            });
        }
    }
    shopPageScript();
}

// Brand by page script.
if (window.location.pathname.includes('/brand/')) {
    function brandPageScript() {
        if (window.location.pathname.includes('/brand')) {
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('car-parts-container');
                const sortSelect = document.getElementById('sort_by');
                const priceForm = document.getElementById('price-filter-form');

                if (!container) return;

                function loadContent(url) {
                    fetch(url, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            container.innerHTML = html;
                            history.replaceState({}, '', url);
                            bindPaginationLinks();
                        })
                        .catch(err => console.error('AJAX error:', err));
                }

                function bindPaginationLinks() {
                    const links = container.querySelectorAll('.pagination a');
                    links.forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const url = new URL(this.href);
                            if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                            if (priceForm) {
                                const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                                const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                                if (minPrice) url.searchParams.set('min_price', minPrice);
                                if (maxPrice) url.searchParams.set('max_price', maxPrice);
                            }
                            loadContent(url.toString());
                        });
                    });
                }

                if (sortSelect) {
                    sortSelect.addEventListener('change', function () {
                        const url = new URL(window.location.href);
                        url.searchParams.set('sort', this.value);
                        url.searchParams.delete('page');
                        if (priceForm) {
                            const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                            const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                            if (minPrice) url.searchParams.set('min_price', minPrice);
                            if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        }
                        loadContent(url.toString());
                    });
                }

                if (priceForm) {
                    priceForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        const url = new URL(window.location.href);
                        const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                        const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                        if (minPrice) url.searchParams.set('min_price', minPrice);
                        else url.searchParams.delete('min_price');
                        if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        else url.searchParams.delete('max_price');
                        url.searchParams.delete('page');
                        if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                        loadContent(url.toString());
                    });
                }

                bindPaginationLinks();
            });
        }
    }
    brandPageScript();
}


// Brand by page script.
if (window.location.pathname.includes('/part-brand/')) {
    function brandPageScript() {
        if (window.location.pathname.includes('/part-brand')) {
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('car-parts-container');
                const sortSelect = document.getElementById('sort_by');
                const priceForm = document.getElementById('price-filter-form');

                if (!container) return;

                function loadContent(url) {
                    fetch(url, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            container.innerHTML = html;
                            history.replaceState({}, '', url);
                            bindPaginationLinks();
                        })
                        .catch(err => console.error('AJAX error:', err));
                }

                function bindPaginationLinks() {
                    const links = container.querySelectorAll('.pagination a');
                    links.forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const url = new URL(this.href);
                            if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                            if (priceForm) {
                                const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                                const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                                if (minPrice) url.searchParams.set('min_price', minPrice);
                                if (maxPrice) url.searchParams.set('max_price', maxPrice);
                            }
                            loadContent(url.toString());
                        });
                    });
                }

                if (sortSelect) {
                    sortSelect.addEventListener('change', function () {
                        const url = new URL(window.location.href);
                        url.searchParams.set('sort', this.value);
                        url.searchParams.delete('page');
                        if (priceForm) {
                            const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                            const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                            if (minPrice) url.searchParams.set('min_price', minPrice);
                            if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        }
                        loadContent(url.toString());
                    });
                }

                if (priceForm) {
                    priceForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        const url = new URL(window.location.href);
                        const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                        const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                        if (minPrice) url.searchParams.set('min_price', minPrice);
                        else url.searchParams.delete('min_price');
                        if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        else url.searchParams.delete('max_price');
                        url.searchParams.delete('page');
                        if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                        loadContent(url.toString());
                    });
                }

                bindPaginationLinks();
            });
        }
    }
    brandPageScript();
}

if (window.location.pathname.includes('/category/')) {
    function brandPageScript() {
        if (window.location.pathname.includes('/category')) {
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('car-parts-container');
                const sortSelect = document.getElementById('sort_by');
                const priceForm = document.getElementById('price-filter-form');

                if (!container) return;

                function loadContent(url) {
                    fetch(url, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            container.innerHTML = html;
                            history.replaceState({}, '', url);
                            bindPaginationLinks();
                        })
                        .catch(err => console.error('AJAX error:', err));
                }

                function bindPaginationLinks() {
                    const links = container.querySelectorAll('.pagination a');
                    links.forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const url = new URL(this.href);
                            if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                            if (priceForm) {
                                const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                                const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                                if (minPrice) url.searchParams.set('min_price', minPrice);
                                if (maxPrice) url.searchParams.set('max_price', maxPrice);
                            }
                            loadContent(url.toString());
                        });
                    });
                }

                if (sortSelect) {
                    sortSelect.addEventListener('change', function () {
                        const url = new URL(window.location.href);
                        url.searchParams.set('sort', this.value);
                        url.searchParams.delete('page');
                        if (priceForm) {
                            const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                            const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                            if (minPrice) url.searchParams.set('min_price', minPrice);
                            if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        }
                        loadContent(url.toString());
                    });
                }

                if (priceForm) {
                    priceForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        const url = new URL(window.location.href);
                        const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                        const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                        if (minPrice) url.searchParams.set('min_price', minPrice);
                        else url.searchParams.delete('min_price');
                        if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        else url.searchParams.delete('max_price');
                        url.searchParams.delete('page');
                        if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                        loadContent(url.toString());
                    });
                }

                bindPaginationLinks();
            });
        }
    }
    brandPageScript();
}

// Cart part type page script.
if (window.location.pathname.includes('/type/')) {
    function typePageScript() {
        if (window.location.pathname.includes('/type')) {
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('car-parts-container');
                const sortSelect = document.getElementById('sort_by');
                const priceForm = document.getElementById('price-filter-form');

                if (!container) return;

                function loadContent(url) {
                    fetch(url, {
                        method: 'GET',
                        credentials: 'same-origin',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            container.innerHTML = html;
                            history.replaceState({}, '', url);
                            bindPaginationLinks();
                        })
                        .catch(err => console.error('AJAX error:', err));
                }

                function bindPaginationLinks() {
                    const links = container.querySelectorAll('.pagination a');
                    links.forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const url = new URL(this.href);
                            if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                            if (priceForm) {
                                const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                                const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                                if (minPrice) url.searchParams.set('min_price', minPrice);
                                if (maxPrice) url.searchParams.set('max_price', maxPrice);
                            }
                            loadContent(url.toString());
                        });
                    });
                }

                if (sortSelect) {
                    sortSelect.addEventListener('change', function () {
                        const url = new URL(window.location.href);
                        url.searchParams.set('sort', this.value);
                        url.searchParams.delete('page');
                        if (priceForm) {
                            const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                            const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                            if (minPrice) url.searchParams.set('min_price', minPrice);
                            if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        }
                        loadContent(url.toString());
                    });
                }

                if (priceForm) {
                    priceForm.addEventListener('submit', function (e) {
                        e.preventDefault();
                        const url = new URL(window.location.href);
                        const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                        const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                        if (minPrice) url.searchParams.set('min_price', minPrice);
                        else url.searchParams.delete('min_price');
                        if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        else url.searchParams.delete('max_price');
                        url.searchParams.delete('page');
                        if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                        loadContent(url.toString());
                    });
                }

                bindPaginationLinks();
            });
        }
    }
    typePageScript();
}

// Search field  script
if (window.location.pathname.includes('/search')) {
    function searchPageScript() {
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('car-parts-container');
            const sortSelect = document.getElementById('sort_by');
            const priceForm = document.getElementById('price-filter-form');

            if (!container) return;

            function loadContent(url) {
                fetch(url, {
                    method: 'GET',
                    credentials: 'same-origin',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => response.text())
                    .then(html => {
                        container.innerHTML = html;
                        history.replaceState({}, '', url);
                        bindPaginationLinks();
                    })
                    .catch(err => console.error('AJAX error:', err));
            }

            function bindPaginationLinks() {
                const links = container.querySelectorAll('.pagination a');
                links.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const url = new URL(this.href);
                        if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                        if (priceForm) {
                            const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                            const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                            if (minPrice) url.searchParams.set('min_price', minPrice);
                            if (maxPrice) url.searchParams.set('max_price', maxPrice);
                        }
                        loadContent(url.toString());
                    });
                });
            }

            if (sortSelect) {
                sortSelect.addEventListener('change', function () {
                    const url = new URL(window.location.href);
                    url.searchParams.set('sort', this.value);
                    url.searchParams.delete('page');
                    if (priceForm) {
                        const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                        const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                        if (minPrice) url.searchParams.set('min_price', minPrice);
                        if (maxPrice) url.searchParams.set('max_price', maxPrice);
                    }
                    loadContent(url.toString());
                });
            }

            if (priceForm) {
                priceForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const url = new URL(window.location.href);
                    const minPrice = priceForm.querySelector('input[name="min_price"]').value;
                    const maxPrice = priceForm.querySelector('input[name="max_price"]').value;
                    if (minPrice) url.searchParams.set('min_price', minPrice);
                    else url.searchParams.delete('min_price');
                    if (maxPrice) url.searchParams.set('max_price', maxPrice);
                    else url.searchParams.delete('max_price');
                    url.searchParams.delete('page');
                    if (sortSelect && sortSelect.value) url.searchParams.set('sort', sortSelect.value);
                    loadContent(url.toString());
                });
            }

            bindPaginationLinks();
        });
    }
    searchPageScript();
}

// Customer dashboard account tab functionality
function accountTabs() {
    const links = document.querySelectorAll('.account_link');
    const sections = document.querySelectorAll('.account_section');

    if (links.length === 0 || sections.length === 0) return;

    // Click event handler
    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            // Hide all sections
            sections.forEach(sec => sec.style.display = 'none');

            // Remove active class from all links
            links.forEach(l => l.classList.remove('active'));

            // Show target section
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).style.display = 'block';

            // Add active class
            this.classList.add('active');

            // Save to localStorage
            localStorage.setItem('activeAccountSection', targetId);
        });
    });

    // Check last active section in localStorage
    const lastSection = localStorage.getItem('activeAccountSection');
    if (lastSection && document.getElementById(lastSection)) {
        // Hide all sections first
        sections.forEach(sec => sec.style.display = 'none');
        links.forEach(l => l.classList.remove('active'));

        // Show last section
        document.getElementById(lastSection).style.display = 'block';
        document.querySelector(`.account_link[data-target="${lastSection}"]`).classList.add('active');
    } else {
        // Default: first section
        document.querySelector('.account_link').click();
    }
}
accountTabs();

// Customer edit functionality in customer dashboard
function customerEdit() {
    const usernameAtt = document.getElementById("username");
    // const emailAtt = document.getElementById("mail");
    const editBtn = document.getElementById("edit_btn");

    if (!usernameAtt) return;

    editBtn.addEventListener('click', () => {
        usernameAtt.removeAttribute("readonly");
        emailAtt.removeAttribute("readonly");
    });
}
customerEdit();

// Privacy accept check box functionality
function privacyCheck() {
    const acceptPolicy = document.getElementById("accept_policy");
    const checkoutBtn = document.getElementById("checkout_cart_btn");

    if (!acceptPolicy || !checkoutBtn) return;

    !acceptPolicy.checked && checkoutBtn.removeAttribute("href");

    acceptPolicy.addEventListener("change", () => {
        if (acceptPolicy.checked) {
            checkoutBtn.setAttribute("href", checkoutBtn.dataset.href);
        } else {
            checkoutBtn.removeAttribute("href");
        }
    });
}
document.addEventListener("DOMContentLoaded", () => {
    const checkoutBtn = document.getElementById("checkout_cart_btn");
    if (checkoutBtn) checkoutBtn.dataset.href = checkoutBtn.getAttribute("href");
    privacyCheck();
});

// Shipping form selected functionality at checkout page
if (window.location.pathname.includes('/checkout')) {
    // Form hide and show functionality for checkout page.
    function checkoutPageFormToggle() {
        const newAddFormSec = document.getElementById("new_address_form_sec");
        const defaultAddFormSec = document.getElementById("default_address_form_sec");

        if (!new_address_form_sec || !defaultAddFormSec) return;

        const newFormLabel = document.getElementById("newAdd");
        const defaultFormLabel = document.getElementById("defaulAdd");

        newFormLabel.addEventListener("click", () => {
            defaultAddFormSec.classList.toggle("toggleClass");
        });

        defaultFormLabel.addEventListener("click", () => {
            newAddFormSec.classList.toggle("toggleClass");
        });
    }
    checkoutPageFormToggle();

    // checkout page script for default address checkbox
    function checkAddress() {
        const labelAddress = document.querySelectorAll(".add_label");
        const checkboxes = document.querySelectorAll(".checkbox");

        if (!labelAddress.length || !checkboxes.length) return;

        labelAddress.forEach((label, index) => {
            label.addEventListener('click', () => {
                const box = checkboxes[index];
                if (box) {
                    // toggle state
                    box.checked = !box.checked;

                    if (box.checked) {
                        box.setAttribute('checked', 'checked'); // attribute add karo
                    } else {
                        box.removeAttribute('checked'); // attribute hatao
                    }
                }
            });
        });
    }
    checkAddress();
}

document.addEventListener("DOMContentLoaded", () => {
    const checkmarks = document.querySelectorAll(".checkmark");

    if (!checkmarks.length) return;

    checkmarks.forEach((checkmark) => {
        checkmark.addEventListener("click", () => {
            const checkbox = checkmark.previousElementSibling; // <input> checkbox
            if (checkbox) {
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event("change")); // optional event trigger
            }
        });
    });
});


// Show password functionality for login
function showPassword() {
    const passwordField = document.querySelectorAll(".user_password");
    const showPassCheckbox = document.querySelectorAll(".show_password");

    if (!passwordField | !showPassCheckbox) return;

    showPassCheckbox.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            passwordField.forEach(pass => {
                if (checkbox.checked) {
                    pass.type = "text";
                } else {
                    pass.type = "password";
                }
            });
        });
    });
}
showPassword();

// Show password functionality for registration page and password reset update page
function showPass() {
    const showPassCheckbox = document.getElementById('show_pass');
    if (!showPassCheckbox) return;
    showPassCheckbox.addEventListener('change', function () {
        // yahan apne sare IDs list kar lo
        const passwordFields = ['password', 'confirm_password'];

        passwordFields.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.type = this.checked ? 'text' : 'password';
            }
        });
    });
}
showPass();


// function checkoutGetFormId() {
//     const newAddCheck = document.getElementById('new_checkbox');
//     const defaulAddCheck = document.getElementById('default_checkbox');
//     const checkoutBtn = document.getElementById('checkout_payment');

//     const formValue1 = document.getElementById('new_address_form');
//     const formValue2 = document.getElementById('defaul_address_form');

//     const newFormSec = document.getElementById('new_address_form_sec');
//     const defaultFormSec = document.getElementById('default_address_form_sec');

//     if (!checkoutBtn) return;

//     function updateForms() {
//         if (newAddCheck.checked) {
//             defaulAddCheck.checked = false;
//             defaultFormSec.style.display = 'none';
//             newFormSec.style.display = 'block';
//         } else if (defaulAddCheck.checked) {
//             newAddCheck.checked = false;
//             newFormSec.style.display = 'none';
//             defaultFormSec.style.display = 'block';
//         } else {
//             newFormSec.style.display = 'block';
//             defaultFormSec.style.display = 'block';
//         }
//     }

//     // Update forms when checkboxes change
//     newAddCheck.addEventListener('change', updateForms);
//     defaulAddCheck.addEventListener('change', updateForms);

//     // Set form on checkout button click
//     checkoutBtn.addEventListener('click', function () {
//         if (newAddCheck.checked) {
//             this.setAttribute('form', formValue1.id);
//             console.log('Submitting form:', formValue1.id);
//         } else if (defaulAddCheck.checked) {
//             this.setAttribute('form', formValue2.id);
//             console.log('Submitting form:', formValue2.id);
//         } else {
//             console.log('No address selected!');
//         }
//     });

//     // Initialize state
//     updateForms();
// }
document.addEventListener("DOMContentLoaded", () => {
    const newAddCheck = document.getElementById('new_checkbox');
    const defaultAddCheck = document.getElementById('default_checkbox');
    const checkoutBtn = document.getElementById('checkout_payment');

    const newForm = document.getElementById('new_address_form');
    const defaultForm = document.getElementById('defaul_address_form');

    const newFormSec = document.getElementById('new_address_form_sec');
    const defaultFormSec = document.getElementById('default_address_form_sec');

    // Exit if mandatory elements don't exist
    if (!newAddCheck || !checkoutBtn) return;

    function updateForms() {
        if (newAddCheck.checked) {
            defaultAddCheck.checked = false;
            defaultFormSec.style.display = 'none';
            newFormSec.style.display = 'block';
        } else if (defaultAddCheck.checked) {
            newAddCheck.checked = false;
            newFormSec.style.display = 'none';
            defaultFormSec.style.display = 'block';
        } else {
            newFormSec.style.display = 'block';
            defaultFormSec.style.display = 'block';
        }
    }

    // Checkbox event listeners
    newAddCheck.addEventListener('change', updateForms);
    if (defaultAddCheck) defaultAddCheck.addEventListener('change', updateForms);

    // Checkout button assigns correct form
    checkoutBtn.addEventListener('click', function () {
        if (newAddCheck.checked && newForm) {
            checkoutBtn.setAttribute("form", newForm.id);
        } else if (defaultAddCheck && defaultAddCheck.checked && defaultForm) {
            checkoutBtn.setAttribute("form", defaultForm.id);
        } else {
            alert("Please select an address option before checkout.");
            return false;
        }
    });

    // Initialize the form visibility
    updateForms();
});




// checkoutGetFormId();

// Form checking for checkout submit button, and getting the selected form id on checkout page
// function checkoutGetFormId() {
//     const newAddCheck = document.getElementById('new_checkbox');
//     const defaulAddCheck = document.getElementById('default_checkbox');
//     const checkoutBtn = document.getElementById('checkout_payment');

//     var formValue1 = document.getElementById('new_address_form');
//     var formValue2 = document.getElementById('defaul_address_form');

//     if(!checkoutBtn) return;

//     checkoutBtn.addEventListener('click', function () {

//         if (newAddCheck && newAddCheck.checked) {
//             this.setAttribute('form', formValue1.id);
//             console.log(formValue1.id);
//         } else if (defaulAddCheck && defaulAddCheck.checked) {
//             this.setAttribute('form', formValue2.id);
//             console.log(formValue2.id);
//         }


//     });

// }
// checkoutGetFormId();

// Integrate hidden input values for new address form checkout page
function checkoutSubmit() {
    const totalAmountElement = document.getElementById('totalAmount');
    const totalHiddenInput = document.getElementById('totalAmountHiddenInput');
    const defaultTotalHiddenInput = document.getElementById('defaultTotalAmountHiddenInput');

    if (!totalAmountElement) return;

    const totalAmount = totalAmountElement.innerText;

    if (totalHiddenInput) {
        totalHiddenInput.value = totalAmount;
    }

    if (defaultTotalHiddenInput) {
        defaultTotalHiddenInput.value = totalAmount;
    }
}

checkoutSubmit();

// function checkoutSubmit() {
//     const totalAmountElement = document.getElementById('totalAmount');
//     const totalHiddenInput = document.getElementById('totalAmountHiddenInput');
//     const defaultTotalHiddenInput = document.getElementById('defaultTotalAmountHiddenInput');

//     if (!totalAmountElement) return;

//     const totalAmout = totalAmountElement.innerText;

//     totalAmout ? totalHiddenInput.value = totalAmout : '';
//     totalAmout ? defaultTotalHiddenInput.value = totalAmout : '';

// }
// checkoutSubmit();
