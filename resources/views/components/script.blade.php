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
            title: 'Contact Us',
            html: `
            <div style="text-align:left">
                <div class="mb-2">
                    <label style="font-weight:bold">Name</label>
                    <input type="text" id="contact-name" class="swal2-input" placeholder="Your Name">
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
                const email   = document.getElementById('contact-email').value;
                const subject = document.getElementById('contact-subject').value;
                const message = document.getElementById('contact-message').value;

                if (!name || !email || !subject || !message) {
                    Swal.showValidationMessage('Please fill all fields!');
                    return false;
                }
                return { name, email, subject, message };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('name', result.value.name);
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

function openUpdateCourseModal(id, name, duration, price) {
document.getElementById('modal-course-name').value = name;
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
