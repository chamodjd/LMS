<!-- Latest jQuery -->
<script src="assets/js/jquery-1.12.4.min.js"></script>
<!-- Latest compiled and minified Bootstrap -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- modernizer JS -->
<script src="assets/js/modernizr-2.8.3.min.js"></script>
<!-- jquery-simple-mobilemenu.min -->
<script src="assets/js/jquery-simple-mobilemenu.js"></script>
<!-- owl-carousel min js  -->
<script src="assets/owlcarousel/js/owl.carousel.min.js"></script>
<!-- magnific-popup js -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- countTo js -->
<script src="assets/js/jquery.inview.min.js"></script>
<!-- scrolltopcontrol js -->
<script src="assets/js/scrolltopcontrol.js"></script>
<!-- WOW - Reveal Animations When You Scroll -->
<script src="assets/js/wow.min.js"></script>
<!-- scripts js -->
<script src="assets/js/scripts.js"></script>

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

</body>
</html>
