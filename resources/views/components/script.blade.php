<!-- Latest jQuery -->
<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>

<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Latest compiled and minified Bootstrap -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- modernizer JS -->
<script src="{{ asset('assets/js/modernizr-2.8.3.min.js') }}"></script>
<!-- jquery-simple-mobilemenu.min -->
<script src="{{ asset('assets/js/jquery-simple-mobilemenu.js') }}"></script>
<!-- owl-carousel min js  -->
<script src="{{ asset('assets/owlcarousel/js/owl.carousel.min.js') }}"></script>
<!-- magnific-popup js -->
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- countTo js -->
<script src="{{ asset('assets/js/jquery.inview.min.js') }}"></script>
<!-- scrolltopcontrol js -->
<script src="{{ asset('assets/js/scrolltopcontrol.js') }}"></script>
<!-- WOW - Reveal Animations When You Scroll -->
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<!-- scripts js -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function openContactModal() {
        Swal.fire({
            html: `
    <div style="text-align:left">
        <div class="mb-2">
            <label style="font-weight:bold">Name</label>
            <input type="text" id="contact-name" class="swal2-input" placeholder="Your Name">
        </div>
        <div class="mb-2">
            <label style="font-weight:bold">Phone</label>
            <input type="text" id="contact-phone" class="swal2-input" placeholder="Your Phone Number">
        </div>
        <div class="mb-2">
            <label style="font-weight:bold">Email</label>
            <input type="email" id="contact-email" class="swal2-input" placeholder="Your Email">
        </div>
        <div class="mb-2">
            <label style="font-weight:bold">Subject</label>
            <input type="text" id="contact-subject" class="swal2-input" placeholder="Subject">
        </div>
        <div class="mb-2">
            <label style="font-weight:bold">Message</label>
            <textarea id="contact-message" class="swal2-textarea" placeholder="Your Message"></textarea>
        </div>
    </div>
`,
            showCancelButton: true,
            confirmButtonText: 'Send Message',
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            preConfirm: () => {
                const name    = document.getElementById('contact-name').value;
                const phone   = document.getElementById('contact-phone').value;
                const email   = document.getElementById('contact-email').value;
                const subject = document.getElementById('contact-subject').value;
                const message = document.getElementById('contact-message').value;

                if (!name || !phone || !email || !subject || !message) {
                    Swal.showValidationMessage('Please fill all fields!');
                    return false;
                }
                return { name, phone, email, subject, message };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('name', result.value.name);
                formData.append('contact_no', result.value.phone);
                formData.append('email', result.value.email);
                formData.append('subject', result.value.subject);
                formData.append('message', result.value.message);

                fetch('/contact/send', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Message Sent!',
                            text: 'We will get back to you soon!',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong!'
                        });
                    });
            }
        });
    }
</script>

{{--create acc--}}
<script>
    function openAddAccountModal() {
        document.getElementById('addAccountModal').style.display = 'flex';
    }
    function closeAddAccountModal() {
        document.getElementById('addAccountModal').style.display = 'none';
    }
    @if ($errors->any())
    document.addEventListener('DOMContentLoaded', openAddAccountModal);
    @endif
</script>

<script>
    function openAddInstructorModal() {
        document.getElementById('addInstructorModal').style.display = 'flex';
    }
    function closeAddInstructorModal() {
        document.getElementById('addInstructorModal').style.display = 'none';
    }
</script>

<script>
    function openAddCourseModal() {
        document.getElementById('addCourseModal').style.display = 'flex';
    }
    function closeAddCourseModal() {
        document.getElementById('addCourseModal').style.display = 'none';
    }
</script>

<script>
    function toggleStudentFields() {
        const role = document.getElementById('roleSelect').value;
        document.getElementById('studentFields').style.display = (role === 'student') ? 'block' : 'none';
    }
</script>

<script>
    function filterStudentTable() {
        const input = document.getElementById('studentSearch');
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll('#studentTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    }

    function openUpdateStudentModal(id, name, address, dob, degree) {
        document.getElementById('modal-student-name').value = name;
        document.getElementById('modal-student-address').value = address;
        document.getElementById('modal-student-dob').value = dob;
        document.getElementById('modal-student-degree').value = degree;
        document.getElementById('update-student-form').action = '/admin/students/' + id;

        $('#updateStudentModal').modal('show');
    }

    function confirmDeleteStudent(id) {
        Swal.fire({
            title: 'Delete this student?',
            text: 'This cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            confirmButtonColor: '#E14B4B',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-student-form-' + id).submit();
            }
        });
    }
</script>

<script>
function filterCourseTable() {
const input = document.getElementById('courseSearch');
const filter = input.value.toLowerCase();
const rows = document.querySelectorAll('#courseTable tbody tr');

rows.forEach(row => {
const text = row.textContent.toLowerCase();
row.style.display = text.includes(filter) ? '' : 'none';
});
}

function openUpdateCourseModal(id, name, code, department, duration, price) {
    document.getElementById('modal-course-name').value = name;
    document.getElementById('modal-course-code').value = code;
    document.getElementById('modal-course-department').value = department;
    document.getElementById('modal-course-duration').value = duration;
    document.getElementById('modal-course-price').value = price;
    document.getElementById('update-course-form').action = '/admin/courses/' + id;

    $('#updateCourseModal').modal('show');
}

function confirmDeleteCourse(id) {
Swal.fire({
title: 'Delete this course?',
text: 'This cannot be undone.',
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Yes, delete',
confirmButtonColor: '#E14B4B',
}).then((result) => {
if (result.isConfirmed) {
document.getElementById('delete-course-form-' + id).submit();
}
});
}
</script>

<script>
    function filterInstructorTable() {
        const input = document.getElementById('instructorSearch');
        const filter = input.value.toLowerCase();
        const rows = document.querySelectorAll('#instructorTable tbody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    }

    function openUpdateInstructorRowModal(id, name, mobile, hireDate, salary, department, qualification) {
        document.getElementById('modal-instructor-name').value = name;
        document.getElementById('modal-instructor-mobile').value = mobile;
        document.getElementById('modal-instructor-hire-date').value = hireDate;
        document.getElementById('modal-instructor-salary').value = salary;
        document.getElementById('modal-instructor-department').value = department;
        document.getElementById('modal-instructor-qualification').value = qualification;
        document.getElementById('update-instructor-row-form').action = '/admin/instructors/' + id;

        $('#updateInstructorRowModal').modal('show');
    }

    function confirmDeleteInstructor(id) {
        Swal.fire({
            title: 'Delete this instructor?',
            text: 'This cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            confirmButtonColor: '#E14B4B',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-instructor-form-' + id).submit();
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function openImportDialog() {
        Swal.fire({
            title: 'Import Students',
            html: '<input type="file" id="swalFile" accept=".csv" class="swal2-file">',
            confirmButtonText: 'Import',
            showCancelButton: true,
            preConfirm: () => {
                const file = document.getElementById('swalFile').files[0];
                if (!file) {
                    Swal.showValidationMessage('Please choose a CSV file');
                    return false;
                }
                return file;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(result.value);
                document.getElementById('excelFile').files = dataTransfer.files;
                document.getElementById('importForm').submit();
            }
        });
    }
</script>

<script>
    function exportFiltered() {
        const searchValue = document.getElementById('studentSearch').value;
        document.getElementById('exportSearch').value = searchValue;
        document.getElementById('exportForm').submit();
    }
</script>

<script>
function openImportInstructorDialog() {
Swal.fire({
title: 'Import Instructors',
html: '<input type="file" id="swalInstructorFile" accept=".csv" class="swal2-file">',
confirmButtonText: 'Import',
showCancelButton: true,
preConfirm: () => {
const file = document.getElementById('swalInstructorFile').files[0];
if (!file) {
Swal.showValidationMessage('Please choose a CSV file');
return false;
}
return file;
}
}).then((result) => {
if (result.isConfirmed) {
const dataTransfer = new DataTransfer();
dataTransfer.items.add(result.value);
document.getElementById('excelInstructorFile').files = dataTransfer.files;
document.getElementById('importInstructorForm').submit();
}
});
}

function exportFilteredInstructors() {
const searchValue = document.getElementById('instructorSearch').value;
document.getElementById('exportInstructorSearch').value = searchValue;
document.getElementById('exportInstructorForm').submit();
}
</script>

<script>
function exportFilteredCourses() {
const searchValue = document.getElementById('courseSearch').value;
document.getElementById('exportCourseSearch').value = searchValue;
document.getElementById('exportCourseForm').submit();
}
</script>

<script>
function toggleDarkMode() {
document.body.classList.toggle('dark-mode');
const isDark = document.body.classList.contains('dark-mode');
localStorage.setItem('darkMode', isDark);
updateDarkModeIcon(isDark);
}

function updateDarkModeIcon(isDark) {
const icon = document.getElementById('darkModeIcon');
if (icon) {
icon.className = isDark ? 'fa fa-sun-o' : 'fa fa-moon-o';
}
}

document.addEventListener('DOMContentLoaded', function () {
const isDark = localStorage.getItem('darkMode') === 'true';
if (isDark) {
document.body.classList.add('dark-mode');
}
updateDarkModeIcon(isDark);
});
</script>

<script>
function openAddModuleModal() {
document.getElementById('addModuleModal').style.display = 'flex';
}
function closeAddModuleModal() {
document.getElementById('addModuleModal').style.display = 'none';
}

function openUpdateModuleModal(id, title, description, instructorId) {
    document.getElementById('modal-module-title').value = title;
    document.getElementById('modal-module-description').value = description;
    document.getElementById('modal-module-instructor').value = instructorId || '';
    document.getElementById('update-module-form').action = '/admin/modules/' + id;
    document.getElementById('updateModuleModal').style.display = 'flex';
}
function closeUpdateModuleModal() {
document.getElementById('updateModuleModal').style.display = 'none';
}

function confirmDeleteModule(id) {
Swal.fire({
title: 'Delete this module?',
text: 'This cannot be undone.',
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Yes, delete',
confirmButtonColor: '#E14B4B',
}).then((result) => {
if (result.isConfirmed) {
document.getElementById('delete-module-form-' + id).submit();
}
});
}
</script>

<script>
    function generatePrefix(name) {
        const words = name.trim().split(/\s+/).filter(Boolean);
        if (words.length === 0) return '';
        if (words.length === 1) {
            return words[0].replace(/[^A-Za-z]/g, '').substring(0, 3).toUpperCase();
        }
        return words.map(w => w.charAt(0).toUpperCase()).join('');
    }

    function suggestCourseCode() {
        const nameInput = document.getElementById('courseNameInput');
        const codeInput = document.getElementById('courseCodeInput');
        if (!codeInput.dataset.userEdited) {
            codeInput.value = generatePrefix(nameInput.value);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const codeInput = document.getElementById('courseCodeInput');
        if (codeInput) {
            codeInput.addEventListener('input', function () {
                this.dataset.userEdited = 'true';
            });
        }
    });
</script>

<script>
function previewDeptPrefix() {
const input = document.getElementById('deptNameInput');
const preview = document.getElementById('deptPrefixPreview');
const prefix = generatePrefix(input.value);

if (prefix) {
preview.innerHTML = `Emp No prefix: <strong style="color:#4f46e5;">${prefix}001</strong>`;
} else {
preview.innerHTML = '';
}
}
</script>
<script>
@if ($errors->any() && old('name') !== null)

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('addCourseModal').style.display = 'flex';
        });

@endif
    </script>

<script>
function showTab(tab) {
document.querySelectorAll('.module-tab-content').forEach(el => el.style.display = 'none');
document.querySelectorAll('.module-tab').forEach(el => {
el.style.color = '#6b7280';
el.style.borderBottomColor = 'transparent';
el.style.fontWeight = 'normal';
});
document.getElementById('content-' + tab).style.display = 'block';
const activeTab = document.getElementById('tab-' + tab);
activeTab.style.color = '#5D5FEF';
activeTab.style.borderBottomColor = '#5D5FEF';
activeTab.style.fontWeight = '600';
}

function openAddTopicModal() { document.getElementById('addTopicModal').style.display = 'flex'; }
function openAddAssignmentModal() { document.getElementById('addAssignmentModal').style.display = 'flex'; }
function openAddExamModal() { document.getElementById('addExamModal').style.display = 'flex'; }

function openAddQuestionModal(examId) {
    const basePath = window.location.pathname.startsWith('/teacher') ? '/teacher' : '/admin';
    document.getElementById('add-question-form').action = basePath + '/exams/' + examId + '/questions';
    document.getElementById('addQuestionModal').style.display = 'flex';
}

function closeModal(id) {
document.getElementById(id).style.display = 'none';
}

function confirmDeleteGeneric(formId) {
Swal.fire({
title: 'Are you sure?',
text: 'This cannot be undone.',
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Yes, delete',
confirmButtonColor: '#E14B4B',
}).then((result) => {
if (result.isConfirmed) {
document.getElementById(formId).submit();
}
});
}
</script>

<script>
function confirmPublishExam(formId) {
Swal.fire({
title: 'Publish this exam?',
text: 'Once published, students will be able to see and take it. Make sure all questions are correct.',
icon: 'question',
showCancelButton: true,
confirmButtonText: 'Yes, publish',
confirmButtonColor: '#16a34a',
}).then((result) => {
if (result.isConfirmed) {
document.getElementById(formId).submit();
}
});
}
</script>
